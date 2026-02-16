# 🚀 QUICK START GUIDE

## Access URLs

### Public Site
- **Home:** http://127.0.0.1:8080
- **Compress Images:** Upload via home page
- **No login required**

### Admin Panel
- **Login:** http://127.0.0.1:8080/authorize
- **Dashboard:** http://127.0.0.1:8080/admin
- **Reports:** http://127.0.0.1:8080/admin/reports

## Admin Credentials

```
Username: admin
Password: admin123
```

⚠️ **Change these in production!**

## Start the Application

```bash
cd /Users/rupesh/Projects/vibecode/image-convertor
php artisan serve --port=8080
```

Server will start at: http://127.0.0.1:8080

## Test Workflow

### 1. Test Public Compression
1. Visit http://127.0.0.1:8080
2. Upload an image (max 10MB)
3. Adjust quality slider (10-90%)
4. Select output format
5. Click "Compress Image"
6. Download result

### 2. Test Admin Access
1. Visit http://127.0.0.1:8080/authorize
2. Login with `admin` / `admin123`
3. View dashboard
4. Click "Compression Reports"
5. See analytics and data
6. Toggle dark mode (moon icon)
7. Logout from top-right

### 3. Test Dark Mode
- Click moon/sun icon on any page
- Theme persists across pages
- All text should be clearly visible

## File Locations

### Change Admin Password
File: `app/Http/Controllers/AdminController.php`
Lines: 12-13

```php
private const ADMIN_USERNAME = 'admin';
private const ADMIN_PASSWORD = 'admin123';
```

### View Routes
File: `routes/web.php`

### View Database
File: `database/database.sqlite`
Query tool: DB Browser for SQLite or `php artisan tinker`

### View Reports Data
Command:
```bash
php artisan tinker
>>> App\Models\CompressionReport::count()
>>> App\Models\CompressionReport::latest()->take(5)->get()
```

### Cleanup Old Files
Manual:
```bash
php artisan uploads:cleanup
```

Scheduled (runs every 5 minutes):
```bash
php artisan schedule:work
```

## Common Tasks

### Clear All Caches
```bash
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:clear
```

### View Logs
```bash
tail -f storage/logs/laravel.log
```

### Run Migrations
```bash
php artisan migrate
```

### Reset Database
```bash
php artisan migrate:fresh
```

### Generate Fake Report Data
```bash
php artisan tinker
```
Then paste:
```php
for ($i = 0; $i < 10; $i++) {
    App\Models\CompressionReport::create([
        'original_name' => 'image-' . $i . '.jpg',
        'original_format' => 'jpeg',
        'output_format' => ['jpeg', 'png', 'webp'][rand(0, 2)],
        'original_size' => rand(100000, 5000000),
        'compressed_size' => rand(20000, 100000),
        'reduction_percent' => rand(50, 90),
        'quality' => rand(40, 80),
        'width' => rand(800, 2000),
        'height' => rand(600, 1500),
        'ip_address' => '127.0.0.1',
        'user_agent' => 'Test',
    ]);
}
```

## Troubleshooting

### Can't access admin panel
- Check you're logged in at `/authorize`
- Clear browser cookies
- Try incognito mode

### Dark mode not working
- Clear browser cache
- Check localStorage (F12 → Application → Local Storage)
- Clear with: `localStorage.clear()`

### Compression fails
- Check GD extension: `php -m | grep gd`
- Check upload limits in `.user.ini`
- Check logs: `tail -f storage/logs/laravel.log`

### Routes not working
- Clear route cache: `php artisan route:clear`
- Check routes: `php artisan route:list`

### Images not deleting
- Check cron is running: `php artisan schedule:work`
- Run manually: `php artisan uploads:cleanup`
- Check permissions on `storage/app/public/uploads/`

## Quick Commands Reference

```bash
# Start server
php artisan serve --port=8080

# Run cleanup
php artisan uploads:cleanup

# View routes
php artisan route:list

# Clear caches
php artisan cache:clear && php artisan view:clear

# Run migrations
php artisan migrate

# Enter tinker (REPL)
php artisan tinker

# View reports count
php artisan tinker --execute="echo App\Models\CompressionReport::count();"

# Check Laravel version
php artisan --version

# Run scheduled tasks (in separate terminal)
php artisan schedule:work
```

## Production Deployment

### 1. Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 2. Optimize
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. Permissions
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 4. Symbolic Link
```bash
php artisan storage:link
```

### 5. Cron Job
Add to crontab (`crontab -e`):
```
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```

## Support & Documentation

- **Laravel Docs:** https://laravel.com/docs/11.x
- **Intervention Image:** https://image.intervention.io/v3
- **Tailwind CSS:** https://tailwindcss.com
- **Alpine.js:** https://alpinejs.dev

## Project Files

- `DEPLOYMENT.md` - Detailed deployment guide
- `DARK_MODE_COMPLETE.md` - Dark mode implementation
- `ADMIN_PANEL_COMPLETE.md` - Admin panel documentation
- `PROJECT_COMPLETE.md` - Full project overview
- `README.md` - Project readme

---

**Last Updated:** February 16, 2026  
**Version:** 1.0.0  
**Status:** ✅ Production Ready
