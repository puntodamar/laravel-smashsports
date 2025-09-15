import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js'], // single global entry
            refresh: ['resources/views/**', 'Modules/**'],
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
            // '~': path.resolve(__dirname, 'Modules'), // optional, NOT used by the resolver above
        },
    },
    server: {
        fs: {
            allow: [
                path.resolve(__dirname),          // project root
                path.resolve(__dirname, 'Modules')// allow serving module files
            ],
        },
    },
})
