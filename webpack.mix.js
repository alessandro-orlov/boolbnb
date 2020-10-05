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
    .js('resources/js/admin/index.js', 'public/js/boolbnb/admin')
    .js('resources/js/admin/create.js', 'public/js/boolbnb/admin')
    .js('resources/js/admin/edit.js', 'public/js/boolbnb/admin')
    .js('resources/js/admin/messages/show.js', 'public/js/boolbnb/admin/messages')
    .js('resources/js/admin/visits/show.js', 'public/js/boolbnb/admin/visits')
    .js('resources/js/guest/index.js', 'public/js/boolbnb/guest')
    .js('resources/js/guest/show.js', 'public/js/boolbnb/guest')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/boolbnb/app.scss', 'public/css/boolbnb');
