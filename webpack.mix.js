let mix = require('laravel-mix');
mix.setPublicPath('public');
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


mix.js('resources/assets/js/app.js', 'public/js')
mix.sass('resources/assets/sass/font-awesome/scss/font-awesome.scss','public/css/app.css')
mix.styles(['public/css/app.css','public/css/normalize.css','public/css/animate.css','public/css/wangEditor.min.css'],'public/css/app.css').version();

mix.browserSync({
  proxy: 'admin.cn',
  files: ['resources'],
  watchOptions: {
    ignoreInitial: true,
    ignored: '*.php'
  },
})

// run versioning on production only
if (mix.inProduction()) {
  mix.version();
}