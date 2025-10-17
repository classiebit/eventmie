import { defineConfig } from "vite";
import vue2 from "@vitejs/plugin-vue2";
import laravel from "laravel-vite-plugin";
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // ✅ Add your package file
                "vendor/classiebit/eventmie/resources/js/events_manage/index.js",
                "vendor/classiebit/eventmie/resources/js/events_show/index.js",
                "vendor/classiebit/eventmie/resources/js/events_listing/index.js",
                "vendor/classiebit/eventmie/resources/js/bookings_customer/index.js",
                "vendor/classiebit/eventmie/resources/js/welcome/index.js",
                "vendor/classiebit/eventmie/resources/js/profile/index.js",
                'vendor/classiebit/eventmie/resources/sass/theme.scss',
                'vendor/classiebit/eventmie/resources/sass/vendor.scss'
            ],
            refresh: true,
        }),
        vue2(),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                sassOptions: {
                    quietDeps: true, // suppress @import deprecation warnings from node_modules
                }
            }
        },
        postcss: './postcss.config.js'

    },
    build: {
        rollupOptions: {
        // external: ['vue-confirm-dialog']
        }
    },
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/js"),
            "vuex$": "vuex/dist/vuex.esm.js", 
            "MarkerClusterer": path.resolve(__dirname, "node_modules/@googlemaps/markerclusterer"),
            'vue': 'vue/dist/vue.esm.js', // ensures full build with template compiler
            "vue-confirm-dialog": path.resolve(__dirname, "node_modules/vue-confirm-dialog"),
            'vue-match-heights': path.resolve(__dirname, 'node_modules/vue-match-heights/dist/vue-match-heights.js'),
        },
    },
    optimizeDeps: {
        include: ["@googlemaps/markerclusterer", "vue"],
    },
     // If needed, adjust commonjsOptions
    commonjsOptions: {
        transformMixedEsModules: true,
    },
});
