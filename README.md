# Sistem Absensi Karyawan

Sistem Absensi Karyawan adalah aplikasi berbasis web yang dibangun menggunakan Laravel untuk memudahkan pengelolaan absensi dan kehadiran karyawan dalam suatu organisasi atau perusahaan.

## 🚀 Fitur Utama

- **Manajemen Karyawan**: Kelola data karyawan dengan mudah
- **Absensi Realtime**: Sistem absensi masuk dan pulang dengan timestamp
- **Dashboard Admin**: Panel kontrol untuk admin mengelola sistem
- **Laporan Absensi**: Generate laporan kehadiran karyawan
- **Manajemen Shift**: Pengaturan jam kerja dan shift karyawan
- **Notifikasi**: Sistem notifikasi untuk keterlambatan dan absensi
- **Export Data**: Export laporan ke format Excel/PDF
- **Responsive Design**: Tampilan yang responsive untuk berbagai perangkat

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 10.x
- **Frontend**: Bootstrap 5, HTML5, CSS3, JavaScript
- **Database**: MySQL
- **Authentication**: Laravel Sanctum/Breeze
- **Icons**: Font Awesome
- **Charts**: Chart.js (untuk visualisasi data)

## 📋 Persyaratan Sistem

Pastikan sistem Anda memenuhi persyaratan berikut:

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js & NPM
- Git

## 🔧 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/Alfriannn/AbsensiKaryawan.git
cd AbsensiKaryawan
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Konfigurasi Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=absensi_karyawan
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan Migrasi Database

```bash
# Jalankan migrasi
php artisan migrate

# Jalankan seeder (optional)
php artisan db:seed
```

### 6. Build Assets

```bash
# Compile assets
npm run dev

# Untuk production
npm run build
```

### 7. Jalankan Aplikasi

```bash
# Jalankan server development
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 👥 Default Login

Setelah menjalankan seeder, gunakan akun berikut untuk login:

**Admin:**
- Email: admin@admin.com
- Password: admin123

**Karyawan:**
- Email: karyawan@karyawan.com
- Password: karyawan123

## 🗃️ Struktur Database

### Tabel Utama:
- `users` - Data pengguna (admin, karyawan)
- `employees` - Data karyawan
- `attendances` - Data absensi
- `shifts` - Data shift kerja
- `departments` - Data departemen
- `positions` - Data jabatan

## 📱 Penggunaan

### Untuk Admin:
1. Login menggunakan akun admin
2. Kelola data karyawan di menu Master Data
3. Atur shift kerja dan jam operasional
4. Monitor absensi karyawan realtime
5. Generate laporan absensi

### Untuk Karyawan:
1. Login menggunakan akun karyawan
2. Lakukan absensi masuk di halaman dashboard
3. Lakukan absensi pulang saat selesai bekerja
4. Lihat riwayat absensi pribadi
5. Lihat jadwal shift kerja

## 🔒 Keamanan

- Implementasi authentication dan authorization
- Validasi input untuk mencegah SQL injection
- CSRF protection pada semua form
- Password hashing menggunakan bcrypt
- Session management yang aman

## 📊 Fitur Laporan

- Laporan absensi harian
- Laporan absensi bulanan
- Laporan keterlambatan
- Laporan overtime
- Export ke format Excel dan PDF

## 🎨 Kustomisasi

### Mengubah Logo
Ganti file logo di `public/images/logo.png`

### Mengubah Warna Theme
Edit file CSS di `resources/css/app.css`

### Menambah Fitur Baru
Ikuti struktur MVC Laravel yang sudah ada

## 🐛 Troubleshooting

### Masalah Umum:

**1. Error 500 - Internal Server Error**
```bash
# Pastikan permission folder storage dan bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

**2. Database Connection Error**
- Pastikan MySQL service berjalan
- Periksa konfigurasi database di file `.env`
- Pastikan database sudah dibuat

**3. Assets Not Loading**
```bash
# Rebuild assets
npm run dev
php artisan cache:clear
```

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan ikuti langkah berikut:

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b feature/fitur-baru`)
3. Commit perubahan (`git commit -am 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin feature/fitur-baru`)
5. Buat Pull Request
---

⭐ Jika proyek ini bermanfaat, jangan lupa untuk memberikan star di repository ini!
