let mix = require('laravel-mix');


mix.styles([
    'node_modules/admin-lte/node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/admin-lte/dist/css/AdminLTE.css',
    'node_modules/admin-lte/plugins/iCheck/square/blue.css',

    'resources/assets/css/custom.css'
], 'public/css/app.css');

mix.scripts([
     // lib
     'resources/assets/js/jquery-2.2.3.min.js',
     'node_modules/admin-lte/node_modules/bootstrap/dist/js/bootstrap.min.js',
     'node_modules/admin-lte/plugins/iCheck/icheck.min.js',

     // app
     'resources/assets/js/main.js'
    ], 'public/js/app.js'
);

// add version when run "npm run production"
if (mix.inProduction()) {
 mix.version();
}

require('dotenv').config();
// get config from .env (need require dotenv package)
mix.browserSync({
 proxy: process.env.APP_URL,
 port: 3000         // go to url: localhost:3000
});