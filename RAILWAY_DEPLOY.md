# Railway Deployment Guide for Laravel + Vite

## 🚨 Quick Fix for Asset Loading Issues

If your site is deployed but CSS/JS isn't loading, follow these steps:

## Step-by-Step Deployment

### 1. Prepare Your Local Files

The following files have been created/updated for Railway:
- ✅ `nixpacks.toml` - Railway build configuration
- ✅ `vite.config.js` - Updated with build settings
- ✅ `.env.example` - Added ASSET_URL

### 2. Build Assets Locally First

```bash
# Build production assets
npm run build

# Verify public/build directory exists with files
ls public/build
```

### 3. Commit and Push to GitHub

```bash
git add .
git commit -m "Configure for Railway deployment"
git push origin main
```

### 4. Configure Railway Environment Variables

Go to your Railway project → Variables → Add these:

**Required Variables:**
```env
APP_NAME=BookKeep
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_URL=https://your-app.up.railway.app
ASSET_URL=https://your-app.up.railway.app

# Database (Railway provides PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=${PGHOST}
DB_PORT=${PGPORT}
DB_DATABASE=${PGDATABASE}
DB_USERNAME=${PGUSER}
DB_PASSWORD=${PGPASSWORD}

# Session & Cache
SESSION_DRIVER=file
CACHE_DRIVER=file

# Mail (optional - for contact form)
MAIL_MAILER=log
```

**Important Notes:**
- Replace `your-app.up.railway.app` with your actual Railway domain
- Railway auto-fills PostgreSQL variables if you add the PostgreSQL plugin
- Generate APP_KEY by running `php artisan key:generate --show` locally

### 5. Deploy with Railway

#### Option A: Connect GitHub Repository (Recommended)

1. Go to Railway dashboard
2. Click "New Project"
3. Select "Deploy from GitHub repo"
4. Choose your repository
5. Railway will auto-detect Laravel and use `nixpacks.toml`

#### Option B: Railway CLI

```bash
# Install Railway CLI
npm i -g @railway/cli

# Login
railway login

# Link project
railway link

# Deploy
railway up
```

### 6. Add PostgreSQL Database

1. In Railway dashboard, click "+ New"
2. Select "Database" → "PostgreSQL"
3. Railway will auto-add DB environment variables

### 7. Run Migrations

After deployment, run migrations:

```bash
# Using Railway CLI
railway run php artisan migrate --force

# Or in Railway dashboard → Service → Settings → Add this to "Deploy Command"
php artisan migrate --force
```

## Troubleshooting

### Assets Still Not Loading?

**Check 1: Verify Build Directory**
```bash
# Locally, confirm build exists
ls -la public/build/
# Should see: manifest.json and assets/
```

**Check 2: Clear All Caches in Railway**
```bash
railway run php artisan optimize:clear
railway run php artisan config:cache
railway run php artisan route:cache
railway run php artisan view:cache
```

**Check 3: Check Railway Logs**
- Go to Railway → Deployments → View Logs
- Look for build errors or missing files

**Check 4: Verify Environment Variables**
- Ensure `ASSET_URL` matches your Railway domain exactly
- Include `https://` in both `APP_URL` and `ASSET_URL`

### Database Connection Errors?

```bash
# Verify database variables are set
railway variables

# Test connection
railway run php artisan tinker
>>> DB::connection()->getPdo();
```

### 500 Error on Homepage?

```bash
# Check Laravel logs
railway logs

# Or in Railway dashboard, check "Logs" tab
# Common issues:
# - APP_KEY not set
# - Missing database
# - Wrong APP_URL
```

## Post-Deployment Checklist

- [ ] Website loads at Railway URL
- [ ] CSS and styling appear correctly
- [ ] Navigation menu works
- [ ] All pages load without errors
- [ ] Contact form works
- [ ] Mobile menu opens/closes
- [ ] Animations run smoothly
- [ ] Check browser console for errors (F12)

## Railway Build Process

With the `nixpacks.toml` file, Railway will:

1. **Setup Phase**: Install PHP 8.2, Node.js 18, Composer
2. **Install Phase**: Run `composer install` and `npm install`
3. **Build Phase**: 
   - Run `npm run build` (creates production assets)
   - Cache Laravel config, routes, and views
4. **Start Phase**: Run `php artisan serve` on Railway's port

## Important Notes

### Storage Directory
Laravel needs writable storage. Railway makes it writable automatically, but if you have issues:

```bash
# In Railway settings, add to start command:
chmod -R 775 storage bootstrap/cache && php artisan serve --host=0.0.0.0 --port=$PORT
```

### File Uploads
Railway's filesystem is ephemeral. For file uploads:
- Use Railway's persistent volumes, OR
- Use S3/Cloudinary for images

### Environment File
Never commit `.env` to Git. Railway uses environment variables directly.

## Updating Your Site

```bash
# Make changes locally
git add .
git commit -m "Update content"
git push origin main

# Railway auto-deploys from GitHub
# Or force rebuild: railway up
```

## Custom Domain (Optional)

1. Railway dashboard → Settings → Domains
2. Click "Generate Domain" for free Railway subdomain
3. Or add custom domain and configure DNS

## Performance Tips

1. **Enable OPcache** - Railway includes this by default
2. **Use PostgreSQL** - Faster than MySQL on Railway
3. **Monitor logs** - Check for slow queries
4. **Optimize images** - Use WebP format

## Cost

Railway free tier includes:
- $5 credit per month (renews monthly)
- Roughly 500 hours of runtime
- Perfect for demos and small sites

## Support

- Railway Docs: https://docs.railway.app/
- Railway Discord: https://discord.gg/railway
- Laravel Docs: https://laravel.com/docs

---

## Quick Command Reference

```bash
# View logs
railway logs

# Run artisan commands
railway run php artisan [command]

# Clear caches
railway run php artisan optimize:clear

# Run migrations
railway run php artisan migrate --force

# Generate app key
railway run php artisan key:generate

# Open site
railway open

# Check status
railway status
```

---

**Still having issues?** Check the Railway logs and Laravel logs for specific error messages!
