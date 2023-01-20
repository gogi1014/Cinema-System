// webpack.mix.js

const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .vue({
        version: 3,
    })
    .postCss('resources/css/styles.css', 'public/css');

    
    