import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/slick.js',
                'resources/css/slick.css',
                'resources/js/countDown.js',
                'resources/js/courses/App.jsx',
                'resources/js/resumes/App.jsx',
            ],
            refresh: true,
        }),
    ],
});
