import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                'resources/scss/config/reset.scss',
                'resources/scss/layouts/button.scss',
                'resources/scss/layouts/form.scss',
                'resources/scss/main.scss',
                'resources/js/dom.js',
                'resources/js/inputsFormCreate.js',
                'resources/js/checkboxFormEvento.js',
                'resources/js/btnComprar.js',
                 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
