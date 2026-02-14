//Utils
const gulp = require("gulp");
const { src, dest, parallel } = require('gulp');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const browserSync = require('browser-sync').create();
const plumber = require("gulp-plumber");
const notify  = require("gulp-notify");

//CSS
const sass = require('gulp-sass')(require('sass'));
const postcss      = require('gulp-postcss');
const sourcemaps   = require('gulp-sourcemaps');
const autoprefixer = require('autoprefixer');

//Images
const imagemin = require('gulp-imagemin');

function styles() {
	return gulp.src([
		'node_modules/glightbox/dist/css/glightbox.min.css',
		'assets/scss/slick.css',
		'assets/scss/slick-theme.css',
		'assets/scss/main.scss'
	])
	.pipe(plumber({
		errorHandler: notify.onError({
			title: "CSS/Sass error",
			message: "<%= error.message %>"
		})
	}))
	.pipe(sourcemaps.init())
	.pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
	.pipe(postcss([autoprefixer()]))
	.pipe(concat('main.css'))
	.pipe(rename({ suffix: '.min' }))
	.pipe(sourcemaps.write('.'))
	.pipe(gulp.dest('./public/css'))
	.pipe(browserSync.stream());
}

function editor_styles() {
	return gulp.src('assets/scss/editor-styles.css')
		.pipe(plumber({
		errorHandler: notify.onError({
			title: "Editor CSS error",
			message: "<%= error.message %>"
		})
	}))
	.pipe(sourcemaps.init())
	.pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
	.pipe(postcss([autoprefixer()]))
	.pipe(concat('editor-styles.css'))
	.pipe(rename({ suffix: '.min' }))
	.pipe(sourcemaps.write('.'))
	.pipe(gulp.dest('./public/css'))
	.pipe(browserSync.stream());
}

function scripts() {
	return gulp.src([
		'assets/js/fitvids.js',
		//'assets/js/jquery.cookie.js',
		//'assets/js/jquery.bxslider.min.js',
		'assets/js/slick.min.js',
		//'assets/js/imagesloaded.pkgd.min.js',
		//'assets/js/masonry.pkgd.min.js',
		'node_modules/glightbox/dist/js/glightbox.min.js',
		'assets/js/main.js'
	])
	.pipe(concat('main.js'))
	.pipe(rename({suffix: '.min'}))
	.pipe(uglify({'mangle': true}))
	.pipe(gulp.dest('public/js'))
	.pipe(browserSync.stream());
}

function svg() {
	return gulp.src('assets/svg/**/*', { base: 'assets/svg' })
	.pipe(gulp.dest('public/svg'));
}

function images() {
	return gulp.src('assets/images/**/*', { base: 'assets/images' })
	.pipe(gulp.dest('public/images'));
}

function fonts() {
	return gulp.src('assets/fonts/**/*', { base: 'assets/fonts' })
	.pipe(gulp.dest('public/fonts'));
}

function watchFiles() {
	browserSync.init({ proxy: "localhost/guildenacre/" });
	
	gulp.watch('assets/scss/**/*.scss', styles);
	gulp.watch('assets/scss/editor-styles.css', editor_styles);
	gulp.watch('assets/js/**/*.js', scripts);
	gulp.watch('assets/svg/**/*.svg', svg);
	gulp.watch('assets/images/**/*', images);
}

const watch = gulp.parallel(watchFiles)

exports.styles = styles;
exports.editor_styles = editor_styles;
exports.scripts = scripts;
exports.svg = svg;
exports.images = images;
exports.fonts = fonts;
exports.watch = watch;