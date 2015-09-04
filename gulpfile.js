var elixir = require('laravel-elixir');
var gulp = require('gulp');
var ngAnnotate = require('gulp-ng-annotate');

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
    mix.sass('app.scss')
       .scripts([
       		'Service.js',
       		'Controller.js',
       		'routes.js',
       		'app.js'
       	])
       .copy('node_modules/angular/angular.min.js', 'public/js/vendor/angular.js')
       .copy('node_modules/angular-ui-router/release/angular-ui-router.min.js', 'public/js/vendor/angular-ui-router.js');
});

gulp.task('annotate', function () {
    return gulp.src('public/js/all.js')
        .pipe(ngAnnotate())
        .pipe(gulp.dest('public/dist'));
});


