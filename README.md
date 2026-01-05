# Auto Email Sender – Laravel Scheduled Reminder (MVP)

Aplikasi Laravel sederhana untuk mengirim **email otomatis berdasarkan jadwal**.  
Digunakan sebagai simulasi sistem reminder penagihan (retensi, kontrak, dll).

---

## 🔧 Requirements
Pastikan sudah ter-install:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL / MariaDB
- Git

---

## 🚀 Cara Menjalankan Project (Setelah Clone)

### Clone Repository
```bash
# git clone https://github.com/andikaakbar309/auto-email-sender.git
# cd auto-email-sender

# composer install
# npm install

# copy .env.example and rename it to .env

# php artisan key:generate

# php artisan migrate

# SETUP MAIL

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=youremail@gmail.com
MAIL_PASSWORD=APP_PASSWORD_TANPA_SPASI
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=youremail@gmail.com
MAIL_FROM_NAME="Auto Email Sender"

# php artisan config:clear

# npm run dev (dont close this)

# php artisan serve (dont close this)

# GOTO http://127.0.0.1:8000 THEN LOGIN

# See in .env
QUEUE_CONNECTION=database

# php artisan queue:table

# php artisan migrate

# php artisan queue:work (dont close this)

# php artisan schedule:work (dont close this)

# // config/app.php
'timezone' => 'Asia/Jakarta',







