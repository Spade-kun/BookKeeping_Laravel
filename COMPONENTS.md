# Component Documentation

This document explains how to use the reusable Blade components in the BookKeep application.

## Hero Component (`x-hero`)

Full-width hero section with background image/video, centered content, and scroll indicator.

### Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `title` | string | Yes | - | Main headline text |
| `subtitle` | string | No | null | Subheading text |
| `backgroundImage` | string | No | null | URL to background image |
| `backgroundVideo` | string | No | null | URL to background video (MP4) |
| `height` | string | No | 'min-h-screen' | Tailwind height class |
| `align` | string | No | 'center' | Vertical alignment (start, center, end) |

### Slots

- `cta` - Optional call-to-action buttons or content

### Example Usage

```blade
<x-hero 
    title="Your Business Headline"
    subtitle="Supporting subheadline text"
    backgroundImage="https://example.com/image.jpg"
    height="min-h-[80vh]">
    <x-slot:cta>
        <x-button href="/contact" size="lg">Get Started</x-button>
        <x-button href="/services" variant="secondary" size="lg">Learn More</x-button>
    </x-slot:cta>
</x-hero>
```

---

## Section Component (`x-section`)

Reusable content section with optional title, subtitle, and scroll animations.

### Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `title` | string | No | null | Section heading |
| `subtitle` | string | No | null | Section subheading |
| `background` | string | No | 'bg-white' | Tailwind background class |
| `padding` | string | No | 'py-20' | Tailwind padding class |
| `animate` | boolean | No | true | Enable scroll animation |

### Slots

- Default slot - Section content

### Example Usage

```blade
<x-section 
    title="Why Choose Us"
    subtitle="We deliver excellence"
    background="bg-gray-50">
    <div class="grid md:grid-cols-3 gap-8">
        <!-- Your content here -->
    </div>
</x-section>
```

---

## Card Component (`x-card`)

Feature or service card with icon, title, description, and optional footer.

### Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `icon` | string | No | null | SVG icon HTML |
| `title` | string | Yes | - | Card title |
| `description` | string | Yes | - | Card description text |
| `hover` | boolean | No | true | Enable hover animation |

### Slots

- `icon` - Optional SVG icon
- `footer` - Optional footer content (buttons, links)

### Example Usage

```blade
<x-card 
    title="Save Time"
    description="Focus on your business while we handle the details."
    :hover="true">
    <x-slot:icon>
        <svg class="w-12 h-12 text-blue-600">...</svg>
    </x-slot:icon>
    <x-slot:footer>
        <a href="/learn-more" class="text-blue-600">Learn More →</a>
    </x-slot:footer>
</x-card>
```

---

## Button Component (`x-button`)

Versatile button/link component with multiple variants and sizes.

### Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `href` | string | No | '#' | Link URL (if '#', renders as button) |
| `variant` | string | No | 'primary' | Style variant (primary, secondary, outline) |
| `size` | string | No | 'md' | Size (sm, md, lg) |

### Variants

- **primary**: Black background, white text
- **secondary**: White background, black text, border
- **outline**: Transparent background, border

### Sizes

- **sm**: Small (px-4 py-2)
- **md**: Medium (px-6 py-3)
- **lg**: Large (px-8 py-4)

### Example Usage

```blade
<!-- Link button -->
<x-button href="/contact" variant="primary" size="lg">
    Get Started
</x-button>

<!-- Form button -->
<x-button type="submit" variant="secondary">
    Submit Form
</x-button>

<!-- With additional classes -->
<x-button href="/pricing" class="mt-4">
    View Pricing
</x-button>
```

---

## Pricing Card Component (`x-pricing-card`)

Pricing plan card with features list and CTA button.

### Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `title` | string | Yes | - | Plan name |
| `price` | string/int | Yes | - | Price amount (without $) |
| `period` | string | No | 'month' | Billing period |
| `features` | array | No | [] | Array of feature strings |
| `highlighted` | boolean | No | false | Highlight this plan |
| `ctaText` | string | No | 'Get Started' | Button text |
| `ctaLink` | string | No | '#' | Button URL |

### Example Usage

```blade
<x-pricing-card
    title="Professional"
    price="599"
    period="month"
    :features="[
        'Up to 200 transactions',
        'Weekly reports',
        'Priority support',
        'Payroll assistance'
    ]"
    :highlighted="true"
    ctaText="Start Now"
    :ctaLink="route('contact')"
/>
```

---

## Animation Classes

Add these classes to elements for automatic scroll animations:

### `.animate-section`
Fade in + slide up when entering viewport

### `.stagger-container`
Container for staggered children animations

### `.stagger-item`
Child element that animates with stagger delay (use inside `.stagger-container`)

### `.hover-card`
Card that elevates on hover

### Example

```blade
<div class="stagger-container">
    <div class="stagger-item">
        <x-card title="Feature 1" description="..." />
    </div>
    <div class="stagger-item">
        <x-card title="Feature 2" description="..." />
    </div>
    <div class="stagger-item">
        <x-card title="Feature 3" description="..." />
    </div>
</div>
```

---

## Layout Structure

All pages extend the main layout:

```blade
@extends('layouts.app')

@section('title', 'Page Title')
@section('description', 'Page meta description')

@section('content')
    <!-- Your page content -->
@endsection

@push('styles')
    <!-- Additional CSS if needed -->
@endpush

@push('scripts')
    <!-- Additional JS if needed -->
@endpush
```

---

## SEO Meta Tags

The layout includes SEO meta tags. Customize per page:

```blade
@section('title', 'Custom Page Title')
@section('description', 'Custom meta description for SEO')
@section('og_image', asset('images/custom-og-image.jpg'))
```

---

## Best Practices

1. **Consistent Spacing**: Use Tailwind spacing utilities (py-20, mb-8, etc.)
2. **Responsive Design**: Always include responsive variants (md:, lg:)
3. **Accessibility**: Add alt text to images, use semantic HTML
4. **Performance**: Lazy load images below the fold
5. **Animation**: Don't overuse animations; keep them subtle
6. **Content**: Keep copy minimal and impactful (Tesla-style)

---

## Common Patterns

### Full-page layout with hero and sections
```blade
<x-hero title="..." subtitle="...">
    <x-slot:cta>
        <x-button href="...">CTA</x-button>
    </x-slot:cta>
</x-hero>

<x-section title="..." subtitle="...">
    <!-- Content -->
</x-section>

<x-section background="bg-gray-50">
    <!-- Content -->
</x-section>
```

### Three-column card grid
```blade
<div class="grid md:grid-cols-3 gap-8 stagger-container">
    @foreach($items as $item)
        <div class="stagger-item">
            <x-card :title="$item->title" :description="$item->description" />
        </div>
    @endforeach
</div>
```

### CTA section
```blade
<x-section 
    background="bg-gradient-to-r from-blue-600 to-purple-600 text-white"
    padding="py-20">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-4xl font-bold mb-6">Ready to Get Started?</h2>
        <p class="text-xl mb-8">Join hundreds of businesses...</p>
        <x-button href="/contact" variant="secondary" size="lg">
            Contact Us
        </x-button>
    </div>
</x-section>
```

---

## Troubleshooting

**Components not rendering?**
- Ensure you're using the correct syntax: `<x-component-name>`
- Check component files exist in `resources/views/components/`
- Run `php artisan view:clear`

**Props not working?**
- Verify prop names match component definition
- Use `:prop="$variable"` for variables, `prop="string"` for strings
- Arrays must use `:prop="[...]"` syntax

**Animations not working?**
- Check GSAP is loaded: `npm run dev`
- Verify animation classes are applied
- Check browser console for JavaScript errors
- Ensure `resources/js/animations.js` is imported

---

**Need help?** Check the Laravel Blade documentation: https://laravel.com/docs/blade
