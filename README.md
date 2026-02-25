# 🖼️ CompresslyPro - Free Online Image Compressor

[![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?logo=php)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

A powerful, privacy-first image compression tool built with Laravel 11. Reduce JPG, PNG, WebP, and GIF file sizes by up to 90% without quality loss. No signup required, no watermarks, completely free!

---

## ✨ Features

- 🎨 **Multi-Format Support**: JPG, PNG, WebP, GIF
- 🔄 **Format Conversion**: Convert between formats while compressing
- ⚡ **Fast Compression**: Optimized algorithms using Intervention Image v3
- 🎚️ **Quality Control**: Adjustable compression (10-90%)
- 📏 **Large File Support**: Up to 20MB per image
- 📋 **Clipboard Support**: Paste images directly (Ctrl+V / Cmd+V)
- 🌙 **Dark Mode**: Beautiful dark/light theme toggle
- 🔒 **Privacy-First**: Auto-delete files after 30 minutes
- 📱 **Mobile Responsive**: Works perfectly on all devices

---

## 🚀 Quick Start

### Prerequisites
- PHP 8.3 or higher
- Composer
- SQLite (or MySQL/PostgreSQL)
- GD or Imagick extension

### Installation

```bash
# Clone repository
git clone https://github.com/yourusername/compresslypro.git
cd compresslypro

# Install dependencies
composer install

# Environment setup
cp .env.example .env
php artisan key:generate

# Create SQLite database
touch database/database.sqlite

# Run migrations
php artisan migrate

# Create storage symlink
php artisan storage:link

# Start server
php artisan serve
```

Visit `http://localhost:8000` to use the compressor!

---

## ⚙️ Configuration

### Database
Using SQLite (recommended):
```env
DB_CONNECTION=sqlite
```

### Google Analytics (Optional)
```env
GOOGLE_ANALYTICS_ENABLED=true
GOOGLE_ANALYTICS_ID=G-XXXXXXXXX
```

### Google Search Console (Optional)
```env
GOOGLE_SITE_VERIFICATION=your-verification-code
```

---

## 📊 SEO Optimization

This project is **fully optimized for search engines**. Complete documentation:

- **[SEO_GUIDE.md](SEO_GUIDE.md)** - Comprehensive SEO implementation guide
- **[SEO_CHECKLIST.md](SEO_CHECKLIST.md)** - Step-by-step launch checklist

**Implemented SEO Features:**
- ✅ Optimized meta tags with keywords
- ✅ Open Graph & Twitter Cards
- ✅ Schema.org structured data (WebApplication, HowTo, FAQ)
- ✅ Google Analytics 4 integration
- ✅ robots.txt & XML sitemap
- ✅ Mobile-optimized & fast loading

---

## 🏗️ Project Structure

```
compresslypro/
├── app/Http/Controllers/ImageController.php  # Main compression logic
├── resources/views/home.blade.php           # UI with SEO markup
├── public/
│   ├── robots.txt                           # SEO directives
│   └── sitemap.xml                          # Search engine sitemap
├── config/services.php                      # GA & verification config
├── SEO_GUIDE.md                            # Complete SEO guide
├── SEO_CHECKLIST.md                        # Launch checklist
└── README.md                               # This file
```

---

## 🔧 Development

```bash
# Local development
php artisan serve

# Or with Laravel Herd
herd link
# Access at: http://compresslypro.test

# Run tests (if configured)
php artisan test
```

---

## 📝 Usage

1. **Upload**: Drag & drop, browse files, or paste (Ctrl+V)
2. **Configure**: Adjust quality slider (10-90%)
3. **Convert**: Optionally change format (JPG/PNG/WebP)
4. **Compress**: Click "Compress Image"
5. **Download**: One-click download of optimized image

---

## 🤝 Contributing

Contributions welcome! Please:
1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push and open a Pull Request

---

## 📄 License

This project is licensed under the MIT License.

---

## 🙏 Credits

- **Laravel** - PHP framework
- **Intervention Image** - Image manipulation
- **Tailwind CSS** - Styling
- **Alpine.js** - Reactive UI

---

**Made with ❤️ for the web development community**

*Last Updated: February 18, 2026*
**Made with ❤️ for the web development community**

*Last Updated: February 18, 2026*
