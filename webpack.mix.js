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

mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js')
    .copy('node_modules/jquery-slimscroll/jquery.slimscroll.min.js', 'public/js')
    .copy('node_modules/font-awesome/css/font-awesome.min.css', 'public/css')
    .copy('node_modules/ionicons/dist/css/ionicons.min.css', 'public/css')
    .copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css')
    .copy('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/js')
    .copy('node_modules/fastclick/lib/fastclick.js', 'public/js')
    .copy('resources/assets/css/custom', 'public/css')
    .copy('resources/assets/js/custom', 'public/js')
    .copy('node_modules/font-awesome/fonts', 'public/fonts');
    
