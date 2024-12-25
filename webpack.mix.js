const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .styles([
       'resources/css/reset.css',
       'resources/css/carousel.css',
   ], 'public/css/all.css')
   .css('resources/css/app.css', 'public/css'); // Pastikan ini ada
