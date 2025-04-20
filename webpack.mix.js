const mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'js')
    .sass('resources/assets/sass/app.scss', 'css', {sassOptions: {
        style: "compressed"
    }
});