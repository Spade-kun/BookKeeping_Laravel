# 🛠️ Local Development Guide

## Quick Start

### Start Development Server
Run both Laravel and Vite dev server together:
```bash
npm run serve
```

This will start:
- **Laravel**: http://localhost:8000 (blue)
- **Vite**: http://localhost:5173 (green, hot reload enabled)

### Individual Commands
If you prefer to run them separately:

**Terminal 1 - Laravel:**
```bash
php artisan serve
```

**Terminal 2 - Vite (Hot Reload):**
```bash
npm run dev
```

---

## 🔧 Environment Configuration

### Local Development (.env)
```env
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
ASSET_URL=http://localhost:8000
VITE_DEV_SERVER_ENABLED=true

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=bookkeepingwebsite
DB_USERNAME=root
DB_PASSWORD=
```

### Production (Railway Environment Variables)
Railway automatically uses these when you push:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://bookkeepinglaravel-production.up.railway.app
ASSET_URL=https://bookkeepinglaravel-production.up.railway.app
VITE_DEV_SERVER_ENABLED=false

GOOGLE_CLIENT_ID=your-client-id.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=your-client-secret
GOOGLE_REDIRECT_URI=${APP_URL}/auth/google/callback
```

---

## 🚀 Deployment Workflow

### Automatic Deployment
Railway automatically deploys when you push to your connected branch:

```bash
git add .
git commit -m "Your changes"
git push origin main
```

Railway will:
1. Detect the push
2. Run `npm install`
3. Run `npm run build` (production assets)
4. Run `composer install --no-dev`
5. Deploy with production environment variables

### No Manual Build Required
- ✅ Just commit and push
- ✅ Railway handles production builds
- ✅ Your local .env stays in development mode

---

## 📁 Files That Don't Get Committed

### .gitignore includes:
- `.env` (your local configuration)
- `node_modules/` (installed via npm)
- `vendor/` (installed via composer)
- `public/build/` (built by Vite)
- `storage/` and `bootstrap/cache/` (runtime files)

### What Gets Deployed:
- Source code (app/, resources/, routes/, etc.)
- Configuration templates (.env.example)
- Package definitions (package.json, composer.json)
- Build configuration (vite.config.js, nixpacks.toml)

Railway uses `.env.example` and its own environment variables, NOT your local `.env`.

---

## 🧪 Database Setup

### Local Database
```bash
# Create database
mysql -u root
CREATE DATABASE bookkeepingwebsite;
exit

# Run migrations
php artisan migrate

# Seed data (optional)
php artisan db:seed
```

### Railway Database
Migrations run automatically on Railway, or manually via:
```bash
# In Railway terminal
php artisan migrate --force
```

---

## 🎨 Making Changes

### Frontend Changes (CSS/JS)
1. Edit files in `resources/css/` or `resources/js/`
2. Vite auto-reloads in browser (if `npm run dev` is running)
3. No manual refresh needed

### Backend Changes (PHP/Blade)
1. Edit files in `app/`, `routes/`, or `resources/views/`
2. Refresh browser to see changes
3. Laravel detects changes automatically

### Database Changes
```bash
# Create migration
php artisan make:migration create_example_table

# Edit migration file, then run
php artisan migrate
```

---

## 🔍 Common Tasks

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Generate Production Assets
```bash
npm run build
```

### Run Tests
```bash
php artisan test
# or
./vendor/bin/pest
```

### Check Routes
```bash
php artisan route:list
```

### Create Controller/Model/Middleware
```bash
php artisan make:controller ExampleController
php artisan make:model Example
php artisan make:middleware ExampleMiddleware
```

---

## 🐛 Troubleshooting

### "Vite not loading" in browser
**Solution:** Make sure `npm run dev` is running and `VITE_DEV_SERVER_ENABLED=true`

### "SQLSTATE[HY000] [1049] Unknown database"
**Solution:** Create database: `CREATE DATABASE bookkeepingwebsite;`

### Port 8000 already in use
**Solution:** Stop other Laravel servers or use: `php artisan serve --port=8001`

### Changes not reflecting
**Solution:** Clear cache with `php artisan cache:clear` and hard refresh browser (Ctrl+Shift+R)

### OAuth not working locally
**Solution:** Google OAuth requires HTTPS. For local testing:
- Use ngrok: `ngrok http 8000`
- Update APP_URL and GOOGLE_REDIRECT_URI to ngrok URL
- Or skip OAuth testing locally (only test on Railway)

---

## 📊 Development vs Production

| Feature | Local Development | Railway Production |
|---------|------------------|-------------------|
| Environment | `APP_ENV=local` | `APP_ENV=production` |
| Debug Mode | `APP_DEBUG=true` | `APP_DEBUG=false` |
| Assets | Hot reload (Vite dev) | Built (`npm run build`) |
| Database | Local MySQL | Railway MySQL |
| URL | localhost:8000 | railway.app domain |
| SSL | No HTTPS | Auto HTTPS |
| OAuth | Skip or use ngrok | Configured & working |

---

## ✅ Best Practices

1. **Always use `npm run serve`** - Runs both servers together
2. **Never commit `.env`** - It contains local config
3. **Test before push** - Ensure changes work locally
4. **Use migrations** - Don't modify database manually
5. **Clear cache** - When weird errors occur
6. **Keep dependencies updated** - Run `composer update` and `npm update` periodically

---

## 🔗 Useful URLs

- **Local Site**: http://localhost:8000
- **Vite Dev Server**: http://localhost:5173
- **Railway Dashboard**: https://railway.app
- **Production Site**: https://bookkeepinglaravel-production.up.railway.app

---

*Last Updated: December 21, 2025*
