import { spawn } from "node:child_process";
import fs from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";
import puppeteer from "puppeteer-core";
import sharp from "sharp";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.resolve(__dirname, "..");
const publicDir = path.join(root, "public");
const baseUrl = process.env.CAPTURE_BASE_URL || "http://127.0.0.1:8000";
const chromePath =
    process.env.CHROME_PATH ||
    ["/usr/local/bin/google-chrome", "/usr/bin/google-chrome", "/usr/bin/chromium-browser"].find((p) =>
        fs.existsSync(p),
    );

const captures = {
    accounting: ["dashboard", "invoices", "ledger", "pl-report"],
    logistics: ["dashboard", "shipments", "dispatch", "delivery-report"],
    crm: ["pipeline", "contacts", "deal", "activities"],
    hrm: ["roster", "leave", "profile", "payroll"],
    pos: ["register", "checkout", "stock", "eod"],
    erp: ["hub", "purchasing", "inventory", "finance"],
    ecommerce: ["shop", "product", "checkout", "orders"],
    android: ["home", "orders", "scan", "profile"],
    game: ["play", "menu", "scores"],
};

const desktopOnlyAndroid = true;

async function waitForServer(url, attempts = 40) {
    for (let i = 0; i < attempts; i++) {
        try {
            const res = await fetch(url);
            if (res.ok) return;
        } catch {
            /* retry */
        }
        await new Promise((r) => setTimeout(r, 500));
    }
    throw new Error(`Server not ready at ${url}`);
}

function startServer() {
    return spawn("php", ["artisan", "serve", "--host=127.0.0.1", "--port=8000"], {
        cwd: root,
        env: { ...process.env, APP_ENV: "local" },
        stdio: "ignore",
    });
}

async function optimizeWebp(buffer, width, height, maxBytes) {
    let quality = 82;
    let out = await sharp(buffer).resize(width, height, { fit: "cover", position: "top" }).webp({ quality, effort: 6 }).toBuffer();
    while (out.length > maxBytes && quality > 48) {
        quality -= 6;
        out = await sharp(buffer).resize(width, height, { fit: "cover", position: "top" }).webp({ quality, effort: 6 }).toBuffer();
    }
    return out;
}

async function writeJpeg(webpPath, quality = 78) {
    const jpgPath = webpPath.replace(/\.webp$/, ".jpg");
    const buf = await sharp(webpPath).jpeg({ quality, mozjpeg: true }).toBuffer();
    fs.writeFileSync(jpgPath, buf);
}

async function capture() {
    if (!chromePath) throw new Error("Chrome not found for puppeteer-core");
    const server = startServer();
    await waitForServer(`${baseUrl}/mockups/accounting/dashboard`);
    const browser = await puppeteer.launch({
        executablePath: chromePath,
        headless: "new",
        args: ["--no-sandbox", "--disable-setuid-sandbox", "--font-render-hinting=none"],
    });

    try {
        for (const [slug, screens] of Object.entries(captures)) {
            const outDir = path.join(publicDir, "images", "works", slug);
            fs.mkdirSync(outDir, { recursive: true });
            let firstDesktop = null;

            for (const screen of screens) {
                const url = `${baseUrl}/mockups/${slug}/${screen}`;
                for (const profile of [
                    { key: "desktop", width: 1440, height: 900, skip: slug === "android" && desktopOnlyAndroid },
                    { key: "mobile", width: 390, height: 844, skip: false },
                ]) {
                    if (profile.skip) continue;
                    const page = await browser.newPage();
                    await page.setViewport({
                        width: profile.width,
                        height: profile.height,
                        deviceScaleFactor: 2,
                    });
                    await page.goto(url, { waitUntil: "networkidle0", timeout: 120000 });
                    await page.evaluate(async () => {
                        window.scrollTo(0, document.body.scrollHeight);
                        await new Promise((r) => setTimeout(r, 150));
                        window.scrollTo(0, 0);
                    });
                    const png = await page.screenshot({ type: "png", fullPage: false });
                    await page.close();
                    const webpPath = path.join(outDir, `${screen}-${profile.key}.webp`);
                    const webp = await optimizeWebp(png, profile.width, profile.height, 200 * 1024);
                    fs.writeFileSync(webpPath, webp);
                    await writeJpeg(webpPath);
                    if (profile.key === "desktop") firstDesktop = webpPath;
                }
                const stripSrc = path.join(outDir, `${screen}-strip.webp`);
                const detail = path.join(outDir, `${screen}-desktop.webp`);
                const mobileDetail = path.join(outDir, `${screen}-mobile.webp`);
                const source = fs.existsSync(detail) ? detail : mobileDetail;
                if (fs.existsSync(source)) {
                    const strip = await optimizeWebp(fs.readFileSync(source), 160, 100, 24 * 1024);
                    fs.writeFileSync(stripSrc, strip);
                }
            }
            const thumbSource = firstDesktop || path.join(outDir, `${screens[0]}-mobile.webp`);
            if (fs.existsSync(thumbSource)) {
                const thumb = await optimizeWebp(fs.readFileSync(thumbSource), 640, 400, 40 * 1024);
                fs.writeFileSync(path.join(outDir, "thumb.webp"), thumb);
            }
        }
    } finally {
        await browser.close();
        server.kill("SIGTERM");
    }
}

capture().catch((err) => {
    console.error(err);
    process.exit(1);
});
