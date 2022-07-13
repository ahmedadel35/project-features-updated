import { defineConfig } from 'vite';
// import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        // https: {
        //     key: "E:/laragon/etc/ssl/laragon.key",
        //     cert: "E:/laragon/etc/ssl/laragon.crt",
        // },
        host: 'localhost',
    },
    plugins: [
        laravel(['resources/css/app.css', 'resources/js/app.ts']),
        {
            name: 'blade',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.blade.php')) {
                    server.ws.send({
                        type: 'full-reload',
                        path: '*',
                    });
                }
            },
        },
        // vue({
        //     template: {
        //         transformAssetUrls: {
        //             base: null,
        //             includeAbsolute: false,
        //         },
        //     },
        // }),
    ],
});
