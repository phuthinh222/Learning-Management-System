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
                "resources/css/Teacher/course.scss",
                "resources/css/Teacher/timekeeping.scss",
                "resources/css/Teacher/table_timekeeping.scss",
                "resources/js/certificate.js",
                "resources/js/experience.js",
                "resources/js/Authentication/verify-email.js",
                "resources/js/teacher/fill_teacher_data.js",
                "resources/js/user/user.js",
                "resources/js/courses.js",
            ],
            refresh: true,
        }),
    ],
});
