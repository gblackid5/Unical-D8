// ========================================
// Required plugins
// ========================================

// Plugin declarations
var gulp = require('gulp');
// https://www.npmjs.com/package/gulp-load-plugins
var plugins = require('gulp-load-plugins')();


// ========================================
// Set Paths
// ========================================

// Variable declarations
// http://www.mikestreety.co.uk/blog/an-advanced-gulpjs-file
var paths = {
  scss: {
    src:  'assets/scss/**/*.scss',
    dest: 'assets/css'
  }
};


// ========================================
// Compile Sass
// ========================================

// Compile scss files within assets/scss/
gulp.task('compile-sass', function() {
  return gulp.src(paths.scss.src)
    // https://www.npmjs.com/package/gulp-css-globbing
    .pipe(plugins.cssGlobbing({
      extensions: ['.scss']
    }))
    // https://www.npmjs.com/package/gulp-ruby-sass
    .pipe(plugins.rubySass({
      "sourcemap=none": true,
      style: 'compressed',
      precision: 8
    }))
    .on('error', function (err) {
      console.error('Error!', err.message);
    })
    .pipe(plugins.autoprefixer({
      browsers: ['last 10 versions'],
      cascade: false
    }))
    .pipe(gulp.dest(paths.scss.dest))
    .pipe(plugins.livereload());
});


// ========================================
// Create Watch Task
// ========================================

// Defines all the tasks which run when 'gulp watch' is executed
// This task is executed by default when 'gulp' is executed
gulp.task('watch', function() {
  plugins.livereload.listen();
  gulp.watch(paths.scss.src, ['compile-sass']);
});


// ========================================
// Default 'gulp' task
// ========================================

// Defines all the tasks which run when 'gulp' is executed
gulp.task('default', ['compile-sass', 'watch']);
