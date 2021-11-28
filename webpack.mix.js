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
   .js('resources/js/stopwatch.js', 'public/js')
   .js('resources/js/timer.js', 'public/js')
   .js('resources/js/ajaxlike.js', 'public/js')
   .js('resources/js/string_num.js','public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/_stopwatch.scss', 'public/css')
   .sass('resources/sass/_timer.scss', 'public/css')
   
   
 
   
   
