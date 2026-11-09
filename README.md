# Poka Tech

Studio site for [Poka Tech](https://poka-tech.duckdns.org), Ashiqul Islam’s product studio. The current web work is Laravel and Livewire, in English and Arabic, for businesses in Saudi Arabia and the Gulf.

The visual identity is **provisional**. Logo concept 1 and theme 1 are the defaults. Change one config value when a direction is chosen (see below).

## Local setup

Requirements: PHP 8.3+, Composer, Node.js 22+, SQLite.

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
npm install
npm run build
php artisan serve
```

Open `/en` or `/ar`. The bare `/` URL follows the browser language and redirects.

```bash
php artisan test
```

Mail uses `MAIL_MAILER` (log by default). Messages are stored in `contact_submissions` and emailed to `CONTACT_EMAIL` when that address is set.

There is no deployment, DNS, or paid-service setup in this repo.

## Languages

- English: `/en`
- Arabic: `/ar` (`dir="rtl"`, IBM Plex Sans Arabic)
- Strings for the interface: `lang/en/portfolio.php` and `lang/ar/portfolio.php`
- Case studies and sample labels: `config/portfolio.php` (`en` and `ar` keys)

The header switches language and keeps the query string, so a prefilled contact message stays. Each page sets `hreflang`, a canonical URL, and locale-specific title, description, and Open Graph tags.

## Editing content

`config/portfolio.php` is the content file:

- `theme` — `theme-1` (teal `#0F5F58`), `theme-2` (indigo `#1E3A8A`), or `theme-3` (clay `#7C2D12`). This one value changes the accent. Neutrals stay the same. The token is `--color-accent` in `resources/css/app.css`.
- `logo` — `concept-1`, `concept-2`, or `concept-3`. SVG files are in `public/brand/`.
- `case_studies` — problem, what was built, stack, notes, optional `demo_url`, screenshot list.
- `samples` — representative mockup categories. They are not client projects.
- `contact.whatsapp` and `contact.email` come from `WHATSAPP_NUMBER` and `CONTACT_EMAIL`.

There is no price, no testimonial, and no result metric on the site. “Book a call” opens WhatsApp (`https://wa.me/8801785636359`) with a short prefilled message. “Get a quote” and “Demo on request” go to the contact form. A `demo_url` on a case study is shown only when it is a non-empty http(s) URL.

`PORTFOLIO_THEME` and `PORTFOLIO_LOGO` in `.env` override the config defaults. On a local or testing request, `?preview_theme=theme-2&preview_logo=concept-3` previews a combination without editing the file. Those query parameters are ignored when `APP_ENV=production`.

## Screenshots

Case-study images live under `public/images/work/zatca/` and `public/images/work/academia/`. Sample images live under `public/images/work/samples/`. Each entry in the config has `src`, `width`, `height`, and `caption` / `alt` in English and Arabic. The gallery is a keyboard lightbox (arrows, Esc, swipe, RTL-aware) and the thumbnails use `loading="lazy"`.

To add or replace a shot:

1. Export a desktop frame at 1440×900 and a mobile frame at 390×844.
2. Save WebP files next to the others and point `src` at them.
3. Write a caption that describes the screen. Do not add a result, a price, or a client name that is not already established.
4. If `src` is missing, the page shows `public/images/work/placeholder.svg`.

**Mask client data before committing an image.** If a screenshot shows a real client, replace or blur names, invoices, phone numbers, prices, VAT and commercial-registration numbers, street addresses, and any other customer data. Use dummy values. Do not commit raw exports.

The two product screenshots were taken from local checkouts of the public repositories (not modified upstream):

- [github.com/ashique19/zatca](https://github.com/ashique19/zatca) — VAT, commercial registration, street address, phone, map coordinates, branch labels, and customer records in that local checkout were replaced with dummy values before the pages were captured. The trading name Fancy Coffee is the demo tenant.
- [github.com/ashique19/academia](https://github.com/ashique19/academia) — captured with dummy courses created locally, not the imported catalogue.

Representative mockups (accounting, logistics, CRM, HRM, store/POS, ERP, ecommerce, Android, web game) are static pages at `/mockups/{slug}`, registered only when `APP_ENV` is `local` or `testing`. Every one of those pages says “Representative mockup · نموذج تمثيلي” and “Not a client project”. They are not client work. The public site shows the captured images and repeats that label.

## Contact form

Livewire form: name, email, optional company, message. A honeypot field and a limit of 5 attempts per minute per IP sit in front of validation. Valid messages are stored and mailed with the configured mailer. The From address is `MAIL_FROM_ADDRESS`.

## Brand files

| File | What it is |
| --- | --- |
| `public/brand/concept-1.svg` | Monogram P plus wordmark (default) |
| `public/brand/concept-2.svg` | Wordmark with a bar under POKA |
| `public/brand/concept-3.svg` | Circular PT monogram plus wordmark |
| `public/favicon.svg` | Provisional tab icon, same P as concept 1 |

The Latin wordmark is drawn left-to-right inside the SVG so Arabic pages do not reorder the letters. `currentColor` follows the accent theme.

## Case-study sources

Facts on the two case studies come from the public READMEs, `composer.json`, and `package.json` of those repositories, plus code that those READMEs describe (POS services, café tenant, public routes). Counts of courses, sessions, cities, roles, and permissions are omitted here. The ZATCA repository says the work is not a certification. Fancy Coffee as the first tenant is the studio’s description of that project; the repository itself ships it as a demo tenant. “15 years building software” and the service list are from the studio, not from those repositories.

## What is intentionally absent

No Calendly link, no prices, no testimonials, no client logos, no result metrics, and no invented phone number. WhatsApp is `+8801785636359`. The form mailbox is `ashique19@gmail.com`.
