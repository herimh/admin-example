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

var public_path = elixir.config.publicPath + '/';
var assets_path = 'resources/assets/';

elixir(function(mix) {
    mix.sass(assets_path + 'sass/admin', public_path + 'css/admin_app.css')
        .scriptsIn(assets_path + '/js/admin', public_path + 'js/admin_app.js')
});

