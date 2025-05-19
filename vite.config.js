import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite'
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',    // 모든 IP에서 접근 가능하도록
        port: 5175,          // Vite 기본 포트
        hmr: {
            host: 'local.chooing',  // Vite HMR이 도메인 인식하도록 설정
        },
    },
}); 