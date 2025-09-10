import { defineConfig } from 'vite'
import vue from "@vitejs/plugin-vue";
import laravel from 'laravel-vite-plugin'
import path from 'path'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    plugins: [
        vue(),
        tailwindcss(),
        laravel({
            input: [
                'resources/js/app.js',                           // your main app (optional)
                'Modules/Schedule/Resources/assets/js/app.js',   // <-- module entry
            ],
            // helps auto-refresh when you change module files
            refresh: [
                'resources/views/**',
                'Modules/Schedule/**',
            ],
        }),
    ],
    resolve: {
        alias: {
            '~': path.resolve(__dirname, 'Modules'),
            '@': path.resolve(__dirname, 'resources/js'),
            '@public': path.resolve(__dirname, 'public'),
            '@assets': path.resolve(__dirname, 'resources/assets'),
            ziggy: path.resolve(__dirname, 'vendor/tightenco/ziggy')
        },
    },
    server: {
        fs: {
            allow: [
                path.resolve(__dirname),
                path.resolve(__dirname, 'Modules'),
            ],
        },
    },
})
