'use strict';

const clean = require('gulp-clean');
const gulp = require('gulp');

gulp.task('clean', function () {
    return gulp.src('public/vendor/*', {read: false})
        .pipe(clean());
});

gulp.task('copy', function () {
    return gulp.src('node_modules/{bootstrap,jquery}/dist/**/*.min.*')
        .on('data', function (file) {
            file.path = file.base + '/' + file.relative.replace(/[/\\]dist[/\\]/, '/');
        })
        .pipe(gulp.dest('public/vendor'));
});

gulp.task('default', gulp.series('clean', 'copy'));
