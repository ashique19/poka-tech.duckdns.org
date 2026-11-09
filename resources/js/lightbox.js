function initLightbox(root) {
    const dialog = root.querySelector("[data-lightbox-dialog]");
    const triggers = [...root.querySelectorAll("[data-lightbox-open]")];
    const image = root.querySelector("[data-lightbox-image]");
    const caption = root.querySelector("[data-lightbox-caption]");
    const count = root.querySelector("[data-lightbox-count]");
    const prev = root.querySelector("[data-lightbox-prev]");
    const next = root.querySelector("[data-lightbox-next]");
    const closeButton = root.querySelector("[data-lightbox-close]");

    if (!dialog || triggers.length === 0 || !image) {
        return;
    }

    let index = 0;
    let lastTrigger = null;
    let startX = 0;
    let startY = 0;

    const rtl = () => document.documentElement.dir === "rtl";

    const show = (nextIndex) => {
        index = Math.max(0, Math.min(triggers.length - 1, nextIndex));
        const trigger = triggers[index];
        image.src = trigger.dataset.src || "";
        image.alt = trigger.dataset.alt || "";
        if (trigger.dataset.srcset) {
            image.srcset = trigger.dataset.srcset;
            image.sizes = trigger.dataset.sizes || "100vw";
        } else {
            image.removeAttribute("srcset");
        }
        image.width = Number(trigger.dataset.width || 1440);
        image.height = Number(trigger.dataset.height || 900);
        if (caption) {
            caption.textContent = trigger.dataset.caption || "";
        }
        if (count) {
            const template = root.dataset.countTemplate || ":current / :total";
            count.textContent = template
                .replace(":current", String(index + 1))
                .replace(":total", String(triggers.length));
        }
        if (prev) {
            prev.disabled = index === 0;
        }
        if (next) {
            next.disabled = index === triggers.length - 1;
        }
    };

    const open = (trigger) => {
        lastTrigger = trigger;
        show(triggers.indexOf(trigger));
        if (typeof dialog.showModal === "function" && !dialog.open) {
            dialog.showModal();
        }
    };

    triggers.forEach((trigger) => {
        trigger.addEventListener("click", () => open(trigger));
    });

    closeButton?.addEventListener("click", () => dialog.close());
    prev?.addEventListener("click", () => show(index - 1));
    next?.addEventListener("click", () => show(index + 1));

    dialog.addEventListener("close", () => {
        lastTrigger?.focus();
    });

    dialog.addEventListener("keydown", (event) => {
        if (event.key === "ArrowRight") {
            event.preventDefault();
            show(rtl() ? index - 1 : index + 1);
        } else if (event.key === "ArrowLeft") {
            event.preventDefault();
            show(rtl() ? index + 1 : index - 1);
        } else if (event.key === "Home") {
            event.preventDefault();
            show(0);
        } else if (event.key === "End") {
            event.preventDefault();
            show(triggers.length - 1);
        }
    });

    dialog.addEventListener(
        "touchstart",
        (event) => {
            startX = event.changedTouches[0].clientX;
            startY = event.changedTouches[0].clientY;
        },
        { passive: true },
    );

    dialog.addEventListener(
        "touchend",
        (event) => {
            const dx = event.changedTouches[0].clientX - startX;
            const dy = event.changedTouches[0].clientY - startY;
            if (Math.abs(dx) < 48 || Math.abs(dx) < Math.abs(dy)) {
                return;
            }
            const forward = rtl() ? dx > 0 : dx < 0;
            show(forward ? index + 1 : index - 1);
        },
        { passive: true },
    );
}

document.querySelectorAll("[data-lightbox]").forEach(initLightbox);
