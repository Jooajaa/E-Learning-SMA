**Perubahan sejak template Laravel**

- **Dependencies (composer):** ditambahkan paket pihak ketiga: `barryvdh/laravel-dompdf`, `maatwebsite/excel`, `spatie/laravel-permission`. Lihat [LMS_SMA/composer.json](LMS_SMA/composer.json).

- **Dev / Frontend (npm):** proyek menggunakan Vite + Tailwind; paket utama: `vite`, `tailwindcss`, `postcss`, `autoprefixer`, `@tailwindcss/forms`, `alpinejs`, `laravel-vite-plugin`, `concurrently`. Lihat [LMS_SMA/package.json](LMS_SMA/package.json), [LMS_SMA/tailwind.config.js](LMS_SMA/tailwind.config.js), [LMS_SMA/postcss.config.js](LMS_SMA/postcss.config.js).

- **Auth scaffolding (Laravel Breeze):** struktur route dan controller auth ditambahkan/diubah — lihat [LMS_SMA/routes/auth.php](LMS_SMA/routes/auth.php) dan controller di [LMS_SMA/app/Http/Controllers/Auth](LMS_SMA/app/Http/Controllers/Auth).

- **Role & Permission:** paket Spatie diintegrasikan:
  - Config: [LMS_SMA/config/permission.php](LMS_SMA/config/permission.php)
  - Migration: [LMS_SMA/database/migrations/2026_05_20_142033_create_permission_tables.php](LMS_SMA/database/migrations/2026_05_20_142033_create_permission_tables.php)
  - Seeder: [LMS_SMA/database/seeders/RoleSeeder.php](LMS_SMA/database/seeders/RoleSeeder.php)
  - Model user mengunakan trait `HasRoles`: [LMS_SMA/app/Models/User.php](LMS_SMA/app/Models/User.php)

- **Fitur / Struktur aplikasi tambahan:** ditambahkan controller dan layout untuk peran sekolah (contoh: `Admin`, `Guru`, `Siswa`) dan komponen layout Breeze:
  - Controllers: lihat [LMS_SMA/app/Http/Controllers](LMS_SMA/app/Http/Controllers)
  - View components: lihat [LMS_SMA/app/View/Components](LMS_SMA/app/View/Components)

- **Seeder & Testing:** ada seeder contoh dan test fitur auth yang disertakan. Lihat [LMS_SMA/database/seeders](LMS_SMA/database/seeders) dan [LMS_SMA/tests](LMS_SMA/tests).

- **Composer scripts & setup:** `composer.json` menyertakan skrip `setup`, `dev`, dan hooks pasca-install untuk publikasi aset. Lihat [LMS_SMA/composer.json](LMS_SMA/composer.json).

**Perintah cepat untuk menjalankan / menginisialisasi proyek:**

```bash
composer install
npm install
php artisan key:generate
php artisan migrate --seed
npm run dev
php artisan serve
```

Jika mau, saya bisa:
- Menambahkan README langsung ke `README.md` utama (overwrite) atau commit file ini.
- Menjalankan perintah setup (jika Anda ingin saya jalankan saya butuh izin untuk akses terminal).
