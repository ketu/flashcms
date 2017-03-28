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
    mix.less(
        [
            'font-awesome/less/font-awesome.less',
            //'PACE/themes/black/pace-theme-loading-bar.css'

        ],
        'public/assets/backend/css/third.css',
        paths.bower
    )
        .less(['less/*.less'], 'public/assets/backend/css/app.css', paths.backend)
        .combine(['public/assets/backend/css/third.css', 'public/assets/backend/css/app.css'], 'public/assets/backend/css/app.min.css');


    mix.scripts(
        [
            'PACE/pace.min.js',
            'jquery/dist/jquery.js',
            'bootstrap/dist/js/bootstrap.js',
            'jquery.nicescroll/dist/jquery.nicescroll.min.js',
            'datatables.net/js/jquery.dataTables.min.js',
            'datatables.net-responsive/js/dataTables.responsive.min.js',
            'select2/dist/js/select2.js',
            'summernote/dist/summernote.js',
            'jquery-validation/dist/jquery.validate.js',
            'jquery-validation/dist/additional-methods.js',
            'jquery.uniform/dist/js/jquery.uniform.standalone.js'


        ],
        'public/assets/backend/js/third.js',
        paths.bower
    ).scripts([
            'js/app.js',
            'js/layout/*.js',
            'js/plugins/*.js',
            'js/page/*.js'
        ],
        'public/assets/backend/js/app.js',
        paths.backend
    )
        .combine(['public/assets/backend/js/third.js', 'public/assets/backend/js/app.js'], 'public/assets//backend/js/app.min.js');

    mix.copy(
        paths.bower + 'font-awesome/fonts',
        'public/assets/backend/fonts'
    ).copy(paths.bower + 'summernote/dist/font/',
        'public/assets/backend/fonts/summernote/')
        .copy(paths.backend + 'images',
            'public/assets/backend/images');

});