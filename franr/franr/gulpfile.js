/*
This file in the main entry point for defining Gulp tasks and using Gulp plugins.
Click here to learn more. http://go.microsoft.com/fwlink/?LinkId=518007
*/

var gulp = require('gulp');

var sass = require('gulp-sass');

gulp.task('sass', function () {
    return gulp.src('./scss/style.scss')
      .pipe(sass().on('error', sass.logError))
      .pipe(gulp.dest('.'));
});

gulp.task('sass:watch', function () {
    gulp.watch('./scss/*.scss', ['sass']);
});

//gulp.task('default', function () {
//    
//});