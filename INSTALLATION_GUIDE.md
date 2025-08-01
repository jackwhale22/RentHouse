# Panduan Instalasi Kos Finder

Panduan lengkap untuk menginstall dan menjalankan sistem Kos Finder di berbagai environment.

## 📋 Persyaratan Sistem

### Minimum Requirements
- **PHP**: 8.1 atau lebih tinggi
- **Composer**: 2.0 atau lebih tinggi
- **Database**: SQLite (sudah include) atau MySQL/PostgreSQL
- **Web Server**: Apache, Nginx, atau PHP built-in server
- **Memory**: 512MB RAM minimum
- **Storage**: 100MB disk space

### Ekstensi PHP yang Diperlukan
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension
- Fileinfo PHP Extension

## 🔧 Instalasi Step-by-Step

### Step 1: Persiapan Environment

#### Untuk Windows (XAMPP)
1. Download dan install XAMPP dari [apachefriends.org](https://www.apachefriends.org/)
2. Pastikan PHP 8.1+ aktif di XAMPP
3. Download Composer dari [getcomposer.org](https://getcomposer.org/)
4. Install Composer dengan mengikuti wizard

#### Untuk Linux (Ubuntu/Debian)
```bash
# Update package list
sudo apt update

# Install PHP dan ekstensi yang diperlukan
sudo apt install php8.1 php8.1-cli php8.1-common php8.1-mysql php8.1-zip php8.1-gd php8.1-mbstring php8.1-curl php8.1-xml php8.1-bcmath php8.1-sqlite3

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

#### Untuk macOS
```bash
# Install Homebrew jika belum ada
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# Install PHP
brew install php@8.1

# Install Composer
brew install composer
```

### Step 2: Setup Project

#### Extract Project
```bash
# Extract file ZIP ke direktori yang diinginkan
unzip kos-finder.zip
cd kos-finder

# Atau jika menggunakan Git
git clone <repository-url> kos-finder
cd kos-finder
```

#### Install Dependencies
```bash
# Install PHP dependencies
composer install

# Jika ada error, coba dengan flag berikut:
composer install --no-dev --optimize-autoloader
```

### Step 3: Konfigurasi Environment

#### Setup File Environment
```bash
# Copy file environment template
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### Edit File .env
Buka file `.env` dan sesuaikan konfigurasi:

```env
APP_NAME="Kos Finder"
APP_ENV=local
APP_KEY=base64:xxxxx (akan di-generate otomatis)
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration (SQLite - Default)
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite

# Atau untuk MySQL
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=kos_finder
# DB_USERNAME=root
# DB_PASSWORD=

# Mail Configuration (Opsional)
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@kosfinder.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Step 4: Setup Database

#### Untuk SQLite (Recommended)
```bash
# Buat file database SQLite
touch database/database.sqlite

# Pastikan path di .env benar (absolute path)
# Contoh: DB_DATABASE=/home/user/kos-finder/database/database.sqlite
```

#### Untuk MySQL
```sql
-- Login ke MySQL dan buat database
CREATE DATABASE kos_finder;
CREATE USER 'kos_user'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON kos_finder.* TO 'kos_user'@'localhost';
FLUSH PRIVILEGES;
```

#### Jalankan Migration dan Seeder
```bash
# Jalankan migration untuk membuat tabel
php artisan migrate

# Jalankan seeder untuk data dummy
php artisan db:seed

# Atau jalankan seeder specific
php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=KosSeeder
php artisan db:seed --class=TransaksiSeeder
```

### Step 5: Setup Storage dan Permissions

#### Setup Storage Link
```bash
# Buat symbolic link untuk storage
php artisan storage:link

# Buat direktori upload jika belum ada
mkdir -p public/uploads/kos
```

#### Set Permissions (Linux/macOS)
```bash
# Set permission untuk storage dan cache
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
chmod -R 775 public/uploads/

# Jika menggunakan web server, set owner yang sesuai
sudo chown -R www-data:www-data storage/
sudo chown -R www-data:www-data bootstrap/cache/
sudo chown -R www-data:www-data public/uploads/
```

### Step 6: Jalankan Aplikasi

#### Development Server
```bash
# Jalankan built-in PHP server
php artisan serve

# Atau dengan host dan port custom
php artisan serve --host=0.0.0.0 --port=8080
```

#### Production Server (Apache)
```apache
# Buat virtual host di Apache
<VirtualHost *:80>
    ServerName kosfinder.local
    DocumentRoot /path/to/kos-finder/public
    
    <Directory /path/to/kos-finder/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/kosfinder_error.log
    CustomLog ${APACHE_LOG_DIR}/kosfinder_access.log combined
</VirtualHost>
```

#### Production Server (Nginx)
```nginx
server {
    listen 80;
    server_name kosfinder.local;
    root /path/to/kos-finder/public;

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

## 🧪 Testing Instalasi

### Verifikasi Instalasi
1. Buka browser dan akses `http://localhost:8000`
2. Pastikan halaman utama muncul dengan featured kos
3. Test fitur pencarian tanpa login
4. Test login dengan akun default:
   - Admin: admin@kosfinder.com / admin123
   - Penyewa: andi@example.com / password123
   - Pemilik: budi@example.com / password123

### Test Fitur Utama
- ✅ Browse kos tanpa login
- ✅ Pencarian dan filter kos
- ✅ Login/logout sistem
- ✅ Dashboard sesuai role
- ✅ Upload foto kos (untuk pemilik)
- ✅ Kontak pemilik (untuk penyewa)
- ✅ Verifikasi kos (untuk admin)

## 🚨 Troubleshooting

### Error: "Class 'PDO' not found"
```bash
# Install ekstensi PDO
sudo apt install php8.1-pdo php8.1-sqlite3
# Atau untuk CentOS/RHEL
sudo yum install php-pdo php-sqlite3
```

### Error: "Permission denied" pada storage
```bash
# Fix permission
sudo chmod -R 775 storage/ bootstrap/cache/
sudo chown -R www-data:www-data storage/ bootstrap/cache/
```

### Error: "Key path does not exist"
```bash
# Generate ulang application key
php artisan key:generate
```

### Error: Database connection failed
1. Periksa konfigurasi database di `.env`
2. Pastikan file database.sqlite ada dan dapat ditulis
3. Untuk MySQL, pastikan service MySQL berjalan

### Error: 500 Internal Server Error
1. Periksa log error di `storage/logs/laravel.log`
2. Pastikan semua dependencies terinstall
3. Periksa permission folder storage dan bootstrap/cache

### Error: Route not found
```bash
# Clear cache
php artisan route:clear
php artisan config:clear
php artisan view:clear
```

## 🔧 Optimisasi Production

### Cache Configuration
```bash
# Cache konfigurasi untuk performa
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Clear cache jika ada perubahan
php artisan cache:clear
```

### Environment Production
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

### Security Headers
Tambahkan di web server configuration:
```
X-Frame-Options: SAMEORIGIN
X-Content-Type-Options: nosniff
X-XSS-Protection: 1; mode=block
Strict-Transport-Security: max-age=31536000; includeSubDomains
```

## 📞 Bantuan Lebih Lanjut

Jika masih mengalami masalah:
1. Periksa log error di `storage/logs/laravel.log`
2. Pastikan semua persyaratan sistem terpenuhi
3. Coba jalankan `composer install` ulang
4. Periksa dokumentasi Laravel di [laravel.com/docs](https://laravel.com/docs)

## 📋 Checklist Instalasi

- [ ] PHP 8.1+ terinstall
- [ ] Composer terinstall
- [ ] Project di-extract/clone
- [ ] `composer install` berhasil
- [ ] File `.env` dikonfigurasi
- [ ] Database dibuat dan dikonfigurasi
- [ ] `php artisan migrate` berhasil
- [ ] `php artisan db:seed` berhasil
- [ ] `php artisan storage:link` berhasil
- [ ] Permission storage diset
- [ ] Server berjalan dan dapat diakses
- [ ] Login dengan akun default berhasil
- [ ] Fitur utama berfungsi normal

