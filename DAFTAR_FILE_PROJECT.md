# DAFTAR FILE PROJECT

```text
E-Learning-SMA/
|-- routes/
|   |-- web.php
|   `-- auth.php
|-- app/
|   |-- Http/
|   |   `-- Controllers/
|   |       |-- Admin/
|   |       |   |-- DashboardController.php
|   |       |   |-- GuruController.php
|   |       |   |-- ImportController.php
|   |       |   |-- KelasController.php
|   |       |   |-- MapelController.php
|   |       |   |-- PenugasanController.php
|   |       |   |-- ResetPasswordController.php
|   |       |   `-- SiswaController.php
|   |       |-- Guru/
|   |       |   `-- DashboardController.php
|   |       |-- Siswa/
|   |       |   `-- DashboardController.php
|   |       `-- Auth/
|   |           |-- AuthenticatedSessionController.php
|   |           |-- ConfirmablePasswordController.php
|   |           |-- EmailVerificationNotificationController.php
|   |           |-- EmailVerificationPromptController.php
|   |           |-- NewPasswordController.php
|   |           |-- PasswordController.php
|   |           |-- PasswordResetLinkController.php
|   |           |-- RegisteredUserController.php
|   |           `-- VerifyEmailController.php
|   |-- Models/
|   |   |-- GuruKelas.php
|   |   |-- GuruMapel.php
|   |   |-- Kelas.php
|   |   |-- MataPelajaran.php
|   |   |-- SiswaKelas.php
|   |   `-- User.php
|   `-- Imports/
|       |-- GuruImport.php
|       `-- SiswaImport.php
|-- database/
|   |-- migrations/
|   |   |-- 0001_01_01_000000_create_users_table.php
|   |   |-- 0001_01_01_000001_create_cache_table.php
|   |   |-- 0001_01_01_000002_create_jobs_table.php
|   |   |-- 2026_05_20_142033_create_permission_tables.php
|   |   |-- 2026_05_28_163322_create_kelas_table.php
|   |   |-- 2026_05_28_163322_create_mata_pelajarans_table.php
|   |   |-- 2026_05_28_163323_create_guru_mapels_table.php
|   |   |-- 2026_05_28_163323_create_siswa_kelas_table.php
|   |   |-- 2026_05_28_173233_create_guru_kelas_table.php
|   |   |-- 2026_05_31_171819_add_nis_nip_status_to_users_table.php
|   |   `-- 2026_05_31_172124_add_nis_nip_status_to_users_table.php
|   `-- seeders/
|       |-- DatabaseSeeder.php
|       `-- RoleSeeder.php
|-- resources/
|   `-- views/
|       |-- admin/
|       |   |-- dashboard.blade.php
|       |   |-- guru/
|       |   |-- import/
|       |   |-- kelas/
|       |   |-- mapel/
|       |   |-- penugasan/
|       |   |-- reset-password/
|       |   `-- siswa/
|       |-- guru/
|       |-- siswa/
|       |-- layouts/
|       `-- components/
|-- public/
|   |-- .htaccess
|   |-- favicon.ico
|   |-- hot
|   |-- index.php
|   `-- robots.txt
|-- storage/
|   `-- app/
|       `-- public/
|           `-- .gitignore
|-- composer.json
|-- package.json
|-- .env.example
`-- README.md
```

## File Bagian Fiqri

```text
E-Learning-SMA/
|-- app/
|   |-- Http/
|   |   `-- Controllers/
|   |       `-- Admin/
|   |           |-- KelasController.php
|   |           |-- MapelController.php
|   |           |-- SiswaController.php
|   |           |-- GuruController.php
|   |           |-- PenugasanController.php
|   |           |-- ImportController.php
|   |           `-- ResetPasswordController.php
|   |-- Models/
|   |   |-- Kelas.php
|   |   |-- MataPelajaran.php
|   |   |-- SiswaKelas.php
|   |   |-- GuruMapel.php
|   |   `-- GuruKelas.php
|   `-- Imports/
|       |-- SiswaImport.php
|       `-- GuruImport.php
`-- resources/
    `-- views/
        `-- admin/
            |-- kelas/
            |-- mapel/
            |-- siswa/
            |-- guru/
            |-- penugasan/
            |-- import/
            `-- reset-password/
```
