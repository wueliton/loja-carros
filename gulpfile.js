import browserSync from 'browser-sync';
import gulp from 'gulp';

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
