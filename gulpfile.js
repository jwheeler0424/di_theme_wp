// Load Gulp
import pkg from 'gulp';
const { src, dest, task, watch, series, parallel } = pkg;

// CSS related plugins
import dartSass              from 'sass';
import gulpSass              from 'gulp-sass';
const sass = gulpSass(dartSass)
import autoprefixer          from 'gulp-autoprefixer';

// JS related plugins
import uglify                from 'gulp-uglify';
import babelify              from 'babelify';
import browserify            from 'browserify';
import source                from 'vinyl-source-stream';
import buffer                from 'vinyl-buffer';
import stripDebug            from 'gulp-strip-debug';

// Utility plugins
import rename                from 'gulp-rename';
import sourcemaps            from 'gulp-sourcemaps';
import notify                from 'gulp-notify';
import plumber               from 'gulp-plumber';
import options               from 'gulp-options';
import gulpif                from 'gulp-if';

// Browers related plugins
import browserSync           from 'browser-sync';
browserSync.create();

// Project related variables
const projectURL            = 'http://local.designersimage.io/wp-admin/';

const stylePluginSRC        = './plugins/di-plugin/src/scss/di-plugin.scss';
const styleThemeSRC         = './themes/designersimage/src/scss/di-theme.scss';
const styleThemeHomeSRC     = './themes/designersimage/src/scss/di-theme-homePage.scss';
const styleThemeAdminSRC    = './themes/designersimage/src/scss/di-theme-admin.scss';
const styleThemeFormsSRC    = './themes/designersimage/src/scss/di-theme-forms.scss';
const stylePluginURL        = './plugins/di-plugin/assets/';
const styleThemeURL         = './themes/designersimage/assets/';
const mapPluginURL          = './';
const mapThemeURL           = './';

const jsPluginSRC           = './plugins/di-plugin/src/js/';
const jsThemeSRC            = './themes/designersimage/src/js/';
const jsPlugin              = 'di-plugin.js';
const jsTheme               = 'di-theme.js';
const jsThemeAdmin          = 'di-theme-admin.js';
const jsThemeForms          = 'di-theme-forms.js';
const jsPluginFiles         = [ jsPlugin ];
const jsThemeFiles          = [ jsTheme, jsThemeAdmin, jsThemeForms ];
const jsPluginURL           = './plugins/di-plugin/assets/';
const jsThemeURL            = './themes/designersimage/assets/';

// const imgSRC       = './src/images/**/*';
// const imgURL       = './dist/images/';

// const fontsSRC     = './src/fonts/**/*';
// const fontsURL     = './dist/fonts/';

const stylePluginWatch   = './plugins/di-plugin/src/scss/**/*.scss';
const styleThemeWatch   = './themes/designersimage/src/scss/**/*.scss';
const jsPluginWatch      = './plugins/di-plugin/src/js/**/*.js';
const jsThemeWatch      = './themes/designersimage/src/js/**/*.js';
// const imgWatch     = './src/images/**/*.*';
// const fontsWatch   = './src/fonts/**/*.*';
const phpWatch    = './**/*.php';

// Tasks
function browser_sync() {
	browserSync.init({
		proxy: projectURL,
	});
}

function reload(done) {
	browserSync.reload();
	done();
}

function css(done) {
	/* Plugin CSS Style */
    src( [ stylePluginSRC ] )
		.pipe( sourcemaps.init() )
		.pipe( sass({
			errLogToConsole: true,
			outputStyle: 'compressed'
		}) )
		.on( 'error', console.error.bind( console ) )
		.pipe( autoprefixer({ overrideBrowserslist: [ 'last 2 versions', '> 5%', 'Firefox ESR' ] }) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( sourcemaps.write( mapPluginURL ) )
		.pipe( dest( stylePluginURL ) )
		.pipe( browserSync.stream() );

    /* Theme CSS Style */
    src( [ styleThemeSRC, styleThemeAdminSRC, styleThemeFormsSRC, styleThemeHomeSRC ] )
		.pipe( sourcemaps.init() )
		.pipe( sass({
			errLogToConsole: true,
			outputStyle: 'compressed'
		}) )
		.on( 'error', console.error.bind( console ) )
		.pipe( autoprefixer({ overrideBrowserslist: [ 'last 2 versions', '> 5%', 'Firefox ESR' ] }) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( sourcemaps.write( mapThemeURL ) )
		.pipe( dest( styleThemeURL ) )
		.pipe( browserSync.stream() );
	
    done();
};

function js(done) {
	jsPluginFiles.map( function( entry ) {
		return browserify({
			entries: [jsPluginSRC + entry]
		})
		.transform( babelify, { presets: [ '@babel/preset-env' ] } )
		.bundle()
		.pipe( source( entry ) )
		.pipe( rename( {
			extname: '.min.js'
        } ) )
		.pipe( buffer() )
		.pipe( gulpif( options.has( 'production' ), stripDebug() ) )
		.pipe( sourcemaps.init({ loadMaps: true }) )
		.pipe( uglify() )
		.pipe( sourcemaps.write( '.' ) )
		.pipe( dest( jsPluginURL ) )
		.pipe( browserSync.stream() );
	});

    jsThemeFiles.map( function( entry ) {
		return browserify({
			entries: [jsThemeSRC + entry]
		})
		.transform( babelify, { presets: [ '@babel/preset-env' ] } )
		.bundle()
		.pipe( source( entry ) )
		.pipe( rename( {
			extname: '.min.js'
        } ) )
		.pipe( buffer() )
		.pipe( gulpif( options.has( 'production' ), stripDebug() ) )
		.pipe( sourcemaps.init({ loadMaps: true }) )
		.pipe( uglify() )
		.pipe( sourcemaps.write( '.' ) )
		.pipe( dest( jsThemeURL ) )
		.pipe( browserSync.stream() );
	});

	done();
};

function triggerPlumber( src_file, dest_file ) {
	return src( src_file )
		.pipe( plumber() )
		.pipe( dest( dest_file ) );
}

// function images() {
// 	return triggerPlumber( imgSRC, imgURL );
// };

// function fonts() {
// 	return triggerPlumber( fontsSRC, fontsURL );
// };

function watch_files() {
	watch(stylePluginWatch, series(css, reload));
    watch(styleThemeWatch, series(css, reload));
	watch(jsPluginWatch, series(js, reload));
    watch(jsThemeWatch, series(js, reload));
	// watch(imgWatch, series(images, reload));
	// watch(fontsWatch, series(fonts, reload));
	watch(phpWatch, reload);
	src(jsPluginURL + 'di-plugin.min.js');
    src(jsThemeURL + 'di-theme.min.js');
}

function watch_php() {
    watch(phpWatch, reload);
}

task("css", css);
task("js", js);
// task("images", images);
// task("fonts", fonts);
task("live", parallel(browser_sync, watch_php));
task("default", parallel(css, js/*, images, fonts*/));
task("watch", parallel(browser_sync, watch_files));