# Aplikasi Kuesioner Skala Likert dengan CodeIgniter 3

## Fitur Utama
- Manajemen Kuesioner
- Tambah, Edit, Hapus Pertanyaan
- Pengisian Kuesioner oleh Responden
- Analisis Hasil Kuesioner dengan Grafik

## Prasyarat
- PHP 7.4+
- MySQL
- Composer
- CodeIgniter 3

## Instalasi
1. Clone repository
```bash
git clone https://github.com/anda/skala-likert-app.git
cd skala-likert-app
```

2. Install dependensi
```bash
composer install
```

3. Konfigurasi Database
- Buka `application/config/database.php`
- Sesuaikan pengaturan koneksi database

4. Impor Skema Database
- Gunakan file SQL di `database/skala_likert.sql`
```bash
mysql -u username -p nama_database < database/skala_likert.sql
```

## Struktur Aplikasi
- `application/controllers/`: Logika kontrol
- `application/models/`: Interaksi dengan database
- `application/views/`: Tampilan HTML
- `assets/`: File CSS dan JavaScript

## Fitur Detail
- Dashboard manajemen kuesioner
- Kustomisasi pertanyaan
- Analisis hasil dengan grafik
- Gaya desain black and white dengan Comic Sans

## Konfigurasi
- Pengaturan umum di `application/config/config.php`
- Konfigurasi database di `application/config/database.php`

## Keamanan
- Pastikan folder `application` tidak dapat diakses publik
- Gunakan fitur login yang sudah ada
- Validasi input di sisi server

## Kontribusi
1. Fork repository
2. Buat branch fitur baru
3. Commit perubahan
4. Push ke branch
5. Buat Pull Request

## Lisensi
[Tentukan Lisensi Anda]

## Kontak
[Informasi Kontak Anda]

## Catatan Pengembangan
- Gunakan CodeIgniter 3 sesuai dokumentasi resmi
- Perhatikan keamanan dan validasi input
- Optimasi query database
