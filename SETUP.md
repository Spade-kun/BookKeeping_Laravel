# Setup & Deployment Guide

## Quick Start (Development)

```bash
# 1. Install dependencies
composer install
npm install

# 2. Setup environment
cp .env.example .env
php artisan key:generate

# 3. Configure database in .env file
# DB_CONNECTION=mysql
# DB_DATABASE=bookkeeping
# DB_USERNAME=root
# DB_PASSWORD=

# 4. Run migrations
php artisan migrate

# 5. Start development servers
npm run dev        # Terminal 1 - Asset compilation
php artisan serve  # Terminal 2 - Laravel server
```

## Production Deployment

### 1. Server Requirements
- PHP 8.1 or higher
- MySQL 8.0+ or PostgreSQL 13+
- Composer
- Node.js 18+
- Nginx or Apache with mod_rewrite

### 2. Deploy Steps

```bash
# Clone repository
git clone <repository-url>
cd BookKeepingWebsite

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Configure production .env
# Set APP_ENV=production
# Set APP_DEBUG=false
# Configure database credentials
# Set proper APP_URL

# Build assets
npm run build

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Set permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Run migrations
php artisan migrate --force
```

### 3. Web Server Configuration

#### Nginx Configuration
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/bookkeeping/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

#### Apache Configuration (.htaccess already included)
Ensure `mod_rewrite` is enabled:
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### 4. SSL Certificate (Let's Encrypt)
```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

### 5. Environment Variables (Production .env)
```env
APP_NAME="BookKeep"
APP_ENV=production
APP_KEY=base64:... (generated)
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookkeeping_prod
DB_USERNAME=bookkeeping_user
DB_PASSWORD=your_secure_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Mail configuration (for contact form)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@bookkeep.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## Performance Optimization

### 1. Enable OPcache
Edit `/etc/php/8.1/fpm/php.ini`:
```ini
opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=20000
opcache.validate_timestamps=0
opcache.revalidate_freq=0
```

### 2. Configure PHP-FPM
Edit `/etc/php/8.1/fpm/pool.d/www.conf`:
```ini
pm = dynamic
pm.max_children = 50
pm.start_servers = 5
pm.min_spare_servers = 5
pm.max_spare_servers = 35
pm.max_requests = 500
```

### 3. Enable Gzip Compression (Nginx)
```nginx
gzip on;
gzip_vary on;
gzip_min_length 1024;
gzip_types text/plain text/css text/xml text/javascript application/x-javascript application/xml+rss application/json;
```

### 4. Browser Caching (Nginx)
```nginx
location ~* \.(jpg|jpeg|png|gif|webp|svg|css|js|woff|woff2|ttf|eot)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
}
```

## Monitoring & Maintenance

### 1. Setup Laravel Telescope (Optional, Development)
```bash
composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate
```

### 2. Setup Error Tracking
Consider integrating:
- Sentry (error tracking)
- New Relic (performance monitoring)
- Laravel Horizon (queue monitoring, if using Redis)

### 3. Automated Backups
```bash
# Database backup script
mysqldump -u username -p database_name > backup_$(date +%Y%m%d).sql

# Setup cron job
0 2 * * * /path/to/backup-script.sh
```

### 4. Log Rotation
Laravel logs in `storage/logs/`. Setup logrotate:
```bash
/var/www/bookkeeping/storage/logs/*.log {
    daily
    rotate 14
    compress
    delaycompress
    notifempty
    create 0640 www-data www-data
}
```

## Troubleshooting

### Issue: 500 Internal Server Error
- Check `storage/logs/laravel.log`
- Verify file permissions
- Ensure `.env` is properly configured
- Run `php artisan config:clear`

### Issue: Assets not loading
- Run `npm run build`
- Clear browser cache
- Check `public/build` directory exists
- Verify Vite manifest file is present

### Issue: Database connection failed
- Verify database credentials in `.env`
- Check database service is running
- Test connection: `php artisan tinker` → `DB::connection()->getPdo();`

### Issue: Styles not applying
- Clear view cache: `php artisan view:clear`
- Clear config cache: `php artisan config:clear`
- Rebuild assets: `npm run build`

## Security Checklist

- [ ] Set `APP_DEBUG=false` in production
- [ ] Use strong `APP_KEY`
- [ ] Configure proper file permissions (755 for directories, 644 for files)
- [ ] Enable HTTPS with valid SSL certificate
- [ ] Keep Laravel and dependencies updated
- [ ] Implement rate limiting on contact form
- [ ] Add CSRF protection (already included)
- [ ] Sanitize user inputs (validation in place)
- [ ] Use environment variables for sensitive data
- [ ] Regular database backups
- [ ] Monitor error logs

## Next Steps

1. Replace placeholder images with your own
2. Update content to match your business
3. Configure email service for contact form
4. Add Google Analytics or similar
5. Submit sitemap to search engines
6. Setup social media links
7. Add reCAPTCHA to contact form
8. Configure CDN for static assets
9. Setup monitoring and alerts
10. Create admin dashboard (optional)

## Support & Resources

- Laravel Documentation: https://laravel.com/docs
- Tailwind CSS: https://tailwindcss.com/docs
- GSAP Documentation: https://greensock.com/docs/
- Alpine.js: https://alpinejs.dev/

---

**Remember**: Always test thoroughly in a staging environment before deploying to production!
