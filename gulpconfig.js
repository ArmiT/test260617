// include gulp
var gulp = require('gulp'); 

// include plug-ins
var minifyHTML = require('gulp-minify-html');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var minifyPHP = require('@cedx/gulp-php-minify');
var sass = require('gulp-sass');

// Concat and optimize.
gulp.task('scripts', function() {
    var publicSource = gulp.src(['_src/js/shared.js', '_src/js/public.js']);
    publicSource
        .pipe(concat('public.js'))
        .pipe(gulp.dest('build/js'));
    publicSource
        .pipe(concat('public.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('build/js'));
    
    var adminSource = gulp.src(['_src/js/shared.js', '_src/js/admin.js']);
    adminSource
        .pipe(concat('admin.js'))
        .pipe(gulp.dest('build/js'));
    adminSource
        .pipe(concat('admin.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('build/js'));
});

// HTML optimize
gulp.task('htmlpage', function() {
    gulp.src(['_src/html/header.html', '_src/html/public.html', '_src/html/footer.html'])
        .pipe(concat('public.html'))
        .pipe(minifyHTML())
        .pipe(gulp.dest('build'));
    
    gulp.src(['_src/html/header.html', '_src/html/admin.html', '_src/html/footer.html'])
        .pipe(concat('admin.html'))
        .pipe(minifyHTML())
        .pipe(gulp.dest('build'));
});

// PHP minimize
gulp.task('php', function() {
    gulp.src('_src/php/*.php', {read: false})
        .pipe(minifyPHP({binary: 'S:/php7/php.exe'}))
        .pipe(gulp.dest('build'));
});


// SASS
gulp.task('styles', function() {
    var srcDir = concatDir('_src/styles/*.scss');
    var dstDir = concatDir('styles');
    
    gulp.src('_src/styles/*.scss')
        .pipe(sass())
        .pipe(concat('styles.css'))
        .pipe(gulp.dest('build/styles'));
});

gulp.task('build', ['scripts', 'htmlpage', 'php', 'styles']);