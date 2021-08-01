let mix = require('laravel-mix');
let execSync = require('child_process').execSync;

mix.js('Modules/Translation/Resources/assets/admin/js/app.js', 'Modules/Translation/Assets/admin/js/translation.js')
    .styles([
        'Modules/Translation/node_modules/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css',
    ], 'Modules/Translation/Assets/admin/css/translation.css')
    .copy('Modules/Translation/node_modules/x-editable/dist/bootstrap3-editable/img', 'Modules/Translation/Assets/admin/img');
