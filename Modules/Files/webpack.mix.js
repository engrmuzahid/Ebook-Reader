let mix = require('laravel-mix');
let execSync = require('child_process').execSync;

mix.js('Modules/Files/Resources/assets/admin/js/app.js', 'Modules/Files/Assets/admin/js/files.js')
    .sass('Modules/Files/Resources/assets/admin/sass/app.scss', 'Modules/Files/Assets/admin/css/files.css')
    .then(() => {
        execSync('npm run rtlcss Modules/Files/Assets/admin/css/files.css Modules/Files/Assets/admin/css/files.rtl.css');
    });
    
