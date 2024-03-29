const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('fontawesome', './assets/fontawesome-free-5.15.4-web/js/all.js')
    .addEntry('bootstrap.bundle.min.js', './assets/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js')
    .addEntry('App', './assets/js/app.js')
    .addEntry('sideNav', './assets/js/sideNav.js')
    .addEntry('datepickerJS', './assets/js/datepicker.js')
    .addEntry('datepickerMIN', './assets/js/bootstrap-datepicker.min.js')
    .addEntry('multiselectJS', './assets/js/multiselect.min.js')
    .addEntry('sliderJS', './assets/js/slider.js')
    .addEntry('contactJS', './assets/js/pages/contactJS.js')
    .addEntry('cardEntity', './assets/js/pages/cardEntity.js')
    .addEntry('homeMap', './assets/js/pages/homeMap.js')

    .addStyleEntry('bootstrap', './assets/bootstrap-5.1.3-dist/css/bootstrap.css')
    .addStyleEntry('style', './assets/styles/style.scss')
    .addStyleEntry('home', './assets/styles/pages/home.scss')
    .addStyleEntry('login', './assets/styles/pages/login.scss')
    .addStyleEntry('sidenav', './assets/styles/sidenav.scss')
    .addStyleEntry('cards', './assets/styles/cards.scss')
    .addStyleEntry('contact', './assets/styles/pages/contact.scss')
    .addStyleEntry('datePicker', './assets/styles/datepicker.css')
    .addStyleEntry('multiselect', './assets/styles/multiselectCSS.css')
    .addStyleEntry('slider', './assets/styles/slider.scss')
    .addStyleEntry('gestionEntity', './assets/styles/pages/gestionEntity.scss')
    .addStyleEntry('presentation', './assets/styles/pages/presentation.scss')

    // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
    .enableStimulusBridge('./assets/controllers.json')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    // enables Sass/SCSS support
    .enableSassLoader()

// uncomment if you use TypeScript
//.enableTypeScriptLoader()

// uncomment if you use React
//.enableReactPreset()

// uncomment to get integrity="..." attributes on your script & link tags
// requires WebpackEncoreBundle 1.4 or higher
//.enableIntegrityHashes(Encore.isProduction())

// uncomment if you're having problems with a jQuery plugin
//.autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();