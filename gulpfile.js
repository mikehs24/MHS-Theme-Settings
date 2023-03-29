const { series, parallel, watch, src, dest } = require('gulp');
const yargs = require('yargs');
const sass = require('gulp-sass');
const cleanCss = require('gulp-clean-css');
const gulpif = require('gulp-if');
const sourcemaps = require('gulp-sourcemaps');
const imagemin = require('gulp-imagemin');
const del = require('del');
const webpack = require('webpack-stream');
const zip = require('gulp-zip');
const uglify = require('gulp-uglify');
const named = require('vinyl-named');
const browserSync = require('browser-sync');
const replace = require('gulp-replace');
const rename = require('gulp-rename');
const info = require('./package.json');


const server = browserSync.create();
const PRODUCTION = yargs.argv.prod;

const paths = {
	rename: {
		src: [
			'languages/_pluginname.*',
			'languages/_pluginname*.po',
			'languages/_pluginname*.mo'
		]
	},
	styles: {
		src: [
			'src/scss/mhste-admin.scss',
			'src/scss/mhste-style.scss',
			// 'src/scss/editor.scss'
		],
		dest: 'assets/css',
	},
	scripts: {
		src: [
			// 'src/js/main.js', 
			// 'src/js/admin.js'
		],
		dest: 'assets/js',
	},
	images: {
		src: 'src/img/**/*.{jpg,jpeg,png,svg,gif}',
		dest: 'assets/img',
	},
	others: {
		src: ['src/**/*', '!src/{img,js,scss}', '!src/{img,js,scss}/**/*'],
		dest: 'assets',
	},
	package: {
		src: [
			'**/*', 
			'!.vscode',
			'!desktop.ini', 
			'!node_modules{,/**}', 
			'!packaged{,/**}', 
			'!src{,/**}', 
			'!.babelrc', 
			'!.gitignore', 
			'!gulpfile.js', 
			'!package.json', 
			'!package-lock.json',
			'!languages/_pluginname*.*',
			'!languages/*backup*.*',
			'!inc/dump.php'
		],
		dest: 'packaged'
	}
};

function replace_filenames(done) {
	src(paths.rename.src)
		.pipe(rename((path) => {
			path.basename = path.basename.replace('_pluginname', info.name)
		}))
		.pipe(dest('languages/'))
	done();
}

async function makeZip(done) {
	await src(paths.package.src)
		.pipe(replace('_pluginname', info.name))
		.pipe(zip(`${info.name}.zip`))
		.pipe(dest(paths.package.dest));
	done();
}

function startBrowserSync(done) {
	server.init({
		proxy: "http://test.local/wp-admin/admin.php?page=mhs-settings-page"
    });
	done();
};

function reload(done) {
	server.reload();
	done();
};

function styles(done) {
	src(paths.styles.src)
		.pipe(gulpif(!PRODUCTION, sourcemaps.init()))
		.pipe(sass().on('error', sass.logError))
		.pipe(gulpif(PRODUCTION, cleanCss({ compatibility: 'ie8' })))
		.pipe(gulpif(!PRODUCTION, sourcemaps.write()))
		.pipe(dest(paths.styles.dest))
		.pipe(server.stream())
	done();
};

// function scripts(done) {
// 	src(paths.scripts.src)
//         .pipe(named())
//         .pipe(webpack({
//             module: {
//                 rules: [
//                     {
//                         test: /\.js$/,
//                         use: {
//                                 loader: 'babel-loader',
//                                 options: {
//                                     presets: ['@babel/preset-env']
//                             }
//                         }
//                     }
//                 ]
//             },
//             output: {
//                 filename: '[name].js'
//             },
//             devtool: !PRODUCTION ? 'inline-source-map' : false,
//             mode: PRODUCTION ? 'production' : 'development' 
//         }))
//         .pipe(gulpif(PRODUCTION, uglify()))
// 		.pipe(dest(paths.scripts.dest))
// 	done();
// };

function images(done) {
	src(paths.images.src)
		.pipe(gulpif(PRODUCTION, imagemin()))
		.pipe(dest(paths.images.dest))
	done();
};

function copy(done) {
	src(paths.others.src)
	.pipe(dest(paths.others.dest))
	done();
};

async function cleanStuff(done) {
	await del(['assets'])
	done();
};

function watchChanges(done) {
	watch('src/scss/**/*.scss', series(styles, reload))
    // watch('src/js/**/*.js', series(scripts, reload))
	watch('**/*.php', reload)
	watch(paths.images.src, series(images, reload))
	watch(paths.others.src, series(copy, reload))
	done();
};

exports.styles = styles;
exports.watchChanges = watchChanges;
exports.replace_filenames = replace_filenames;
exports.images = images;
exports.copy = copy;
exports.cleanStuff = cleanStuff;
// exports.scripts = scripts;
exports.makeZip = makeZip;

// const afterClean = parallel(styles, scripts, images, copy);
const afterClean = parallel(styles, images, copy);
const build = series(cleanStuff, afterClean);
const dev = series(build, startBrowserSync, watchChanges);
exports.dev = dev;
exports.build = build;
exports.bundle = series(makeZip); //nie dodaje folderu assets

exports.default = dev;