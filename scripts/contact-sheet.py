#!/usr/bin/env python3
from pathlib import Path
from PIL import Image

root = Path("/workspace/public/images/works")
out = Path("/opt/cursor/artifacts/gallery-thumbnails-contact.png")
thumbs = sorted(root.glob("*/thumb.webp"))
if not thumbs:
    raise SystemExit("No thumbnails found")

cols = 3
rows = (len(thumbs) + cols - 1) // cols
w, h = 640, 400
pad = 20
sheet = Image.new("RGB", (cols * (w + pad) + pad, rows * (h + pad + 28) + pad), "#F7F4EE")
for i, path in enumerate(thumbs):
    img = Image.open(path).convert("RGB")
    img = img.resize((w, h), Image.Resampling.LANCZOS)
    col, row = i % cols, i // cols
    x = pad + col * (w + pad)
    y = pad + row * (h + pad + 28)
    sheet.paste(img, (x, y))
    slug = path.parent.name
    try:
        from PIL import ImageDraw, ImageFont
        draw = ImageDraw.Draw(sheet)
        draw.text((x + 8, y + h + 6), slug, fill="#1E3A8A")
    except Exception:
        pass
sheet.save(out, optimize=True)
print(out)
