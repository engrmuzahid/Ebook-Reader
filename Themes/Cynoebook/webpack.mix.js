let mix = require('laravel-mix');
let execSync = require('child_process').execSync;

mix.js('Themes/Cynoebook/resources/assets/admin/js/main.js', 'Themes/Cynoebook/assets/admin/js/cynoebook.js')
    .js('Themes/Cynoebook/resources/assets/public/js/app.js', 'Themes/Cynoebook/assets/public/js/app.js')
    .sass('Themes/Cynoebook/resources/assets/admin/sass/main.scss', 'Themes/Cynoebook/assets/admin/css/cynoebook.css')
    .sass('Themes/Cynoebook/resources/assets/public/sass/app.scss', 'Themes/Cynoebook/assets/public/css/app.css')
    .copy('Themes/Cynoebook/node_modules/font-awesome/fonts', 'Themes/Cynoebook/assets/public/fonts')
    .copy('Themes/Cynoebook/node_modules/slick-carousel/slick/fonts', 'Themes/Cynoebook/assets/public/css/fonts')
    .copy('Themes/Cynoebook/node_modules/slick-carousel/slick/ajax-loader.gif', 'Themes/Cynoebook/assets/public/css')
    .copy('Themes/Cynoebook/resources/assets/public/images', 'Themes/Cynoebook/assets/public/images')
    .copy('Themes/Cynoebook/resources/assets/public/images', 'Themes/Cynoebook/assets/public/images')
    .copy('Themes/Cynoebook/resources/assets/pdfViewer', 'Themes/Cynoebook/assets/pdfViewer')
    .copy('Themes/Cynoebook/resources/assets/epub', 'Themes/Cynoebook/assets/epub')
    .copy('Themes/Cynoebook/node_modules/pdfjs-dist', 'Themes/Cynoebook/assets/public/js/pdfjs-dist')
    .copy('Themes/Cynoebook/node_modules/wavesurfer.js/dist/wavesurfer.min.js', 'Themes/Cynoebook/assets/public/js/wavesurfer.js/dist/wavesurfer.min.js')
    .copy('Themes/Cynoebook/node_modules/wavesurfer.js/dist/plugin/wavesurfer.timeline.min.js', 'Themes/Cynoebook/assets/public/js/wavesurfer.js/dist/plugin/wavesurfer.timeline.min.js')
    .then(() => {
        execSync('npm run rtlcss Themes/Cynoebook/assets/admin/css/cynoebook.css Themes/Cynoebook/assets/admin/css/cynoebook.rtl.css');
        execSync('npm run rtlcss Themes/Cynoebook/assets/public/css/app.css Themes/Cynoebook/assets/public/css/app.rtl.css');
    });
