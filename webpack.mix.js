let mix = require('laravel-mix');

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

mix.scripts([
    'public/assets/js/jquery-3.3.1.min.js',
    'public/assets/js/popper.min.js',
    'public/assets/js/bootstrap.min.js',
    'public/assets/js/moment.min.js',
    'public/assets/js/sweetalert.min.js',
    'public/assets/js/delete.handler.js',
    'public/assets/toastr/toastr.min.js',
    'public/assets/plugins/js-cookie/js.cookie.js',
    'public/vendor/jsvalidation/js/jsvalidation.js',
    'public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js',
    'public/assets/plugins/croppie/croppie.js',
    'public/assets/js/bootstrap-multiselect.js',
    'public/datatable/datatables/jquery.dataTables.js',
    'public/datatable/datatables-bs4/js/dataTables.bootstrap4.js'
], 'public/assets/js/vendor.js');

mix.styles([
    'public/assets/css/fontawesome-all.min.css',
    'public/assets/css/bootstrap-multiselect.css',
    'public/assets/toastr/toastr.css',
    'public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css',
    'public/assets/plugins/croppie/croppie.css',
    'public/datatable/datatables-bs4/css/dataTables.bootstrap4.css',
], 'public/assets/css/vendor.css');

mix.sass('resources/sass/app.scss', 'public/assets/css');

if (mix.inProduction()) {
    mix.version();
}