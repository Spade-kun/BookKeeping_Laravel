# BookKeep - Tesla-Inspired Bookkeeping Website

A modern, high-performance Laravel web application for a professional bookkeeping business. Built with Tesla.com-inspired design patterns, featuring smooth animations, clean layouts, and exceptional user experience.

## 🚀 Features

- **Tesla-Inspired Design**: Full-width sections, minimal copy, large hero typography
- **Smooth Animations**: GSAP-powered scroll animations and micro-interactions
- **SEO Optimized**: Meta tags, Open Graph, semantic HTML, clean URLs
- **Fully Responsive**: Mobile-first design with Tesla-style mobile menu
- **Accessibility**: WCAG compliant, keyboard navigation, focus states
- **High Performance**: Lazy loading, optimized assets, smooth 60fps animations

## 📋 Tech Stack

- **Backend**: Laravel 10+
- **Frontend**: Blade Templates, Tailwind CSS 4.0
- **Animation**: GSAP with ScrollTrigger
- **Interactivity**: Alpine.js
- **Build Tool**: Vite
- **Database**: MySQL/PostgreSQL

## 🛠️ Installation

### Prerequisites

- PHP 8.1+
- Composer
- Node.js 18+ and npm
- MySQL or PostgreSQL

### Setup Steps

1. **Install PHP dependencies**
```bash
composer install
```

2. **Install Node dependencies**
```bash
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database** - Edit `.env` file with your database credentials

5. **Run migrations**
```bash
php artisan migrate
```

6. **Build assets**
```bash
npm run dev
```

7. **Start development server**
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## 📦 Production Build

```bash
npm run build
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🎨 Pages

- **Home** (`/`) - Hero section, value proposition, client segments
- **Services** (`/services`) - Comprehensive service listing
- **How It Works** (`/how-it-works`) - Step-by-step process
- **Pricing** (`/pricing`) - Transparent pricing tiers with comparison
- **About** (`/about`) - Company mission and values
- **Contact** (`/contact`) - Contact form with validation

## 🧩 Reusable Components

Located in `resources/views/components/`:

- `hero.blade.php` - Full-width hero sections
- `section.blade.php` - Content sections with animations
- `card.blade.php` - Feature/service cards
- `button.blade.php` - CTA buttons (primary, secondary, outline)
- `pricing-card.blade.php` - Pricing plan cards

## 🎬 Animations

All animations are in `resources/js/animations.js`:

- **Hero animations**: Sequential fade + slide on page load
- **Scroll animations**: Sections fade in when entering viewport
- **Stagger animations**: Child elements animate with delay
- **Card hovers**: Elevation and shadow effects
- **Navigation**: Transparent → solid on scroll

## 🔧 Customization

### Colors
Update Tailwind config or use utility classes. Primary color scheme uses black/white/gray for Tesla-like aesthetic.

### Content
Edit Blade templates in `resources/views/pages/` to customize content while maintaining structure.

### Images
Replace placeholder Unsplash images with your own WebP images in `public/images/`.

## 📱 Mobile Navigation

Tesla-style full-screen mobile menu with smooth animations and accessible controls.

## ♿ Accessibility

- Semantic HTML5 elements
- Keyboard navigation support
- Visible focus states
- WCAG AA contrast compliance
- Proper form labels

## 🚀 Performance Optimizations

- Lazy loading images
- Minified CSS and JS
- Vite asset bundling
- Efficient GSAP ScrollTrigger usage
- Optimized Laravel routes and views

## 📧 Contact Form

Form submission handled by `PageController@submitContact`. Extend to save to database, send emails, or integrate with CRM.

## 🙏 Credits

- Design inspiration: Tesla.com
- Content structure reference: 1800accountant.com
- Built with Laravel, Tailwind CSS, GSAP, and Alpine.js

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
