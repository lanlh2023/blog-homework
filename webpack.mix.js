const mix = require("laravel-mix");

mix.options({
    polyfills: [
        'Promise'
    ]
});

mix.webpackConfig({
    stats: {
        children: true,
    },
});

// Group for common start
mix.js('resources/js/app.js', 'public/js').version();

mix.sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/common.js', 'public/js').version();

mix.js([
    'resources/js/custom-jquery/custom-message.js',
    'resources/js/custom-jquery/custom-method.js',
], 'public/js/custom-jquery/custom-jquery-validation.js').version();

mix.styles('resources/css/message/alert-message.css', 'public/css/message/alert-message.css');

// Group for common end

// Group for admin start
mix.js('resources/js/admin/post/add.js', 'public/js/admin').version();

mix.styles('resources/css/admin/app.css', 'public/css/admin/app.css');
// Group for admin end

// Group for user start

mix.js([
    'resources/js/validation/login-form.js',
    'resources/js/validation/register-form.js',
], 'public/js/validation/form-validation.js').version();
// Group for user end
