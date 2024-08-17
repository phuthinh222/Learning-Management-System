import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/Authentication/style.scss', 
                'resources/js/app.js',
                'resources/css/Table/style.scss', 
                'resources/css/Teacher/timekeeping.scss', 
                'resources/js/Authentication/verify-email.js'
            ],
            refresh: true,
        }),
    ],
});
