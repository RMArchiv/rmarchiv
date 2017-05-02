var elixir = require('laravel-elixir');
require('laravel-elixir-vue-2');

elixir(function(mix) {

    // define some paths for our bower component sass files
    var paths = {
        'js':           './resources/assets/js/',
        'sass':         './resources/assets/sass/',
        'jquery':       './bower_components/jquery/dist/',
        'jquery_ui':    './bower_components/jquery-ui/',
        'bootstrap':    './node_modules/bootstrap-sass/assets/javascripts/',
        'typeahead':    './bower_components/typeahead.js/dist/',
        'fineuploader': './bower_components/fine-uploader/dist/',
        'jqcloud2':     './bower_components/jqcloud2/dist/',
        'inlineattachment': './bower_components/inline-attachment/dist/',
        'editormd':     './bower_components/editor.md/',
    };

    mix.sass(
        'app.scss',
        'public/css/'
        )

    // copy the assets we need from the bootstrap path
        //.copy(paths.bootstrap.fonts, 'public/fonts')

        // concatenate the scripts from the packages and the resources folder
        .scripts([
            paths.jquery           + 'jquery.js',
            paths.jquery_ui        + 'jquery-ui.js',
            paths.bootstrap        + 'bootstrap.js',
            paths.typeahead        + 'typeahead.bundle.js',
            paths.fineuploader     + 'fine-uploader.js',
            paths.jqcloud2         + 'jqcloud.js',
            paths.inlineattachment + 'inline-attachment.js',
            paths.inlineattachment + 'jquery.inline-attachment.js',
            paths.js               + 'commonmark.js',
            paths.editormd         + 'editormd.js'
            //paths.js            + 'app.js'
        ])

        // set up a versioned build for use with the elixir(..) helper in our views
        .version([
            'css/app.css',
            'js/all.js'
        ])

        // refresh our browser
        //.browserSync({
        //    proxy: 'sandbox.dev'
        //});
});