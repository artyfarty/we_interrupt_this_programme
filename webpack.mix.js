const mix = require('laravel-mix');
require("laravel-mix-react-typescript-extension");
require('mix-html-builder');

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

require('mix-tailwindcss');

mix
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .tailwind();

mix
    .reactTypeScript("resources/announcer-app/index.tsx", "public/announcer-app/js")
    .sass("resources/announcer-app/app.scss", "public/announcer-app/css")
    .html({
        htmlRoot: 'resources/announcer-app/index.html',
        output: 'announcer-app/',
        inject: true
    })
    .copy('resources/announcer-app/sr.apng', 'public/announcer-app/sr.apng');

