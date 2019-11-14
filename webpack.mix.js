let mix = require('laravel-mix');

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
// common auth instance
.js('resources/js/auth/index.js', 'publishable/assets/js/auth.js')

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

// compile sass files
.sass('resources/sass/app.scss', 'publishable/assets/css')
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

// third-party css
.sass('resources/sass/vendor.scss', 'publishable/assets/css')

// compile node modules in seperate vendor.js file
.extract();