<p align="center">
  <h1 align="center">Fashion Icon Purwokerto</h1>
  <p align="center">E-Commerce Platform untuk Fashion Terlengkap di Purwokerto</p>
</p>

<p align="center">
<a href="#"><img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel Version"></a>
<a href="#"><img src="https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css" alt="Tailwind CSS"></a>
<a href="#"><img src="https://img.shields.io/badge/Filament-3.x-FDAE4B?style=for-the-badge" alt="Filament"></a>
<a href="#"><img src="https://img.shields.io/badge/Midtrans-Payment-00A8E1?style=for-the-badge" alt="Midtrans"></a>
</p>

## Tentang Fashion Icon Purwokerto

Fashion Icon Purwokerto adalah platform e-commerce modern yang menyediakan berbagai koleksi fashion terlengkap di Purwokerto. Website ini dibangun dengan teknologi terkini untuk memberikan pengalaman berbelanja online yang mudah, cepat, dan aman.

### Teknologi yang Digunakan

- **[Laravel](https://laravel.com)** - Framework PHP untuk backend yang robust dan scalable
- **[Blade Templates](https://laravel.com/docs/blade)** - Template engine untuk tampilan yang dinamis
- **[Tailwind CSS](https://tailwindcss.com)** - Framework CSS utility-first untuk desain responsif
- **[Filament](https://filamentphp.com)** - Admin panel yang powerful dan elegant
- **[Midtrans](https://midtrans.com)** - Payment gateway untuk transaksi yang aman

## Fitur Utama

### Untuk Customer
- **Katalog Produk** - Jelajahi berbagai koleksi fashion dengan tampilan yang menarik dan informatif
- **Keranjang Belanja** - Tambahkan produk favorit ke keranjang dengan mudah
- **Checkout Process** - Proses pemesanan yang simpel dan user-friendly
- **Payment Gateway** - Integrasi dengan Midtrans untuk berbagai metode pembayaran (Transfer Bank, E-Wallet, Kartu Kredit, dll)
- **Riwayat Pesanan** - Lacak status pesanan Anda secara real-time
- **Profil Pelanggan** - Kelola informasi dan alamat pengiriman

### Untuk Admin
- **Dashboard Filament** - Panel administrasi yang modern dan intuitif
- **Manajemen Produk** - Kelola katalog produk, stok, harga, dan kategori
- **Manajemen Pesanan** - Monitor dan update status pesanan pelanggan
- **Manajemen Pelanggan** - Kelola data dan aktivitas pelanggan
- **Manajemen Ongkos kirim** - Kelola data dan Ongkos Kirim

## Sistem Role

Website ini mengimplementasikan sistem role-based access control (RBAC):

| Role | Akses | Deskripsi |
|------|-------|-----------|
| **Customer** | Frontend | Dapat melihat produk, berbelanja, dan mengelola pesanan mereka |
| **Admin** | Filament Dashboard | Memiliki akses penuh untuk mengelola seluruh sistem e-commerce |

## Instalasi

### Persyaratan Sistem
- PHP >= 8.2
- Composer
- MySQL 
- Web Server

### Langkah Instalasi

1. Clone repository
```bash
git clone https://github.com/namagithub/laravel_ecommerce.git
cd laravel_ecommerce
```

2. Install dependencies
```bash
composer install
```

3. Konfigurasi environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Setup database di file `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=namadatabase
DB_USERNAME=root
DB_PASSWORD=
```

5. Konfigurasi Midtrans di file `.env`
```env
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false
```

6. Jalankan migrasi dan seeder
```bash
php artisan migrate --seed
```

7. Jalankan aplikasi
```bash
php artisan serve
```

Website dapat diakses di `http://localhost:8000`

## Akses Admin Panel

Admin panel menggunakan Filament dan dapat diakses melalui:
- URL: `http://localhost:8000/admin`
- Default credentials akan dibuat saat seeding database
- email : admin@fip.com
- pass : adminfip

## Konfigurasi Payment Gateway

Untuk mengaktifkan Midtrans payment gateway:

1. Daftar di [Midtrans](https://midtrans.com)
2. Dapatkan Server Key dan Client Key dari dashboard Midtrans
3. Masukkan kredensial ke file `.env`
4. Test mode: gunakan [kartu test Midtrans](https://docs.midtrans.com/docs/testing-payment)
```

<p align="center">Made with ❤️ in Purwokerto</p>