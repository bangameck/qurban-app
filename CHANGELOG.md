# Changelog - Qurban App Radevanka

Seluruh perubahan signifikan pada proyek ini akan didokumentasikan di file ini.

---

## [v1.2.0] - 2026-04-20
### ✨ Added (Fitur Baru)
- **Premium Skeleton System:** Implementasi *high-fidelity skeleton* (custom placeholder) untuk seluruh modul (Grid, Tabel, Dashboard, Settings, Scanner) agar transisi loading terasa sangat premium.
- **Lazy Loading Implementation:** Integrasi atribut `#[Lazy]` pada semua komponen Livewire Admin & Publik untuk optimasi *initial load*.
- **Smart Image Handling (Client-Side):**
    - Fitur kompresi gambar otomatis menggunakan *Canvas API* sebelum upload (maks 100KB).
    - Fitur **Auto-Crop Banner** (Center Crop) untuk memastikan banner dashboard & login tampil proporsional.
- **Custom Dashboard Banner:** Admin kini dapat mengganti background banner Dashboard dan halaman Login langsung dari menu Pengaturan.
- **Premium Auth UI:** Perombakan total halaman Login dengan efek *Glassmorphism*, *Blob Animations*, dan *Watermark Banner*.
- **Project Documentation:** Penambahan file `README.md` premium dan `LICENSE.md` dengan lisensi khusus RadevankaProject.

### 🛠️ Changed (Perubahan)
- **Layout Modernization:** Pembaruan grid dan spacing pada hampir seluruh halaman administratif (Data Sapi, Mudhohi, Mustahiq, RAB, dll).
- **UX Refinement:** Penambahan jeda halus (`usleep`) pada proses render untuk mempertegas efek loading skeleton yang elegan.
- **Admin Dashboard Layout:** Integrasi banner background dan perbaikan tata letak kotak informasi statistik.

### 🐞 Fixed (Perbaikan)
- Perbaikan error `View not found` pada referensi skeleton di komponen `AppSetting`.
- Perbaikan masalah *layout shift* (tumpang tindih) pada skeleton di layout utama.
- Perbaikan bug sinkronisasi cache warna tema (`global_settings`).

---

## [v1.1.0] - Sebelumnya
### ✨ Added
- Integrasi WhatsApp Gateway (Fonnte).
- Sistem Kelompok Sapi Otomatis.
- Scanner Kupon terintegrasi kamera.
- Cetak Sertifikat Qurban PDF.

---

## [v1.0.0] - Rilis Awal
- Initial release sistem manajemen Qurban Radevanka.
