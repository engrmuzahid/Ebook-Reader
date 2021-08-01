let mix = require('laravel-mix');
let execSync = require('child_process').execSync;

mix.js('Modules/Slider/Resources/assets/admin/js/app.js', 'Modules/Slider/Assets/admin/js/slider.js')
    .copy('Modules/Slider/node_modules/spectrum-colorpicker2/dist/spectrum.min.js', 'Modules/Slider/Assets/admin/js/spectrum.min.js')
    .sass('Modules/Slider/Resources/assets/admin/sass/app.scss', 'Modules/Slider/Assets/admin/css/slider.css')
    .then(() => {
        execSync('npm run rtlcss Modules/Slider/Assets/admin/css/slider.css Modules/Slider/Assets/admin/css/slider.rtl.css');
    });
