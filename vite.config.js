import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    base: '/build/',
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        https: true, // Ensures the Vite server uses HTTPS in production
    },
    build: {
        // Force Vite to generate assets using HTTPS
        assetsPublicPath: process.env.APP_URL + '/build/',
    },
});
