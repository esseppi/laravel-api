const mix = require("laravel-mix");

const VuetifyLoaderPlugin = require("vuetify-loader/lib/plugin");
var CaseSensitivePathsPlugin = require("case-sensitive-paths-webpack-plugin");
mix.extend(
    "vuetify",
    new (class {
        webpackConfig(config) {
            config.plugins.push(new VuetifyLoaderPlugin());
            config.plugins.push(new CaseSensitivePathsPlugin());
        }
    })()
);
mix.vuetify();

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/admin.js", "public/js")
    .js("resources/js/front.js", "public/js")
    .sass("resources/sass/app.scss", "public/css");
