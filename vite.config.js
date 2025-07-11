import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: true,
        port: 8078,
        https: {
            key: fs.readFileSync('/etc/ssh/localhost-key.pem'),
            cert: fs.readFileSync('/etc/ssh/localhost.pem'),
        },
        hmr: {
            host: 'localhost',
        },
        watch: {
            usePolling: true,
        },
    },
});
