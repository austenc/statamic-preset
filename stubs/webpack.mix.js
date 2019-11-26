const mix = require('laravel-mix');
require('laravel-mix-purgecss');

mix
  .js('resources/js/app.js', 'public/js')
  .postCss('resources/css/app.css', 'public/css')
  .options({
    postCss: [
      require('postcss-import')(),
      require('tailwindcss')(),
      require('postcss-nesting')()
    ],
    processCssUrls: false
  })
  .purgeCss({
    whitelist: ['a', 'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'ol', 'ul', 'li']
  })
  .browserSync({
    proxy: process.env.MIX_APP_URL
  });

if (mix.inProduction()) {
  mix.version();
}
