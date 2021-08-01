let mix = require('laravel-mix');
let execSync = require('child_process').execSync;

mix.js('Modules/Category/Resources/assets/admin/js/app.js', 'Modules/Category/Assets/admin/js/category.js')
    .scripts('Modules/Category/node_modules/jstree/dist/jstree.js', 'Modules/Category/Assets/admin/js/jstree.js')
    .sass('Modules/Category/Resources/assets/admin/sass/app.scss', 'Modules/Category/Assets/admin/css/category.css')
    .copy('Modules/Category/node_modules/jstree/dist/themes/default/32px.png', 'Modules/Category/Assets/admin/css')
    .copy('Modules/Category/node_modules/jstree/dist/themes/default/40px.png', 'Modules/Category/Assets/admin/css')
    .copy('Modules/Category/node_modules/jstree/dist/themes/default/throbber.gif', 'Modules/Category/Assets/admin/css')
    .then(() => {
        execSync('npm run rtlcss Modules/Category/Assets/admin/css/category.css Modules/Category/Assets/admin/css/category.rtl.css');
    });
