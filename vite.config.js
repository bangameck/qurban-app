import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'; // 1. Tambahkan import ini

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(), // 2. Daftarkan di sini
    ],
    server: {
        host: '0.0.0.0',
        hmr: {
            host: '192.168.1.26' // Ganti dengan link tunnel yang sedang aktif
        },
    },
});