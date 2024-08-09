import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/Authentication/style.scss', 
                'resources/js/app.js',
                'resources/js/Authentication/register_toastr.js'
            ],
            refresh: true,
        }),
    ],
});
