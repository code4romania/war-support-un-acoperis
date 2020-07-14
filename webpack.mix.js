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
        // argon plugins we don't necessary use.
        'perfect-scrollbar',
        'headroom.js',
        'choices.js', '@glidejs/glide', 'nouislider'
    ])
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/argon-design-system-pro/scss/argon-design-system.scss', 'public/css')
    .copy('resources/js/argon-design-system.js', 'public/js/argon-design-system.js')
    .copy('resources/css/', 'public/css/')
    .copy('resources/fonts/', 'public/fonts/')
    .copy('resources/images/', 'public/images/')
    .version()
if (mix.inProduction()) {
    mix.version();
}