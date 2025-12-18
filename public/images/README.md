# Image Assets Directory

Place your website images here in WebP format for optimal performance.

## Recommended Images

### Hero Sections
- `hero-home.webp` - Homepage hero (1920x1080px)
- `hero-services.webp` - Services page hero (1920x1080px)
- `hero-about.webp` - About page hero (1920x1080px)
- `hero-contact.webp` - Contact page hero (1920x1080px)

### Icons & Graphics
- `logo.svg` - Company logo
- `logo-white.svg` - White version for dark backgrounds
- `favicon.ico` - Browser favicon
- `og-default.jpg` - Default Open Graph image (1200x630px)

### Content
- Feature/service icons (SVG preferred)
- Team photos (if applicable)
- Office photos
- Client logos

## Image Guidelines

1. **Format**: Use WebP for photos, SVG for icons/logos
2. **Size**: Optimize images before uploading (use ImageOptim, TinyPNG)
3. **Dimensions**: 
   - Hero images: 1920x1080px minimum
   - Open Graph: 1200x630px
   - Thumbnails: 600x400px
4. **Naming**: Use lowercase, hyphens for spaces (e.g., `team-photo.webp`)
5. **Alt text**: Always provide descriptive alt text in Blade templates

## Current Images

Currently using Unsplash placeholder images. Replace with your own:
- Homepage hero: Abstract finance/business visual
- Services: Collaborative workspace
- How It Works: Technology/process imagery
- Pricing: Professional environment
- About: Team or office
- Contact: Welcoming/professional setting

## Converting to WebP

```bash
# Using cwebp (install with: npm install -g webp-converter)
cwebp -q 80 input.jpg -o output.webp

# Batch conversion
for file in *.jpg; do cwebp -q 80 "$file" -o "${file%.jpg}.webp"; done
```

## Optimization Tools

- [TinyPNG](https://tinypng.com/) - Online compression
- [ImageOptim](https://imageoptim.com/) - Mac app
- [Squoosh](https://squoosh.app/) - Web-based optimizer
- [Sharp](https://sharp.pixelplumbing.com/) - Node.js image processing
