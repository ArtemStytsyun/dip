import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel([
                'resources/css/app.css',
                'resources/css/uikit.css',
                'resources/css/uikit.min.css',

                'resources/js/app.js',
                'resources/js/uikit.js',
                'resources/js/uikit.min.js',
            ]
        ),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
