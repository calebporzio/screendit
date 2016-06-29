var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('site.scss')
       .less('app.less')
       .browserify('app.js', null, null, { paths: 'vendor/laravel/spark/resources/assets/js' })
       .copy('node_modules/sweetalert/dist/sweetalert.min.js', 'public/js/sweetalert.min.js')
       .copy('node_modules/sweetalert/dist/sweetalert.css', 'public/css/sweetalert.css')
       .browserSync({
       		proxy: 'screendit.dev',
			files: [
				elixir.config.appPath + '/**/*.php',
				elixir.config.get('public.js.outputFolder') + '/**/*.js',
				elixir.config.get('public.css.outputFolder') + '/**/*.css',
				elixir.config.get('public.versioning.buildFolder') + '/rev-manifest.json',
				'resources/views/**/*.php'
			],
       });
});
