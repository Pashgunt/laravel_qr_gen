import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/feedback.js',
                'resources/js/funnel.js',
                'resources/js/page-setting.js',
                'resources/js/qr.js',
                'resources/js/password.js',
                'resources/js/verify-email.js',
            ],
            refresh: true,
        }),
    ],
});
