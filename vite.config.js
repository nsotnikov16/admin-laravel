import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/admin/scss/style.scss',
                'resources/admin/js/script.js'
            ],
            refresh: true,
        }),
    ],
});
