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

mix.js(
    [
        "resources/js/app.js",
        "resources/js/table-data-renderer.js",
        "resources/js/jquery.fileuploader.min",
        "resources/js/argon-design-system.js",
    ],
    "public/js/app.js"
)
    .extract()
    .sass("resources/sass/app.scss", "public/css")

    .copy(
        "resources/js/moment-with-locales.min.js",
        "public/js/moment-with-locales.min.js"
    )
    .copy("resources/fonts/", "public/fonts/")
    .copy("resources/images/", "public/images/")
    .copy("resources/js/datatables", "public/js/datatables")
    .copy("node_modules/datatables.net-dt/images", "public/images")
    .copy(
        "node_modules/browser-detect/dist/browser-detect.umd.js",
        "public/js/browser-detect.umd.js"
    );
if (mix.inProduction()) {
    mix.version();
}
