const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

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

elixir(mix => {
    mix.sass([
        'app.scss'
    ], 'public/dist/styles.css');

    mix.webpack([
        'app.js'
	], 'public/dist/scripts.js');

	mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/**', 'public/dist/fonts');
	mix.copy('node_modules/font-awesome/fonts/**', 'public/dist/fonts');
});
