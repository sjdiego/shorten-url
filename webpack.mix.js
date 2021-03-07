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

/**
 * Frontend
 */
mix.js("resources/js/app.js", "public/js")
    .react()
    .postCss("resources/css/app.css", "public/css", [require("tailwindcss")])
    .version();

/**
 * Backend
 */
mix.ts("resources/js/backend/app.js", "public/js/backend")
    .react()
    .postCss("resources/css/back.css", "public/css", [require("tailwindcss")])
    .version();
