## Zenith Hotel

Sistem manajemen hotel berbasis web yang dibangun menggunakan **Laravel**. Aplikasi ini menyediakan fitur pemesanan kamar, manajemen pelanggan, pembayaran, dan laporan keuangan.

## 🛠️ Teknologi Yang Digunakan

- **PHP** v8.3.15
- **Laravel** v12 (PHP Framework)
- **Mysql** (Database)
- **Blade** (Template Engine)
- **Bootstrap** (Frontend UI)
- **Composer** (Dependency Manager)

## 📌 Fitur Utama

- Pemesanan kamar hotel
- Manajemen pelanggan & admin
- Sistem pembayaran
- Pencarian kamar hotel berdasarkan tanggal, harga dan tipe kamar
- Soft deleted (berfungsi untuk menghapus data, tapi data tersebut tidak sepenuhnya terhapus. Melainkan data tersebut hanya dinonaktifkan)
- Laporan transaksi
- Role-based access control (Admin & Customer)
- Banner dan profil dapat berubah sesuai jenis kelamin di halaman dashboard admin dan customer
- Update status kamar dan status pemesanan secara otomatis

## 🚀 Instalasi

Pastikan Anda sudah menginstal **PHP** dan **Composer** sebelum menginstal.

### 1. Download project

### 2. Instal Dependensi Laravel
```sh
composer install
```

### 3. Konfigurasi Environment
Salin semua isi file di .env.example ke file .env:

### 4. Melakukan Migrasi
```sh
php artisan migrate
```

### 5. Generate Application Key
```sh
php artisan key:generate
```

### 6. Buat Folder GambarFasilitas dan GambarKamar
```sh
mkdir -p storage/app/public/GambarFasilitas
mkdir -p storage/app/public/GambarKamar
chmod -R 775 storage/app/public/GambarFasilitas
chmod -R 775 storage/app/public/GambarKamar
php artisan storage:link
```

### 7. Buat Akun Admin & Customer
Ketik php artisan tinker di terminal, lalu salin dengan perintah di bawah ini
```sh
use App\Models\User;

User::create([
    'name' => 'Admin',
    'username' => 'admin',
    'role' => 'Admin',
    'jenis_kelamin' => 'Laki-laki',
    'no_hp' => '081234567891',
    'email' => 'admin@gmail.com',
    'password' => bcrypt('admin123')
]);
User::create([
    'name' => 'Customer',
    'username' => 'customer',
    'role' => 'Customer',
    'jenis_kelamin' => 'Perempuan',
    'no_hp' => '081234567892',
    'email' => 'customer@gmail.com',
    'password' => bcrypt('password123')
]);
```
perintah ini akan membuat akun Admin dan Customer

### 8. Menjalankan Aplikasi
```sh
php artisan serve
```

### 9. NPM Install (Opsional)
```sh
npm install
```

### 10. Update Status Reservasi
Jalankan perintah ini setiap hari. Perintah ini berguna saat status reservasi telah melebihi batas tanggal checkout, maka akan membuat status pemesanan menjadi complete dan status kamar akan menjadi tersedia kembali secara otomatis.
contohnya saat anda melakukan checkin di tanggal 25-05-2025 dan checkout di tanggal 26-05-2025, maka di tanggal 26-05-2025 jam 01.00.00 maka status pemesanan telah berubah menjadi complete dan status kamar akan berubah menjadi tersedia kembali.
```sh
php artisan reservasi:update-status
```

## 💡Sedikit Informasi

Kami sudah sediakan asset gambar kamar dan fasilitas, supaya kalian dapat langsung memulai project tanpa perlu memikirkan asset gambar kamar dan fasilitas.
```sh
public/
└── dashboard/
    └── asset/
        ├── fasilitas/
        │   ├── area-bowling/
        │   ├── area-panahan/
        │   ├── bar/
        │   ├── cafe/
        │   ├── chinese-food/
        │   ├── game-center/
        │   ├── gym/
        │   ├── indonesian-food/
        │   ├── japanese-food/
        │   ├── karaoke/
        │   ├── kolam-renang/
        │   ├── korean-food/
        │   ├── lapangan-basket/
        │   ├── lapangan-golf/
        │   ├── lapangan-sepak-bola/
        │   ├── lapangan-tenis/
        │   ├── lapangan-voli/
        │   ├── ruang-rapat/
        │   ├── sauna/
        │   └── spa/
        └── kamar/
```