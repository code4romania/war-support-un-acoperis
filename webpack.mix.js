const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .extract(['jquery', 'axios', 'lodash', 'bootstrap', 'popper.js',
        'perfect-scrollbar',
        'headroom.js',
        'choices.js', '@glidejs/glide', 'nouislider', 'flatpickr'
    ])
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/argon-design-system-pro/scss/argon-design-system.scss', 'public/css')
    .copy('resources/js/argon-design-system.js', 'public/js/argon-design-system.js')
    .copy('resources/js/moment-with-locales.min.js', 'public/js/moment-with-locales.min.js')
    .copy('resources/js/table-data-renderer.js', 'public/js/table-data-renderer.js')
    .copy('resources/css/', 'public/css/')
    .copy('resources/fonts/', 'public/fonts/')
    .copy('resources/images/', 'public/images/')
    .copy('resources/js/jquery.fileuploader.min.js', 'public/js/jquery.fileuploader.min.js')
    .copy('resources/js/jquery.sticky-sidebar.min.js', 'public/js/jquery.sticky-sidebar.min.js')
    .copy('resources/js/clinics-front-renderer.js', 'public/js/clinics-front-renderer.min.js')
    .version()
if (mix.inProduction()) {
    mix.version();
}
