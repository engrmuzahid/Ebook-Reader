let mix = require('laravel-mix');
let execSync = require('child_process').execSync;

mix.js('Modules/User/Resources/assets/admin/js/app.js', 'Modules/User/Assets/admin/js/user.js')
    .sass('Modules/User/Resources/assets/admin/sass/app.scss', 'Modules/User/Assets/admin/css/user.css')
    .sass('Modules/User/Resources/assets/admin/sass/_login.scss', 'Modules/User/Assets/admin/css/login.css')
    .then(() => {
        execSync('npm run rtlcss Modules/User/Assets/admin/css/login.css Modules/User/Assets/admin/css/login.rtl.css');
        execSync('npm run rtlcss Modules/User/Assets/admin/css/user.css Modules/User/Assets/admin/css/user.rtl.css');
    });

