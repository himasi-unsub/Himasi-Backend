# Folder Structure

```
└── 📁himasi-web
    └── 📁app                  # Berisi logika utama aplikasi
        └── 📁Actions          # Menangani aksi spesifik dalam aplikasi
        └── 📁Console          # Berisi perintah Artisan CLI
        └── 📁Exports          # Menyediakan fitur ekspor data
        └── 📁Filament         # Konfigurasi dan sumber daya untuk admin panel Filament
            └── 📁Imports      # Berisi file untuk proses import data
            └── 📁Resources    # Mengelola berbagai resource dalam sistem
                └── 📁DokumenSertifikatResource  # Resource untuk sertifikat mahasiswa
                └── 📁MahasiswaResource         # Resource untuk data mahasiswa
                └── 📁ModuleKegiatan            # Modul kegiatan mahasiswa
                    └── 📁KegiatanAcaraResource  # Resource kegiatan acara
                    └── 📁KehadiranKegiatanResource  # Resource untuk mencatat kehadiran
                    └── 📁PembayaranKegiatanResource  # Resource pembayaran kegiatan
                    └── KegiatanAcaraResource.php  # File resource kegiatan acara
                    └── KehadiranKegiatanResource.php  # File resource kehadiran kegiatan
                    └── PembayaranKegiatanResource.php  # File resource pembayaran kegiatan
                └── 📁ModuleMabim  # Modul untuk MABIM
                    └── 📁KategoriMabimResource  # Resource kategori MABIM
                    └── 📁MabimResource  # Resource utama MABIM
                    └── 📁PesertaMabimResource  # Resource peserta MABIM
                    └── KategoriMabimResource.php  # File resource kategori MABIM
                    └── MabimResource.php  # File resource utama MABIM
                    └── PesertaMabimResource.php  # File resource peserta MABIM
                └── 📁ModuleMakrab  # Modul untuk Makrab
                    └── 📁MakrabResource  # Resource utama Makrab
                    └── 📁PesertaMakrabResource  # Resource peserta Makrab
                    └── MakrabResource.php  # File resource utama Makrab
                    └── PesertaMakrabResource.php  # File resource peserta Makrab
                └── DokumenSertifikatResource.php  # File resource sertifikat mahasiswa
                └── MahasiswaResource.php  # File resource mahasiswa
        └── 📁Http  # Berisi controller dan middleware aplikasi
            └── 📁Controllers  # Mengelola request dari pengguna
                └── Controller.php  # Controller dasar Laravel
                └── GenerateSertifikat.php  # Controller untuk pembuatan sertifikat
        └── 📁Jobs  # Menjalankan tugas latar belakang (background jobs)
        └── 📁Models  # Representasi tabel database dalam bentuk objek
        └── 📁Providers  # Service provider untuk konfigurasi aplikasi
    └── 📁bootstrap  # File bootstrapping Laravel dan cache konfigurasi
    └── 📁config  # File konfigurasi utama aplikasi
    └── 📁database  # Berisi skema database dan data awal
        └── 📁factories  # Pembuatan data dummy untuk pengujian
        └── 📁migrations  # Skrip untuk mengelola struktur database
        └── 📁seeders  # Data awal yang bisa diisi ke database
    └── 📁lang  # File terjemahan untuk multi-bahasa
    └── 📁public  # Aset publik seperti gambar, CSS, dan JS
    └── 📁resources  # Sumber daya tampilan seperti Blade template, CSS, dan JS
    └── 📁routes  # Berisi definisi rute aplikasi
    └── 📁storage  # Menyimpan file sementara, cache, dan logs
    └── 📁tests  # Berisi file pengujian aplikasi
```
