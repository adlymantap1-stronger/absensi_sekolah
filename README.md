# Absensi Sekolah — Student Attendance System

Sistem pencatatan dan pemantauan kehadiran siswa berbasis web, dibangun menggunakan TALL Stack (Tailwind CSS, Alpine.js, Laravel, Livewire). Sistem ini menggantikan pencatatan absensi manual berbasis kertas dengan sistem digital yang memudahkan wali kelas dan admin mencatat, merekap, dan memantau kehadiran siswa.

## 🎯 Latar Belakang

Sekolah membutuhkan sistem sederhana untuk mencatat dan memantau kehadiran siswa setiap hari. Proses pencatatan manual menggunakan kertas rentan kehilangan data, sulit direkap, dan tidak efisien ketika wali kelas atau admin ingin melihat riwayat kehadiran siswa dalam periode tertentu.

## 🛠️ Tech Stack

| Layer | Teknologi |
|---|---|
| Backend | Laravel 11/12, PHP 8.2+ |
| Frontend | Tailwind CSS, Alpine.js |
| Komponen Interaktif | Livewire 3 |
| Database | MySQL |
| Autentikasi | Laravel Breeze (Livewire stack) |

## ✨ Fitur

### Authentication
- Login & Logout
- Role-based access: **Admin** dan **Wali Kelas**

### Dashboard
- Ringkasan total siswa & jumlah kelas
- Ringkasan kehadiran hari ini (Hadir, Sakit, Izin, Alpa)
- Statistik kehadiran 7 hari terakhir (bar chart)

### Student Management
- CRUD data siswa (Create, Read, Update, Delete — dengan soft delete)
- Pencarian & filter siswa berdasarkan nama dan kelas
- Halaman detail profil siswa (statistik & riwayat kehadiran individual)

### Attendance
- Input absensi harian per kelas (massal, satu form untuk satu kelas)
- Status kehadiran: Hadir, Sakit, Izin, Alpa
- Mode "Semua Kelas" untuk melihat status kehadiran seluruh siswa hari itu (read-only, dipaginate)
- Form otomatis terkunci setelah tersimpan untuk mencegah submit ulang di hari yang sama

### Attendance List
- Riwayat absensi berdasarkan tanggal
- Filter berdasarkan kelas
- Filter berdasarkan nama siswa

### Attendance Report
- Rekap bulanan kehadiran per siswa
- Persentase kehadiran per siswa
- Export laporan ke CSV

## 📌 Business Rule

- Satu siswa hanya boleh memiliki satu catatan absensi per hari (dijamin lewat unique constraint database + `updateOrCreate`)
- Tanggal absensi wajib diisi
- Tidak boleh ada data absensi duplikat
- Kelas tingkat XIII hanya tersedia untuk jurusan SIJA

## 🗂️ Struktur Data

- **majors** — data jurusan (LPB, DKV, SIJA)
- **class_rooms** — data kelas per tingkat & jurusan, terhubung ke wali kelas
- **students** — data siswa, terhubung ke kelas
- **attendances** — catatan kehadiran harian siswa
- **users** — akun pengguna sistem (Admin / Wali Kelas)

## 🚀 Instalasi

### Prasyarat
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL

### Langkah instalasi

\`\`\`bash
# 1. Clone repository
git clone https://github.com/adlymantap1-stronger/absensi_sekolah.git
cd absensi_sekolah

# 2. Install dependency PHP
composer install

# 3. Install dependency JS
npm install

# 4. Salin file environment
cp .env.example .env
php artisan key:generate

# 5. Konfigurasi database di .env
# DB_DATABASE=absensi_sekolah
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Jalankan migration & seeder
php artisan migrate --seed

# 7. Build asset frontend
npm run build

# 8. Jalankan server
php artisan serve
\`\`\`

Akses aplikasi di `http://localhost:8000` (atau domain lokal seperti `absensi-sekolah.test` jika menggunakan Laragon).

## 🔑 Akun Demo

| Role | Email | Password |
|---|---|---|
| Admin | admin@example.com | password |
| Wali Kelas | walikelas@example.com | password |

## 📁 Struktur Folder Penting

\`\`\`
app/
├── Livewire/
│   ├── Dashboard.php
│   ├── Students/       (Index, Show)
│   ├── Attendances/    (Create, Index)
│   └── Reports/        (Index)
├── Models/              (User, Major, ClassRoom, Student, Attendance)
├── Rules/               (UniqueAttendancePerDay)
└── Services/            (AttendanceStatsService)

resources/views/livewire/  → tampilan Blade untuk tiap komponen Livewire
database/migrations/       → skema seluruh tabel
database/seeders/          → data dummy (jurusan, kelas, siswa, akun)
\`\`\`

## 🧑‍💻 Standar Kode

- Mengikuti PSR-12
- Nama tabel: `snake_case`, plural
- Nama model: `PascalCase`, singular
- Logic bisnis dipisahkan ke Service class untuk kalkulasi statistik
- Validasi dilakukan di sisi server menggunakan mekanisme validasi Livewire dan Custom Validation Rule