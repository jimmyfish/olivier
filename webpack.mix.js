const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .copy('resources/assets/js/bundle.js', 'public/assets/js')
    .copy('resources/assets/js/charts/chart-crypto.js', 'public/assets/js')
    .js('resources/assets/js/scripts.js', 'public/assets/js')
    .postCss('resources/assets/css/dashlite.css', 'public/assets/css')
    .postCss('resources/assets/css/theme.css', 'public/assets/css');
