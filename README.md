# 🎓 Absensi Sekolah — Student Attendance System

Sistem pencatatan dan pemantauan kehadiran siswa berbasis web, dibangun menggunakan **TALL Stack** (Tailwind CSS, Alpine.js, Laravel, Livewire). Sistem ini menggantikan pencatatan absensi manual berbasis kertas dengan sistem digital yang memudahkan wali kelas dan admin mencatat, merekap, dan memantau kehadiran siswa secara efisien.

![Laravel](https://img.shields.io/badge/Laravel-11%2F12-FF2D20?logo=laravel)
![Livewire](https://img.shields.io/badge/Livewire-3-4E56A6?logo=livewire)
![Tailwind](https://img.shields.io/badge/Tailwind-CSS-38B2AC?logo=tailwindcss)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?logo=mysql)

---

## 📖 Daftar Isi

- [Latar Belakang](#-latar-belakang)
- [Tech Stack](#️-tech-stack)
- [Fitur](#-fitur)
- [Business Rule](#-business-rule)
- [Struktur Data](#️-struktur-data)
- [Instalasi (Laragon)](#-instalasi-laragon--nginx--mysql)
- [Akun Demo](#-akun-demo)
- [Role & Hak Akses](#-role--hak-akses)
- [Testing](#-testing)
- [API Endpoint](#-api-endpoint)
- [Struktur Folder](#-struktur-folder-penting)
- [Standar Kode](#-standar-kode)
- [Screenshot Aplikasi](#-screenshot-aplikasi)

---

## 🎯 Latar Belakang

Sekolah membutuhkan sistem sederhana untuk mencatat dan memantau kehadiran siswa setiap hari. Proses pencatatan manual menggunakan kertas rentan terhadap kehilangan data, sulit direkap, dan tidak efisien ketika wali kelas atau admin ingin melihat riwayat kehadiran siswa dalam periode tertentu.

Melalui project ini, dibangun sebuah **Student Attendance System** berbasis web menggunakan Laravel yang dapat mencatat data siswa, mencatat kehadiran harian, serta menampilkan rekap dan laporan absensi secara digital.

## 🛠️ Tech Stack

| Layer | Teknologi |
|---|---|
| Backend | Laravel 11/12, PHP 8.2+ |
| Frontend | Tailwind CSS, Alpine.js |
| Komponen Interaktif | Livewire 3 |
| Database | MySQL |
| Autentikasi Web | Laravel Breeze (Livewire stack) |
| Autentikasi API | Laravel Sanctum |
| Local Development | Laragon (Nginx, port 80) |

## ✨ Fitur

### 🔐 Authentication
- Login & Logout
- Register akun baru (otomatis mendapat role **Wali Kelas**)
- Role-based access: **Admin** dan **Wali Kelas**

### 📊 Dashboard
- Ringkasan total siswa & jumlah kelas
- Ringkasan kehadiran hari ini (Hadir, Sakit, Izin, Alpa)
- Statistik kehadiran 7 hari terakhir (bar chart)

### 👥 Student Management
- CRUD data siswa (Create, Read, Update, Delete — dengan soft delete)
- Pencarian & filter siswa berdasarkan nama dan kelas
- Halaman detail profil siswa (statistik & riwayat kehadiran individual)

### ✅ Attendance
- Input absensi harian per kelas (massal, satu form untuk satu kelas)
- Status kehadiran: Hadir, Sakit, Izin, Alpa
- Mode "Semua Kelas" untuk melihat status kehadiran seluruh siswa hari itu (read-only, dipaginate)
- Form otomatis terkunci setelah tersimpan, mencegah submit ulang di hari yang sama

### 📋 Attendance List
- Riwayat absensi berdasarkan tanggal
- Filter berdasarkan kelas
- Filter berdasarkan nama siswa

### 📈 Attendance Report
- Rekap bulanan kehadiran per siswa
- Persentase kehadiran per siswa
- Export laporan ke CSV

### 🎁 Fitur Tambahan
- 🗑️ Soft Delete pada data siswa, kelas, jurusan, dan absensi
- 📅 Kalender kehadiran bulanan per kelas (visual, warna berdasarkan persentase)
- 🌙 Dark Mode dengan preferensi tersimpan di browser
- 🔌 REST API dengan autentikasi token (Sanctum)

## 📌 Business Rule

- Satu siswa hanya boleh memiliki satu catatan absensi per hari (dijamin lewat unique constraint database + `updateOrCreate`)
- Tanggal absensi wajib diisi
- Tidak boleh ada data absensi duplikat
- Kelas tingkat **XIII** hanya tersedia untuk jurusan **SIJA**

## 🗂️ Struktur Data

| Tabel | Deskripsi |
|---|---|
| `majors` | Data jurusan (LPB, DKV, SIJA) |
| `class_rooms` | Data kelas per tingkat & jurusan, terhubung ke wali kelas |
| `students` | Data siswa, terhubung ke kelas |
| `attendances` | Catatan kehadiran harian siswa |
| `users` | Akun pengguna sistem (Admin / Wali Kelas) |

Semua tabel menggunakan foreign key untuk relasi dan mendukung soft delete.

## 🚀 Instalasi (Laragon + Nginx + MySQL)

### Prasyarat
- [Laragon](https://laragon.org/) (dengan Nginx aktif di port 80, MySQL di port 3306)
- PHP 8.2+
- Composer
- Node.js & NPM

### Langkah instalasi

```bash
# 1. Masuk ke folder www Laragon, lalu clone repository
cd C:\laragon\www
git clone https://github.com/adlymantap1-stronger/absensi_sekolah.git
cd absensi_sekolah

# 2. Install dependency PHP
composer install

# 3. Install dependency JS
npm install

# 4. Salin file environment
cp .env.example .env
php artisan key:generate
```

### Konfigurasi `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=absensi_sekolah
DB_USERNAME=root
DB_PASSWORD=
```

### Lanjutkan instalasi

```bash
# 5. Buat database (via HeidiSQL bawaan Laragon, atau command line)
mysql -u root -e "CREATE DATABASE absensi_sekolah"

# 6. Jalankan migration & seeder
php artisan migrate --seed

# 7. Build asset frontend
npm run build
```

### Menjalankan aplikasi

1. Buka aplikasi **Laragon**, klik **Start All** (mengaktifkan Nginx port 80 & MySQL port 3306)
2. Laragon otomatis membuat virtual host berdasarkan nama folder — akses aplikasi di: http://absensi-sekolah.test
Jika domain `.test` belum terdeteksi, klik kanan ikon Laragon di system tray → **Reload**, atau gunakan `http://localhost/absensi_sekolah/public` sebagai alternatif.

## 🔑 Akun Demo

| Role | Email | Password | Akses |
|---|---|---|---|
| Admin | `admin@example.com` | `password` | Akses penuh ke semua data |
| Wali Kelas | `walikelas@example.com` | `password` | Akun wali kelas contoh |

> **Catatan:** akun baru yang dibuat melalui halaman **Register** akan otomatis mendapat role **Wali Kelas** (sesuai nilai default kolom `role` pada tabel `users`). Role **Admin** hanya tersedia melalui akun seeder di atas.

## 👤 Role & Hak Akses

| Role | Deskripsi |
|---|---|
| **Admin** | Akses penuh ke seluruh fitur: data siswa, absensi, laporan, dan kalender di semua kelas |
| **Wali Kelas** | Akun untuk guru wali kelas, dapat mengakses seluruh modul sistem |

Role ditampilkan sebagai badge berwarna di navbar (ungu untuk Admin, biru untuk Wali Kelas) agar mudah dibedakan saat login.

## 🧪 Testing

Project ini dilengkapi automated test untuk memverifikasi business rule dan fungsi CRUD:

```bash
php artisan test
```

Cakupan test:
- **AttendanceBusinessRuleTest** — memverifikasi aturan satu siswa satu absensi per hari, dan `updateOrCreate` tidak menghasilkan duplikat
- **StudentCrudTest** — memverifikasi create, validasi, update, soft delete, dan pencarian siswa

## 🔌 API Endpoint

Aplikasi menyediakan REST API dengan autentikasi token (Laravel Sanctum):

| Method | Endpoint | Deskripsi |
|---|---|---|
| GET | `/api/students` | Daftar seluruh siswa (dengan relasi kelas & jurusan) |
| GET | `/api/students/{id}` | Detail satu siswa |
| GET | `/api/attendances` | Daftar absensi, dapat difilter via query `date` dan `class_room_id` |

Semua endpoint memerlukan header `Authorization: Bearer <token>`. Token dapat dibuat melalui `php artisan tinker`:

```php
$token = App\Models\User::first()->createToken('nama-token')->plainTextToken;
```

## 📁 Struktur Folder Penting
app/
├── Livewire/
│   ├── Dashboard.php
│   ├── Students/           (Index, Show)
│   ├── Attendances/        (Create, Index, Calendar)
│   └── Reports/            (Index)
├── Models/                 (User, Major, ClassRoom, Student, Attendance)
├── Rules/                  (UniqueAttendancePerDay)
└── Services/                (AttendanceStatsService)

resources/views/livewire/   → tampilan Blade untuk tiap komponen Livewire
database/migrations/        → skema seluruh tabel
database/seeders/           → data dummy (jurusan, kelas, siswa, akun)
tests/Feature/               → automated test
routes/web.php               → route halaman web
routes/api.php                → route API

## 🧑‍💻 Standar Kode

- Mengikuti standar **PSR-12**
- Nama tabel: `snake_case`, plural
- Nama model: `PascalCase`, singular
- Logika bisnis dipisahkan ke **Service class** untuk kalkulasi statistik
- Business rule kompleks didokumentasikan lewat **Custom Validation Rule**
- Validasi dilakukan di sisi server menggunakan mekanisme validasi Livewire
- Komponen Blade reusable digunakan sebagai basis tampilan Livewire

## 📸 Screenshot Aplikasi

### Login
![Login](docs/screenshots/01-login.png)

### Dashboard
![Dashboard](docs/screenshots/02-dashboard.png)

### Data Siswa
![Data Siswa](docs/screenshots/03-data-siswa.png)

### Detail Profil Siswa
![Detail Siswa](docs/screenshots/04-detail-siswa.png)

### Input Absensi
![Absensi](docs/screenshots/05-absensi.png)

### Riwayat Absensi
![Riwayat Absensi](docs/screenshots/06-riwayat-absensi.png)

### Laporan Kehadiran
![Laporan](docs/screenshots/07-laporan.png)

### Kalender Kehadiran
![Kalender](docs/screenshots/08-kalender.png)

### Dark Mode
![Dark Mode](docs/screenshots/09-dark-mode.png)

---

**Dibuat sebagai bagian dari Mini Project Assessment — Student Attendance System.**