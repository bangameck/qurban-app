# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2026-04-15

### Added
- **Core Entity Management:** 
  - Management modules for Warga, RT, RW, and Panitia.
  - Sapi (Cow) & Kelompok Sapi (Cow Group) management with current weight and slaughter status tracking.
  - Flexible distribution system classifying receivers into Mustahiq (QBN), Mudhohi (MDH), and Panitia (PQR).
- **Live Display Interface:** 
  - Real-time Dashboard "Live Screen TV" built with Livewire and Alpine.js.
  - Auto-scrolling carousel showcasing live animal slaughter progress, grouped mudhohi data, and live distribution queue (full addresses included).
  - Web Audio API and Speech Synthesis integration for automated localized scanning announcements.
  - Robust auto-scroll behavior resistant to DOM-interrupting live-reloads with intelligent frame-skipping speeds.
- **Scanner & QR Integration:**
  - Generated QR Codes tied directly to the database for individual coupons and ID Cards.
  - Live scanning interfaces updating real-time global dashboards.
- **PDF Generation & Export:**
  - Printable designs for Panitia ID Cards, Public Distribution Coupons, and Official Certificates.
