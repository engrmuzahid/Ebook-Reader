let mix = require('laravel-mix');
let execSync = require('child_process').execSync;

mix.js('Modules/Admin/Resources/assets/js/app.js', 'Modules/Admin/Assets/js/admin.js')
    .sass('Modules/Admin/Resources/assets/sass/app.scss', 'Modules/Admin/Assets/css/admin.css')
    .copy('Modules/Admin/Resources/assets/fonts', 'Modules/Admin/Assets/fonts')
    .copy('Modules/Admin/Resources/assets/images', 'Modules/Admin/Assets/images')
    .copy('Modules/Admin/node_modules/tinymce/themes', 'Modules/Admin/Assets/js/wysiwyg/themes')
    .copy('Modules/Admin/node_modules/tinymce/skins', 'Modules/Admin/Assets/js/wysiwyg/skins');
    
let tinymcePlugins = [
    'lists',
    'link',
    'table',
    'paste',
    'autosave',
    'autolink',
    'wordcount',
    'code',
];

tinymcePlugins.forEach(plugin => {
    mix.copy(`Modules/Admin/node_modules/tinymce/plugins/${plugin}/plugin.js`, `Modules/Admin/Assets/js/wysiwyg/plugins/${plugin}`);
});

mix.then(() => {
    execSync('npm run rtlcss Modules/Admin/Assets/css/admin.css Modules/Admin/Assets/css/admin.rtl.css');
});