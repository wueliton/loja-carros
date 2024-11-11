import browserSync from 'browser-sync';
import gulp from 'gulp';
import imagemin, { mozjpeg } from 'gulp-imagemin';
import sharpResponsive from 'gulp-sharp-responsive';
import webp from 'gulp-webp';

const mobileSizes = [320, 480, 768];
const desktopSizes = [1024, 1920];

gulp.task('watch-site', function () {
  browserSync.init({
    baseDir: './site/',
    files: ['**/*.(php|html|js|css)'],
    proxy: 'localhost:8888',
  });

  gulp
    .watch(['./site/**/*.(php|html|js|css)'])
    .on('change', browserSync.reload);
});

const bannerDesktop = () => {
  return gulp
    .src('site/assets/img/banners/*.{png,jpeg,jpg}', { encoding: false })
    .pipe(
      imagemin([
        mozjpeg({
          quality: 100,
        }),
      ]),
    )
    .pipe(
      sharpResponsive({
        formats: desktopSizes.map((size) => ({
          width: size,
          rename: { suffix: `-${size}` },
        })),
      }),
    )
    .pipe(gulp.dest('site/assets/img/banners/images'))
    .pipe(
      webp({
        quality: 100,
      }),
    )
    .pipe(gulp.dest('site/assets/img/banners/images/webp'));
};

const bannerMobile = () => {
  return gulp
    .src('site/assets/img/banners/mobile/*.{png,jpeg,jpg}', { encoding: false })
    .pipe(
      imagemin([
        mozjpeg({
          quality: 80,
        }),
      ]),
    )
    .pipe(
      sharpResponsive({
        formats: mobileSizes.map((size) => ({
          width: size,
          rename: { suffix: `-${size}` },
        })),
      }),
    )
    .pipe(gulp.dest('site/assets/img/banners/mobile/images'))
    .pipe(
      webp({
        quality: 100,
      }),
    )
    .pipe(gulp.dest('site/assets/img/banners/mobile/images/webp'));
};

const webpImages = () => {
  return gulp
    .src(
      [
        'site/assets/img/**/*.{png,jpeg,jpg}',
        '!site/assets/img/banners/**/*',
        '!site/assets/img/palavras-chave/**/*',
      ],
      { encoding: false },
    )
    .pipe(imagemin())
    .pipe(gulp.dest('site/assets/img'))
    .pipe(webp())
    .pipe(gulp.dest('site/assets/img/webp'));
};

export { bannerDesktop, bannerMobile, webpImages };
