var elixir = require('laravel-elixir');

/*
 |----------------------------------------------------------------
 | Have a Drink!
 |----------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic
 | Gulp tasks for your Laravel application. Elixir supports
 | several common CSS, JavaScript and even testing tools!
 |
 */


var paths = {
    'bower': 'resources/assets/bower/',
    'backend': 'resources/assets/backend/',
    'frontend': 'resources/assets/frontend/'
};

/**
 * backend assets
 */
elixir(function (mix) {
    mix.less(['font-awesome/less/font-awesome.less'], 'public/assets/backend/css/font-awesome.css', paths.bower)
        .less(['less/*.less'], 'public/assets/backend/css/app.css', paths.backend)
        .combine(['public/assets/backend/css/font-awesome.css', 'public/assets/backend/css/app.css'], 'public/assets/backend/css/app.min.css');


    mix.scripts(
        ['jquery/dist/jquery.js',
            'bootstrap/dist/js/bootstrap.js',
            'jquery.nicescroll/dist/jquery.nicescroll.min.js',
            'legitripple/dist/ripple.min.js'],
        'public/assets/backend/js/third.js',
        paths.bower
    ).scripts([
            'js/app.js',
            'js/layout/*.js',
            'js/page/*.js'
        ],
        'public/assets/backend/js/app.js',
        paths.backend
    )
        .combine(['public/assets/backend/js/third.js', 'public/assets/backend/js/app.js'], 'public/assets//backend/js/app.min.js');

    mix.copy(
        paths.bower + 'font-awesome/fonts',
        'public/assets/backend/fonts'
    ).copy(   paths.backend + 'images',
        'public/assets/backend/images');

});