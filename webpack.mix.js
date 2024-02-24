let mix = require('laravel-mix');

require('laravel-mix-polyfill');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
// events create seperate vue js
.js('resources/js/events_manage/index.js', 'publishable/assets/js/events_manage.js')

// events show seperate vue js
.js('resources/js/events_show/index.js', 'publishable/assets/js/events_show.js')

// events listing seperate vue js
.js('resources/js/events_listing/index.js', 'publishable/assets/js/events_listing.js')

// customer bookings seperate vue js
.js('resources/js/bookings_customer/index.js', 'publishable/assets/js/bookings_customer.js')

// events welcome seperate vue js
.js('resources/js/welcome/index.js', 'publishable/assets/js/welcome.js')
// profile vue js
.js('resources/js/profile/index.js', 'publishable/assets/js/profile.js')

// use vue 2
.vue({ version: 2 })

// compile sass files
.sass('resources/sass/theme.scss', 'publishable/assets/css')
.options({
    processCssUrls: false,
    autoprefixer: {
        browsers: [
            'last 6 versions',
        ]
    }
})
.polyfill({
    corejs: 3,
    enabled: true,
    useBuiltIns: "usage",
    targets: {"firefox": "50", "safari": "11.3"}
})

// third-party css
.sass('resources/sass/vendor.scss', 'publishable/assets/css')
.options({
    processCssUrls: false,
    autoprefixer: {
        options: {
            browsers: [
                'last 6 versions',
            ]
        }
    }
})
.polyfill({
    corejs: 3,
    enabled: true,
    useBuiltIns: "usage",
    targets: {"firefox": "50", "safari": "11.3"}
})

.webpackConfig({
    optimization: {
        providedExports: false,
        sideEffects: false,
        usedExports: false
    }
})

.override((config) => {
    delete config.watchOptions;
});