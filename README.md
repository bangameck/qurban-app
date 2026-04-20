# 🐂 Qurban App - Smart Qurban & Distribution Management

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-4E56A6?style=for-the-badge&logo=livewire&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)

**Qurban App** adalah sistem manajemen operasional Qurban modern yang dirancang untuk memudahkan Panitia dalam mengelola data Mudhohi, pembagian Kelompok Sapi, hingga manajemen distribusi daging kepada Mustahiq secara presisi dan transparan.

Dibangun dengan antarmuka **Premium Glassmorphism** yang interaktif, aplikasi ini memastikan seluruh proses ibadah Qurban terdokumentasi dengan baik dan berjalan secara efisien.

---

## ✨ Fitur Unggulan

### 📊 1. Dashboard Monitoring Real-Time
- Visualisasi data pendaftar Qurban (Sapi & Kambing).
- Progres penyembelihan dan distribusi daging secara langsung.
- **Dynamic Greeting:** Menyapa admin berdasarkan waktu (Pagi/Siang/Sore).
- **Banner Background:** Dashboard yang bisa di-custom tampilannya langsung dari pengaturan.

### 🔍 2. Smart Scanner Kupon (QR Code)
- Verifikasi pengambilan daging menggunakan kamera HP/Laptop secara instan.
- **Multi-Role Detection:** Otomatis mendeteksi apakah pemegang kupon adalah Mudhohi, Mustahiq, atau Panitia.
- Validasi status pengambilan untuk mencegah pengambilan ganda.

### 🐂 3. Manajemen Hewan & Kelompok Qurban
- Pengaturan kelompok sapi (7 orang per kelompok) secara otomatis atau manual.
- Data detail hewan qurban dilengkapi dengan foto progress penyembelihan.
- Cetak Sertifikat Qurban otomatis dengan tanda tangan pejabat terkait.

### 🖼️ 4. Pengaturan Tampilan & Banner (Smart Image Handling)
- **Auto-Compression:** Upload Logo dan Banner otomatis dikompres di sisi client menggunakan *Canvas API* hingga di bawah 100KB untuk menghemat storage.
- **Auto-Crop Banner:** Fitur pemotongan gambar otomatis (Center Crop) agar banner selalu tampil proporsional di layar Login dan Dashboard.
- **Theme Color Sync:** Warna tema aplikasi (Emerald, Blue, Rose, Amber) dapat diubah secara instan melalui panel admin.

### 📱 5. Integrasi WhatsApp (WA Gateway)
- Notifikasi otomatis kepada Mudhohi saat hewan sudah disembelih.
- Pengiriman informasi pengambilan daging melalui integrasi **Fonnte**.

### 🦴 6. Manajemen Distribusi & Sesi
- Pengaturan sesi pengambilan daging untuk mengurai antrian warga.
- Data warga (RT/RW) terintegrasi untuk akurasi sasaran penerima daging (Mustahiq).

---

## 🛠️ Stack Teknologi

- **Framework Backend:** Laravel 11+
- **Frontend Stack:** Livewire 3 (Full-page components), Alpine.js (Client-side compression & interactions)
- **Styling:** Tailwind CSS (Custom Color Palettes, Glassmorphism UI)
- **Database:** MySQL

---

## 🚀 Panduan Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/bangameck/qurban-app-radevanka.git
   cd qurban-app-radevanka
   ```

2. **Install Dependency**
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env` lalu sesuaikan konfigurasi database Anda.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migrasi Database & Seeder**
   ```bash
   php artisan migrate --seed
   ```

5. **Link Storage (Penting)**
   ```bash
   php artisan storage:link
   ```

6. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   ```

---

## 👨‍💻 Dikembangkan Oleh

**RadevankaProject**
<br>
[![Typing SVG](https://readme-typing-svg.demolab.com?font=Work+Sans&weight=800&size=18&pause=1000&color=10B981&vCenter=true&width=600&lines=Digitalisasi+Manajemen+Qurban+Modern;Developer:+@bangameck;Lokasi:+Pekanbaru,+Riau)](https://git.io/typing-svg)

- 🧑‍💻 **Developer:** [@bangameck](https://instagram.com/bangameck)
- 📍 **Lokasi:** Pekanbaru, Riau, Indonesia 🇮🇩
- 🎯 **Visi:** *Memudahkan umat dalam ibadah melalui teknologi.*

---

## 📄 Lisensi
Hak Cipta &copy; 2026 **Qurban App Radevanka**. Seluruh hak cipta dilindungi.
