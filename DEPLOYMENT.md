# Image Compressor - Production Deployment Guide

## 🚀 Quick Start (Local Development)

```bash
# 1. Install dependencies
composer install

# 2. Copy environment file
cp .env.example .env

# 3. Generate application key
php artisan key:generate

# 4. Create storage symlink
php artisan storage:link

# 5. Create uploads directory
mkdir -p storage/app/public/uploads

# 6. Start development server
php artisan serve
```

Visit: **http://localhost:8000**

---

## 🛠 Requirements

- **PHP** >= 8.2 with extensions:
  - `gd` (required for image processing)
  - `exif`
  - `fileinfo`
  - `mbstring`
  - `openssl`
- **Composer** >= 2.x
- **Web Server**: Nginx (recommended) or Apache

### Check PHP Extensions
```bash
php -m | grep -iE 'gd|exif|fileinfo|mbstring'
```

If `gd` is missing:
```bash
# Ubuntu/Debian
sudo apt install php8.2-gd php8.2-exif

# macOS (Homebrew)
# GD is usually included with Homebrew PHP
```

---

## 📦 Production Deployment

### 1. Server Setup

```bash
# Clone repository
git clone <your-repo-url> /var/www/image-compressor
cd /var/www/image-compressor

# Install production dependencies
composer install --no-dev --optimize-autoloader

# Set up environment
cp .env.example .env
php artisan key:generate
```

### 2. Configure `.env`

```env
APP_NAME="Image Compressor"
APP_ENV=production
APP_KEY=<generated-key>
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_LEVEL=warning

# No database needed for this app
# But Laravel requires a driver - use sqlite with no file
DB_CONNECTION=sqlite
# DB_DATABASE=/dev/null

# Cache & Session
CACHE_STORE=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### 3. Directory Permissions

```bash
# Set proper ownership
sudo chown -R www-data:www-data /var/www/image-compressor
sudo chmod -R 755 /var/www/image-compressor

# Writable directories
sudo chmod -R 775 storage bootstrap/cache
sudo chmod -R 775 storage/app/public/uploads
```

### 4. Storage Symlink

```bash
php artisan storage:link
```

### 5. Optimize for Production

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize
```

### 6. Nginx Configuration

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/image-compressor/public;
    index index.php;

    # Security headers
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    # Max upload size
    client_max_body_size 12M;

    # Gzip compression
    gzip on;
    gzip_types text/plain text/css application/json application/javascript text/xml application/xml text/javascript image/svg+xml;
    gzip_min_length 256;

    # Cache static assets
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|eot)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
        try_files $uri =404;
    }

    # Block direct access to uploads (force through Laravel download route)
    location /storage/uploads {
        deny all;
        return 404;
    }

    # Laravel routing
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;

        # Timeout for image processing
        fastcgi_read_timeout 60;
    }

    # Block hidden files
    location ~ /\.(?!well-known) {
        deny all;
    }
}
```

### 7. SSL with Certbot

```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

### 8. PHP-FPM Configuration

Edit `/etc/php/8.2/fpm/pool.d/www.conf`:

```ini
upload_max_filesize = 12M
post_max_size = 14M
memory_limit = 256M
max_execution_time = 60
```

---

## ⏰ Scheduled Cleanup (Cron Job)

The app auto-deletes uploaded files after 30 minutes. Set up the Laravel scheduler:

```bash
# Add to crontab (crontab -e)
* * * * * cd /var/www/image-compressor && php artisan schedule:run >> /dev/null 2>&1
```

### Manual Cleanup
```bash
# Delete files older than 30 minutes
php artisan uploads:cleanup

# Delete files older than 10 minutes
php artisan uploads:cleanup --minutes=10
```

---

## 🔒 Security Checklist

- [x] CSRF protection on all POST routes
- [x] Server-side file validation (type + size)
- [x] Client-side file validation
- [x] Rate limiting (30 requests/minute)
- [x] Sanitized filenames (slug format)
- [x] Security headers (X-Content-Type-Options, X-Frame-Options, etc.)
- [x] No direct access to uploaded files
- [x] Auto-deletion of uploaded files
- [x] `.htaccess` protection on uploads directory
- [x] Input sanitization against XSS

---

## 📊 Monitoring

### Check Upload Directory Size
```bash
du -sh storage/app/public/uploads/
```

### Check Cleanup Logs
```bash
php artisan uploads:cleanup
```

### Monitor Disk Space
```bash
df -h
```

---

## 💰 Adding AdSense

Replace the placeholder `<!-- AdSense ... Placeholder -->` comments in `resources/views/home.blade.php` with your actual AdSense code:

```html
<!-- Replace placeholder with actual AdSense code -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
     data-ad-slot="XXXXXXXXXX"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
```

---

## 🐛 Troubleshooting

### Image processing fails
```bash
# Check if GD extension is installed
php -r "var_dump(gd_info());"

# Check memory limit
php -r "echo ini_get('memory_limit');"
```

### File upload fails
```bash
# Check PHP limits
php -r "echo 'upload_max_filesize: ' . ini_get('upload_max_filesize') . PHP_EOL;"
php -r "echo 'post_max_size: ' . ini_get('post_max_size') . PHP_EOL;"
```

### Permission errors
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Clear all caches
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```
