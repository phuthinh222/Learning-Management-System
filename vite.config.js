import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/Authentication/style.scss",
                "resources/js/app.js",
                "resources/css/Table/style.scss",
                "resources/css/Teacher/timekeeping.scss",
                "resources/js/certificate.js",
                "resources/js/experience.js",
                "resources/css/Teacher/course.scss",
                "resources/js/courses.js",
            ],
            refresh: true,
        }),
    ],
});
