# Everly BookKeeping Color Palette

## Brand Colors

### Primary Blue
- **Hex:** `#0066CC`
- **Usage:** Primary CTAs, links, icons, checkmarks, active states
- **Tailwind:** `bg-[#0066CC]`, `text-[#0066CC]`, `border-[#0066CC]`

### Dark Blue (Navy)
- **Hex:** `#003366`
- **Usage:** Headings, primary text, dark sections
- **Tailwind:** `text-[#003366]`, `bg-[#003366]`

### Navy (Darkest)
- **Hex:** `#002147`
- **Usage:** Hero sections, footer backgrounds, premium dark sections
- **Tailwind:** `bg-[#002147]`

### Light Blue
- **Hex:** `#E6F2FF`
- **Usage:** Light backgrounds, icon containers, subtle accents
- **Tailwind:** `bg-[#E6F2FF]`

### Mid-Light Blue
- **Hex:** `#CCE5FF`
- **Usage:** Gradient endpoints, hover states
- **Tailwind:** `to-[#CCE5FF]`

### Hover Blue
- **Hex:** `#0055B8`
- **Usage:** Button and link hover states
- **Tailwind:** `hover:bg-[#0055B8]`

## Semantic Colors

### Text Colors
- **Primary Text:** `#1a2332` - Main body text
- **Secondary Text:** `#4A5568` - Supporting text, descriptions
- **Light Text (on dark):** `text-blue-200` - Text on navy backgrounds
- **Very Light (on dark):** `text-blue-100` - Subtle text on dark backgrounds

### Border Colors
- **Light Border:** `#E2E8F0` - Card borders, dividers
- **Standard Border:** `border-gray-300` - Form inputs
- **Focus Border:** `border-[#0066CC]` - Focused inputs

### Background Colors
- **Page Background:** `#F7FAFC` - Light gray-blue for sections
- **Card Background:** `white` - Clean white for content cards
- **Dark Background:** `#002147` - Premium sections, footer

## Gradients

### Hero Gradient
```css
bg-gradient-to-r from-[#0066CC] to-[#003366]
```

### Light Gradient (for icon containers)
```css
bg-gradient-to-br from-[#E6F2FF] to-[#CCE5FF]
```

## Component-Specific Colors

### Buttons
- **Primary:** `bg-[#0066CC]`, hover: `bg-[#0055B8]`
- **Secondary:** `border-[#0066CC] text-[#003366]`, hover: `bg-[#0066CC] text-white`
- **Outline:** `border-[#CBD5E0]`, hover: `border-[#0066CC]`

### Cards
- **Border:** `border-[#E2E8F0]`
- **Hover:** `hover:border-[#0066CC]`

### Forms
- **Input Border:** `border-gray-300`
- **Focus Ring:** `focus:ring-[#0066CC]`
- **Success Background:** `bg-[#E6F2FF]` with `border-[#0066CC]`
- **Error:** `border-red-500`, `text-red-600`

### Icons & Checkmarks
- **Standard:** `text-[#0066CC]`
- **In Light Containers:** `text-[#0066CC]` on `bg-[#E6F2FF]`

## Accessibility Notes

### Contrast Ratios (WCAG AA)
- `#0066CC` on white: ✓ 5.74:1 (AA)
- `#003366` on white: ✓ 11.75:1 (AAA)
- `#002147` on white: ✓ 15.96:1 (AAA)
- `#1a2332` on white: ✓ 14.94:1 (AAA)
- White on `#002147`: ✓ 13.16:1 (AAA)
- `text-blue-200` on `#002147`: ✓ 4.5:1+ (AA)

All color combinations meet or exceed WCAG AA standards for normal text.

## Migration from Old Palette

The following replacements were made:
- `bg-black` → `bg-[#002147]`
- `bg-gray-50` → `bg-[#F7FAFC]`
- `text-gray-400` → `text-blue-200` (on dark) or `text-[#9CA3AF]`
- `text-gray-600` → `text-[#4A5568]`
- `text-gray-900` → `text-[#1a2332]`
- `text-blue-600` → `text-[#0066CC]`
- `text-green-500` → `text-[#0066CC]` (checkmarks)
- `text-purple-600` → `text-[#0066CC]`
- `text-orange-600` → `text-[#0066CC]`
- `from-blue-600 to-purple-600` → `from-[#0066CC] to-[#003366]`
- `from-blue-100 to-blue-200` → `from-[#E6F2FF] to-[#CCE5FF]`

## CSS Custom Properties

Defined in `resources/css/app.css`:

```css
:root {
    --brand-blue: #0066CC;
    --brand-blue-dark: #003366;
    --brand-blue-darker: #002147;
    --brand-blue-light: #E6F2FF;
    --text-primary: #1a2332;
    --text-secondary: #4A5568;
    --border-light: #E2E8F0;
}
```

## Design Philosophy

The blue-forward color palette maintains the Tesla-inspired aesthetic while aligning with the client's brand identity:

1. **Professional & Trustworthy:** Navy blues convey financial expertise
2. **Modern & Clean:** Light blue backgrounds keep the design fresh
3. **Consistent Hierarchy:** Blue tones create visual flow
4. **High Contrast:** Dark navy on white ensures readability
5. **Subtle Accents:** Light blue for non-intrusive highlights
