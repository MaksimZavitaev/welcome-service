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

mix
    .setPublicPath('../../public/admin')
    .setResourceRoot('../')
    .js('src/js/app.js', 'js')
    .sass('src/sass/app.scss', 'css')
    .extract([
        'axios',
        'jquery',
        'lodash',
        'popper.js',
        'vue',
        'bootstrap-sass',
        'admin-lte',
        'icheck',
        'select2',
        'sweetalert2',
        'trumbowyg',
        'vuedraggable',
    ])
    .version();
