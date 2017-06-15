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
 * frontend assets
 */
elixir(function (mix) {
    mix.copy(paths.frontend + 'image',
            'public/assets/image').copy(paths.frontend + 'fonts', 'public/assets/fonts');

    mix.combine([

        paths.bower + 'bootstrap/dist/css/bootstrap.css',
        paths.bower + 'font-awesome/css/font-awesome.css',
        paths.bower + 'bxslider-4/dist/jquery.bxslider.css',

        paths.frontend +'/css/*.css'
    ], 'public/assets/css/app.min.css');

    mix.scripts(
        [
            'jquery/dist/jquery.js',
            'bootstrap/dist/js/bootstrap.js',
            'bxslider-4/dist/jquery.bxslider.js'

        ],
        'public/assets/js/third.js',
        paths.bower
    ).scripts([
            'js/*.js'

        ],
        'public/assets/js/app.js',
        paths.frontend
    )
        .combine(['public/assets/js/third.js', 'public/assets/js/app.js'], 'public/assets/js/app.min.js');
});


/**
 * backend assets
 */
elixir(function (mix) {
    mix.less(
        [
            'font-awesome/less/font-awesome.less'
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
            'js-storage/js.storage.js',
            'jquery/dist/jquery.js',
            'bootstrap/dist/js/bootstrap.js',
            'jquery.nicescroll/dist/jquery.nicescroll.min.js',
            'datatables.net/js/jquery.dataTables.min.js',
            'datatables.net-responsive/js/dataTables.responsive.min.js',
            'select2/dist/js/select2.js',
            'summernote/dist/summernote.js',
            'jquery-validation/dist/jquery.validate.js',
            'jquery-validation/dist/additional-methods.js',
            'jquery.uniform/dist/js/jquery.uniform.standalone.js',
            'bootstrap-switch/dist/js/bootstrap-switch.js',
            'bootstrap-multiselect/dist/js/bootstrap-multiselect.js',
            'bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js',
            'bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.js',
            'dropzone/dist/dropzone.js'

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

    mix.copy(paths.bower + 'font-awesome/fonts',
            'public/assets/backend/fonts')
        .copy(paths.bower + 'summernote/dist/font/',
            'public/assets/backend/fonts/summernote/')
        .copy(paths.bower + 'bootstrap/fonts',
            'public/assets/backend/fonts/glyphicons/')
        .copy(paths.backend + 'images',
            'public/assets/backend/images');

});