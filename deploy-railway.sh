#!/bin/bash

# Railway Deployment Script for BookKeep Laravel App
# Run this before pushing to GitHub/Railway

echo "🚀 Preparing BookKeep for Railway Deployment..."
echo ""

# Step 1: Install dependencies
echo "📦 Installing dependencies..."
composer install --optimize-autoloader --no-dev
npm install

# Step 2: Build production assets
echo "🏗️  Building production assets..."
npm run build

# Step 3: Verify build directory exists
if [ -d "public/build" ]; then
    echo "✅ Build directory created successfully"
    echo "   Files in public/build:"
    ls -la public/build/
else
    echo "❌ Build directory not found! Assets may not load."
    exit 1
fi

# Step 4: Clear and cache Laravel configs
echo "⚙️  Optimizing Laravel..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Step 5: Check for .env file
if [ ! -f ".env" ]; then
    echo "⚠️  Warning: .env file not found"
    echo "   Make sure to set environment variables in Railway dashboard"
fi

echo ""
echo "✅ Deployment preparation complete!"
echo ""
echo "📝 Next steps:"
echo "1. Uncomment /public/build in .gitignore (already done)"
echo "2. git add ."
echo "3. git commit -m 'Build assets for Railway deployment'"
echo "4. git push origin main"
echo "5. Set environment variables in Railway dashboard (see RAILWAY_DEPLOY.md)"
echo ""
echo "🌐 Don't forget to set in Railway:"
echo "   - APP_URL=https://your-app.up.railway.app"
echo "   - ASSET_URL=https://your-app.up.railway.app"
echo ""
