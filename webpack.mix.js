let mix = require('laravel-mix');

const WebpackShellPlugin = require('webpack-shell-plugin');

// Add shell command plugin configured to create JavaScript language file
mix.webpackConfig({
    plugins:
        [
            new WebpackShellPlugin({ onBuildStart: ['php artisan lang:js --quiet'], onBuildEnd: [] })
        ]
});

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
    .copy('node_modules/font-awesome/fonts', 'public/fonts')
    .copy('node_modules/slick-carousel/slick/slick.min.js', 'public/js')
    .copy('node_modules/slick-carousel/slick/slick.css', 'public/css')
    .copy('node_modules/slick-carousel/slick/slick-theme.css', 'public/css')
    .copy('node_modules/nouislider/distribute/nouislider.min.js', 'public/js')
    .copy('node_modules/nouislider/distribute/nouislider.min.css', 'public/css')
    .copy('node_modules/jquery-zoom/jquery.zoom.min.js', 'public/js')
    .copy('node_modules/bootstrap/fonts', 'public/fonts')
    .copy('node_modules/pretty-checkbox/dist/pretty-checkbox.min.css', 'public/css')
    .copy('node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css', 'public/css')
    .copy('node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js', 'public/js')
    .copy('node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput-typeahead.css', 'public/css')
    .copy('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css', 'public/css')
    .copy('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js', 'public/js')
    .copy('resources/assets/images', 'public/images');
