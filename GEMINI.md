# GEMINI.md - Panduan Pengembangan WebOnlinePakPras

Project ini adalah platform E-Commerce (Toko Online) berbasis **Laravel 12** yang dirancang dengan arsitektur bersih, modular, dan modern menggunakan **Bootstrap 4** sebagai UI Framework.

---

## 🚀 Fitur Utama

### 1. Sistem Katalog (Produk & Kategori)
- **Manajemen Kategori:** CRUD lengkap dengan sistem *auto-slug*.
- **Manajemen Produk:** 
  - Upload gambar ke `storage` (otomatis hapus file lama).
  - Sistem Stok otomatis (peringatan stok rendah < 5).
  - Harga Coret/Promo (mendukung `promo_price`).
  - Penanda Produk Terbaru (`is_new`).

### 2. Autentikasi & Multi-User Role
- **Sistem Auth:** Menggunakan `laravel/ui` (Bootstrap 4).
- **Role Management:**
  - **Admin:** Akses penuh ke Dashboard, CRUD Produk, Kategori, dan Manajemen Transaksi.
  - **Customer:** Akses belanja, keranjang, checkout, dan riwayat pesanan.
- **Middleware Keamanan:** Proteksi ketat menggunakan middleware `IsAdmin`.

### 3. Shopping Cart & Checkout
- **Database-Backed Cart:** Keranjang belanja tersimpan di database (sinkron antar device).
- **Stok Validation:** Pengecekan stok real-time saat tambah ke keranjang & saat checkout.
- **DB Transactions:** Proses checkout aman (atomik). Jika gagal, stok tidak akan berkurang.
- **Auto Invoice:** Penomoran invoice unik otomatis.

### 4. Transaksi & Riwayat
- **Manajemen Order (Admin):** Update status pesanan (Pending, Processing, Completed, Cancelled).
- **Riwayat Pesanan (Customer):** Monitoring status pesanan secara real-time.

---

## 🛠️ Tech Stack & Database Schema

- **Framework:** Laravel 12 (PHP 8.2+)
- **Database:** SQLite (File: `database/database.sqlite`)
- **Frontend:** Bootstrap 4, FontAwesome, Google Fonts (Outfit)

### Tabel Utama:
- `users`: Data akun & role.
- `categories`: Kategori produk.
- `products`: Detail katalog produk.
- `carts`: Item keranjang belanja user.
- `orders`: Data transaksi/invoice utama.
- `order_items`: Detail produk di setiap invoice (snapshot harga).

---

## 📦 Panduan Instalasi (Local)

1. **Clone & Setup:**
   ```bash
   composer install
   npm install && npm run build
   ```
2. **Environment:**
   Pastikan `.env` menggunakan:
   ```env
   DB_CONNECTION=sqlite
   ```
3. **Database Setup:**
   ```bash
   # Buat file database jika belum ada
   touch database/database.sqlite
   
   # Jalankan migrasi & seeder
   php artisan migrate --seed
   
   # Hubungkan folder upload gambar
   php artisan storage:link
   ```
4. **Run Server:**
   ```bash
   php artisan serve
   ```

---

## 🔑 Akun Default (Testing)

| Role | Email | Password |
|------|-------|----------|
| **Admin** | `admin@sekolah.com` | `password` |
| **Customer** | `customer@sekolah.com` | `password` |

---

## 💡 Arsitektur Kode (Best Practice)

- **Controllers:** Dipisahkan antara `Frontend` (Customer) dan `Admin` (Backend).
- **Models:** Menggunakan relasi Eloquent (`hasMany`, `belongsTo`) yang kuat.
- **Layouts:** Menggunakan `@extends` dan `@section` untuk efisiensi UI (Template Frontend vs Template Admin).
- **Middleware:** Penempatan `is_admin` di rute grup untuk keamanan maksimal.

---

## 📌 Rencana Pengembangan Selanjutnya (Roadmap)
- [ ] Integrasi Payment Gateway (Midtrans/Xendit).
- [ ] Integrasi API RajaOngkir untuk hitung ongkir otomatis.
- [ ] Fitur Chat Admin & Customer.
- [x] Sistem Laporan Penjualan (Export PDF/Excel).

---
*Dibuat oleh Gemini CLI - Senior Full-Stack Developer AI*
