
<h1 align="center"> SIMU-PEI
</h1>
<p align="center">
  <img src="https://thumb.wikimedia.org/wikipedia/commons/thumb/7/78/Logo-pei.png/500px-Logo-pei.png" width="150" alt="Logo PEI">
</p>

<p align="center">
  <b>Sistem Informasi Manajemen Ujian - Politeknik Enjinering Indorama</b>
</p>

---

##  Tentang SIMU-PEI

**SIMU-PEI** (Sistem Informasi Manajemen Ujian PEI) adalah sebuah aplikasi web berbasis Laravel yang dirancang untuk mengelola berbagai aspek yang berkaitan dengan ujian di lingkungan Kampus Politeknik Enjinering Indorama (PEI).

Sistem ini membantu dalam proses manajemen ujian mulai dari pembuatan soal, pengaturan jadwal ujian, hingga review dan persetujuan soal ujian.

##  Fitur Utama

###  Manajemen User
- CRUD (Create, Read, Update, Delete) data pengguna
- Pencarian pengguna
- Multi-role: Admin, Kaprodi, Dosen, Mahasiswa

###  Manajemen Mata Kuliah
- CRUD data mata kuliah
- Integrasi dengan Program Studi
- Penugasan dosen pengampu

###  Manajemen Program Studi
- CRUD data program studi
- Data Ketua Program Studi

###  Manajemen Soal
- Upload dan kelola bank soal
- Klasifikasi soal berdasarkan mata kuliah
- Support file attachment

###  Manajemen Ujian
- Pembuatan jadwal ujian
- Pengaturan tipe soal (Pilihan Ganda, Essay, Campuran)
- Pengaturan durasi dan sifat ujian
- Status persetujuan ujian
- Generate PDF soal ujian

###  Review & Persetujuan
- Review soal ujian oleh Kaprodi
- Sistem persetujuan/revisi soal
- Komentar dan feedback

##  Teknologi yang Digunakan

- **Framework**: Laravel 9
- **Database**: MySQL
- **Frontend**: Blade Template, Bootstrap (Corona Admin Template)
- **PDF Generator**: DomPDF

##  Struktur Database

| Tabel | Deskripsi |
|-------|-----------|
| `users` | Data pengguna sistem |
| `tb_prodi` | Data program studi |
| `tb_matkul` | Data mata kuliah |
| `tb_ujian` | Data ujian |
| `tb_soal` | Data soal ujian |

##  Instalasi

### Prasyarat
- PHP >= 8.1
- Composer
- MySQL
- Node.js & NPM

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/username/simu-pei.git
   cd simu-pei
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi database di file `.env`**
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=simu_pei
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan migrasi dan seeder**
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Jalankan aplikasi**
   ```bash
   php artisan serve
   ```

7. **Akses aplikasi di browser**
   ```
   http://localhost:8000
   ```

## 👥 Akun Default

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@gmail.com | admin123 |
| Dosen | udin@gmail.com | udin |
| Dosen | budi@gmail.com | budi123 |
| Mahasiswa | ahmad@gmail.com | ahmad123 |
| Mahasiswa | siti@gmail.com | siti123 |
| Mahasiswa | rizky@gmail.com | rizky123 |

##  Role dan Hak Akses

| Role | Hak Akses |
|------|-----------|
| **Admin** | Mengelola semua data master (User, Prodi, Matkul) |
| **Kaprodi** | Review dan approve/revisi soal ujian, melihat ujian di prodinya |
| **Dosen** | Membuat soal ujian, mengelola bank soal, membuat jadwal ujian |
| **Mahasiswa** | Melihat jadwal ujian |

##  Struktur Folder Utama

```
├── app/
│   ├── Http/Controllers/
│   │   ├── LoginController.php
│   │   ├── PDFController.php
│   │   └── ProjectAkhirController.php
│   └── Models/
│       ├── User.php
│       ├── tbProdi.php
│       ├── tbMatkul.php
│       ├── tbUjian.php
│       └── tbSoal.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── admin/
│       ├── dashboard.blade.php
│       ├── login.blade.php
│       └── ...
└── routes/
    └── web.php
```

##  Pengembang

- **Nama**: M. Rafli Kamal
- **NIM**: 202204013
- **Program Studi**: Teknologi Rekayasa Perangkat Lunak
- **Mata Kuliah**: Pemrograman Web 3

##  Lisensi

Proyek ini dikembangkan untuk keperluan akademik di Politeknik Enjinering Indorama.

---

