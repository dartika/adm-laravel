const { mix } = require('laravel-mix');

var ADM_DEST_FOLDER = 'public/';

mix.setPublicPath(ADM_DEST_FOLDER);
mix.setResourceRoot('/vendor/dartika-adm/');

mix.less('resources/assets/less/AdminLTE.less', 'css/admin.css') // less
   .js('resources/assets/js/adminlte.js', ADM_DEST_FOLDER + 'js/adminlte.js')
   .js('resources/assets/js/global.js', ADM_DEST_FOLDER + 'js/global.js')
   .combine([
             'node_modules/jquery/dist/jquery.js', 
             'node_modules/bootstrap/dist/js/bootstrap.js',
             'node_modules/jasny-bootstrap/dist/js/jasny-bootstrap.js',
             'node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
             'node_modules/select2/dist/js/select2.js',
            ], 
            ADM_DEST_FOLDER + 'js/vendor.js'); // vendor js

if(mix.inProduction()) {
    mix.version();
}