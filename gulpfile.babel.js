import { src, dest, watch, series, parallel } from "gulp";
import yargs from "yargs";
import sass from "gulp-sass";
import cleanCss from "gulp-clean-css";
import gulpif from "gulp-if";
import postcss from "gulp-postcss";
import sourcemaps from "gulp-sourcemaps";
import autoprefixer from "autoprefixer";
import imagemin from "gulp-imagemin";
import del from "del";
import webpack from "webpack-stream";
import browserSync from "browser-sync";
import zip from "gulp-zip";
import info from "./package.json";
import named from "vinyl-named";
import replace from "gulp-replace-task";
import wpPot from "gulp-wp-pot";

require("dotenv").config();

//import replace from "gulp-replace";

const PRODUCTION = yargs.argv.prod;

const devpatterns = [
  {
    json: {
      "PLUGIN_NAME": `${info.description} src`,
      "PLUGIN_VERSION": `${info.version}`
    }
  }
];

const prodpatterns = [
  {
    json: {
      "PLUGIN_NAME": `${info.description}`,
      "PLUGIN_VERSION": `${info.version}`
    }
  }
];

//PHP Replace
export const replace_php = () => {
  return src("src/php/**/*")
  .pipe(gulpif(!PRODUCTION, replace({patterns: devpatterns})))
  .pipe(gulpif(PRODUCTION, replace({patterns: prodpatterns})))
  .pipe(dest("./"));
};

//STYLES
export const styles = () => {
  return (
    src("src/scss/admin.scss")
      .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
      .pipe(sass().on("error", sass.logError))
      .pipe(gulpif(PRODUCTION, postcss([autoprefixer])))
      .pipe(gulpif(PRODUCTION, cleanCss({ compatibility: "ie8" })))
      .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
      .pipe(dest("./dist/css"))
  );
};

//ADMIN STYLE
export const adminStyle = () =>{
	return(
		src("src/scss/style.scss")
			.pipe(gulpif(!PRODUCTION, sourcemaps.init()))
			.pipe(sass().on("error", sass.logError))
			.pipe(gulpif(PRODUCTION, postcss([autoprefixer])))
			.pipe(gulpif(PRODUCTION, cleanCss({ compatibility: "ie8" })))
			.pipe(gulpif(!PRODUCTION, sourcemaps.write()))
			.pipe(dest("./dist/css"))
	)
}

//Image
export const images = () => {
  return src("src/images/**/*.{jpg,jpeg,png,svg,gif}")
    .pipe(gulpif(PRODUCTION, imagemin()))
    .pipe(dest("dist/images"));
};

//Watch
export const watching = () => {
  watch("src/scss/**/*.scss", series(styles, adminStyle, reload));
  watch("src/js/**/*.js", series(scripts, reload));
  watch("src/php/*.php", replace_php);
  watch(["**/*.php","**/*.twig","!src/php/*.php"], reload);
};

//Copy
export const copy = () => {
  return src([
  	"src/**/*",
    "!src/{images,js,scss,php}",
    "!src/{images,js,scss,php}/**/*",
  ]).pipe(dest("dist"));
};

// WP POT
export const pot = () => {
  return src(["*.php","includes/**/*.php","core/**/*.php"])
    .pipe(
      wpPot({
        domain: 'landing-page-tools',
        package: 'Landing_Page_Tools',
      })
    )
    .pipe(dest(`languages/landing-page-tools.pot`));
};


// Del
export const clean = () => del(["dist"]);

// Scripts
export const scripts = () => {
  return (
    src(["src/js/*"])
    .pipe(named())
      .pipe(
        webpack({
          module: {
            rules: [
              {
                test: /\.js$/,
                use: {
                  loader: "babel-loader",
                  options: {
                    presets: [],
                  },
                },
              },
            ],
          },
          mode: PRODUCTION ? "production" : "development",
          devtool: !PRODUCTION ? "inline-source-map" : false,
          output: {
            filename: "[name].js",
          },
        })
      )
      .pipe(dest("dist/js"))
    //src("src/js/dev.js").pipe(dest("dist/js"))
  );
};

//Browser Sync
const server = browserSync.create();
export const serve = (done) => {
  server.init({
    proxy: {
      target: process.env.DOMAIN,
      proxyReq: [
        function (proxyReq) {
          proxyReq.setHeader("Access-Control-Allow-Origin", "*");
        },
      ],
    },
    https: {
      key: process.env.SSL_KEY_FILE,
      cert: process.env.SSL_CERT_FILE,
    },
  });
  done();
};
export const reload = (done) => {
  server.reload();
  done();
};

//ZIP
export const compress = () => {
  return src([
    "**/*",
    "!base{,/**}",
    "!node_modules{,/**}",
    "!bundled{,/**}",
    "!src{,/**}",
    "!.babelrc",
    "!.gitignore",
    "!.env",
    "!gulpfile.babel.js",
    "!package.json",
    "!package-lock.json",
    "!dist/js/dev.js",
    "!composer.json",
    "!composer.lock",
    "!plugin.code-workspace",
    "!workspace.code-workspace"
  ])
    .pipe(zip(`${info.name}.zip`))
    .pipe(dest("../"));
};

// Build e Dev Run
export const dev = series(
  clean,
  parallel(styles, adminStyle, images, copy, scripts, replace_php),
  serve,
  watching
);
export const build = series(
  clean,
  parallel(styles, adminStyle, images, copy, scripts, replace_php),
  pot
);
export default dev;
