const mix = require('laravel-mix');

mix.setPublicPath('public');
mix.setResourceRoot('../');

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css', [
    ]);