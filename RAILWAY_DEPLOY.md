# Railway Deployment Guide for Laravel + Vite

Your site is deployed but assets aren't loading because Railway needs special configuration for Laravel + Vite.

## Quick Fix for Railway

### 1. Update Your Railway Environment Variables

In your Railway dashboard, add/update these variables:

```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://bookkeepinglaravel-production.up.railway.app
ASSET_URL=https://bookkeepinglaravel-production.up.railway.app
```

**Important**: Replace the URL with your actual Railway URL!

### 2. Add Build and Start Commands in Railway

In Railway dashboard → Settings:

**Build Command:**
```bash
composer install --optimize-autoloader --no-dev && npm install && npm run build && php artisan config:cache && php artisan route:cache && php artisan view:cache
```

**Start Command:**
```bash
php artisan serve --host=0.0.0.0 --port=$PORT
```

### 3. Create Nixpacks Configuration

This tells Railway how to build your Laravel app properly.
