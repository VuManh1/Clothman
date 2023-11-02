import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js', 
                'resources/js/cart.js',
                'resources/js/jquery.mobile.custom.min.js',
                'resources/js/MultiItemCarousel.js',
                'resources/js/product-detail.js',
                'resources/js/QuantityBox.js',
            ],
            refresh: true,
        }),
    ],
});
