import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/game.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
