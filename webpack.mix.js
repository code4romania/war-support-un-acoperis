const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/admin.js", "public/js")
    .js("resources/js/argon-design-system.js", "public/js")
    .extract([
        "jquery",
        "axios",
        "lodash",
        "bootstrap",
        "popper.js",
        "perfect-scrollbar",
        "headroom.js",
        "choices.js",
        "@glidejs/glide",
        "nouislider",
        "flatpickr",
        "chart.js"
    ])
    .sass("resources/sass/app.scss", "public/css")
    .sass(
        "resources/argon-design-system-pro/scss/argon-design-system.scss",
        "public/css"
    )
    .copy(
        "resources/js/moment-with-locales.min.js",
        "public/js/moment-with-locales.min.js"
    )
    .copy(
        "resources/js/table-data-renderer.js",
        "public/js/table-data-renderer.js"
    )
    .copy("resources/css/", "public/css/")
    .copy("resources/fonts/", "public/fonts/")
    .copy("resources/images/", "public/images/")

    .copy("resources/js/datatables", "public/js/datatables")
    .copy(
        "node_modules/datatables.net-dt/js/dataTables.dataTables.js",
        "public/js/jquery.dataTables.min.js"
    )
    .copy(
        "node_modules/datatables.net-dt/css/jquery.dataTables.css",
        "public/css/jquery.dataTables.css"
    )
    .copy("node_modules/datatables.net-dt/images", "public/images")
    .copy(
        "node_modules/browser-detect/dist/browser-detect.umd.js",
        "public/js/browser-detect.umd.js"
    );
if (mix.inProduction()) {
    mix.version();
}
