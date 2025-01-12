const mix = require('laravel-mix');
const webpack = require('webpack');

mix.js('resources/js/app.js', 'public/js')
   .vue() // Assure-toi que Mix est configuré pour Vue 3
   .postCss('resources/css/app.css', 'public/css', [
       require('tailwindcss'),
   ]);

   // Ajoute la configuration Webpack pour Vue 3
mix.webpackConfig({
    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.esm-bundler.js', // Utilisation du build spécifique à Vue 3
        },
    },
    plugins: [
        new webpack.DefinePlugin({
            __VUE_OPTIONS_API__: true,
            __VUE_PROD_DEVTOOLS__: false,
            __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: false, // Ajout du flag manquant
        }),
    ],
});