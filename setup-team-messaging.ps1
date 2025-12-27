# Team Management & Messaging Setup Script

Write-Host "🚀 Setting up Team Management & Messaging System..." -ForegroundColor Cyan
Write-Host ""

# Check if we're in the right directory
if (-not (Test-Path "artisan")) {
    Write-Host "❌ Error: Please run this script from the BookKeepingWebsite directory" -ForegroundColor Red
    exit 1
}

# Run migrations
Write-Host "📦 Running database migrations..." -ForegroundColor Yellow
php artisan migrate

if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ Migration failed! Please check your database connection." -ForegroundColor Red
    exit 1
}

Write-Host "✅ Migrations completed successfully!" -ForegroundColor Green
Write-Host ""

# Ask if user wants to seed test data
$seed = Read-Host "Would you like to seed test data? (y/n)"

if ($seed -eq "y" -or $seed -eq "Y") {
    Write-Host "🌱 Seeding test data..." -ForegroundColor Yellow
    php artisan db:seed --class=TeamMessagingSeeder
    
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✅ Test data seeded successfully!" -ForegroundColor Green
        Write-Host ""
        Write-Host "📝 Test Accounts Created:" -ForegroundColor Cyan
        Write-Host "=========================" -ForegroundColor Cyan
        Write-Host "Team Lead 1:    sarah.johnson@everly.com / password" -ForegroundColor White
        Write-Host "Team Member 1:  mike.davis@everly.com / password" -ForegroundColor White
        Write-Host "Team Lead 2:    emily.chen@everly.com / password" -ForegroundColor White
        Write-Host "User 1:         john.client@example.com / password" -ForegroundColor White
        Write-Host "User 2:         jane.smith@example.com / password" -ForegroundColor White
        Write-Host "User 3:         bob.williams@example.com / password" -ForegroundColor White
    } else {
        Write-Host "⚠️  Seeding failed. You can run it manually later:" -ForegroundColor Yellow
        Write-Host "php artisan db:seed --class=TeamMessagingSeeder" -ForegroundColor White
    }
}

Write-Host ""
Write-Host "🎉 Setup Complete!" -ForegroundColor Green
Write-Host ""
Write-Host "📚 Next Steps:" -ForegroundColor Cyan
Write-Host "1. Review TEAM_MESSAGING_DOCUMENTATION.md for detailed information" -ForegroundColor White
Write-Host "2. Review IMPLEMENTATION_SUMMARY.md for a quick overview" -ForegroundColor White
Write-Host "3. Start your development server: php artisan serve" -ForegroundColor White
Write-Host "4. Test the features:" -ForegroundColor White
Write-Host "   - Admin: /admin/teams" -ForegroundColor Gray
Write-Host "   - Team:  /team/dashboard" -ForegroundColor Gray
Write-Host "   - User:  /support" -ForegroundColor Gray
Write-Host ""
Write-Host "✨ Happy coding!" -ForegroundColor Magenta
