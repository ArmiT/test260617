// include gulp
var gulp = require('gulp'); 

// include plug-ins
var minifyHTML = require('gulp-minify-html');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');
var cleanDest = require('del');

// Concat and optimize.
gulp.task('scripts', function() {
    // public JS
    var publicSource = gulp.src(['_src/js/shared.js', '_src/js/public.js']);
    publicSource
        .pipe(concat('public.js'))
        .pipe(gulp.dest('build/js'));
    publicSource
        .pipe(concat('public.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('build/js'));
    
    // admin JS
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
        .pipe(gulp.dest('build/html'));
    
    // admin page
    gulp.src(['_src/html/header.html', '_src/html/admin.html', '_src/html/footer.html'])
        .pipe(concat('admin.html'))
        .pipe(minifyHTML())
        .pipe(gulp.dest('build/html'));
    
    // public page
    gulp.src(['_src/html/header.html', '_src/html/errors/404.html', '_src/html/footer.html'])
        .pipe(concat('404.html'))
        .pipe(minifyHTML())
        .pipe(gulp.dest('build/html/errors'));
});

// PHP minimize
gulp.task('php', function() {
    gulp.src(['_src/php/api.php'])
        .pipe(gulp.dest('build'));
    
    // building admin script
    gulp.src(['_src/php/base.php', '_src/php/admin.php'])
        .pipe(concat('admin.php'))
        .pipe(gulp.dest('build'));
    
    // building public script
    gulp.src(['_src/php/base.php', '_src/php/public.php'])
        .pipe(concat('public.php'))
        .pipe(gulp.dest('build'));
});


// SASS
gulp.task('styles', function() {
    gulp.src(['_src/styles/shared.scss', '_src/styles/public.scss'])
        .pipe(sass())
        .pipe(concat('public.css'))
        .pipe(gulp.dest('build/styles'));
    gulp.src(['_src/styles/shared.scss', '_src/styles/admin.scss'])
        .pipe(sass())
        .pipe(concat('admin.css'))
        .pipe(gulp.dest('build/styles'));
});

// Moving simple files like images and config
gulp.task('move_leftovers', function(){
    gulp.src(['_src/.htaccess','_src/php/db_conf.dsf'])
        .pipe(gulp.dest('build'));
    gulp.src(['_src/images/*'])
        .pipe(gulp.dest('build/images'));
});

// Clean build directory
gulp.task('clean', function(){
    return cleanDest(['build/**/*', 'build/*']);
});

gulp.task('build', ['scripts', 'htmlpage', 'php', 'styles', 'move_leftovers']);