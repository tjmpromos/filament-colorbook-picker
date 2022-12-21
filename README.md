# Colorbook Picker for FilamentPHP

FilamentPHP field to show options based on a predefined color book, with previews of the color value in the dropdown and around the field after selection.

This could be used for any number of colorbooks such as [Pantone®️](https://www.pantone.com/color-systems/pantone-color-systems-explained), [GMG OpenColor](https://gmgcolor.com/products/opencolor/), [Project BBCG](https://www.projectbbcg.guide/), [Swatchos](https://www.swatchos.com/), [SMS](https://www.spot-nordic.com/sms/) or any other proprietary color system such as thread colors in embroidery, shirt colors in printing, custom ink colors in printing, etc... It's really up to you!

All you need to do is provide the proper name (called label here), the value you want to pass to your form (usually the same as the label, but you may want to snake_case it or something) and a hex value (as of now, do not pass a #, but I plan on adding that check in very soon).

## TODO

- Add check for # in hex value
- Maybe change `hex` to `colorValue` so that its clear you can pass in any valid CSS value (?)
- Add color definitions to config file so that they can easily be called in the `->options()` method. Need to allow for multiple color books with any name.
- Pass the `label` to a repeater label so that the label displays as the pretty name instead of the actual value


## Requirements
- PHP 8.0+
- Laravel 8.0+
- Livewire 2.0+
- FilamentPHP 2.0+

## Installation

You can install the package via composer:

```bash
composer require dymond/filament-colorbook-picker
```

The package uses the following dependencies:
- [Alpinejs](https://alpinejs.dev/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Tailwind CSS Forms Plugin](https://github.com/tailwindlabs/tailwindcss-forms)
- [Tailwind CSS Typography Plugin](https://tailwindcss.com/docs/typography-plugin)

```bash
pnpm install alpinejs tailwindcss @tailwindcss/forms @tailwindcss/typography --save-dev
```

### Configuring Tailwind CSS

To finish installing Tailwind, you must create a new `tailwind.config.js` file in the root of your project. The easiest way to do this is by running `npx tailwindcss init`.

In `tailwind.config.js`, register the plugins you installed, and add custom colors used by the form builder:

```js
const colors = require('tailwindcss/colors') 
 
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './vendor/filament/**/*.blade.php', 
    ],
    theme: {
        extend: {
            colors: { 
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
            }, 
        },
    },
    plugins: [
        require('@tailwindcss/forms'), 
        require('@tailwindcss/typography'), 
    ],
}
```
Of course, you may specify your own custom `primary`, `success`, `warning` and `danger` colors, which will be used instead.

## Bundling Assets

New Laravel projects use Vite for bundling assets by default. However, your project may still use Laravel Mix. Read the steps below for the bundler used in your project.

### Vite
If you're using Vite, you should manually install [Autoprefixer](https://github.com/postcss/autoprefixer), [postcss-import](https://tailwindcss.com/docs/using-with-preprocessors#build-time-imports) and [tailwindcss/nesting](https://tailwindcss.com/docs/using-with-preprocessors#nesting) through NPM:

Create a `postcss.config.js` file in the root of your project, and register Tailwind CSS and Autoprefixer as plugins:

```js
module.exports = {
    plugins: {
        'postcss-import': {},
        'tailwindcss/nesting': {},
        tailwindcss: {},
        autoprefixer: {},
    },
}
```
You may also want to update your `vite.config.js` file to refresh the page after Livewire components or custom form components have been updated:
```js
import { defineConfig } from 'vite'
import laravel, { refreshPaths } from 'laravel-vite-plugin' 
 
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: [ 
                ...refreshPaths,
                'app/Http/Livewire/**',
                'app/Forms/Components/**',
            ], 
        }),
    ],
})
```
### Configuring styles
In `/resources/css/app.css`, import `filament/forms` vendor CSS and [Tailwind CSS](https://tailwindcss.com/):

```js
import Alpine from 'alpinejs'
import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm'
 
Alpine.plugin(FormsAlpinePlugin)
Alpine.plugin(NotificationsAlpinePlugin)
 
window.Alpine = Alpine
 
Alpine.start()
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-colorbook-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-colorbook-views"
```

## Usage

This essentially works like the normal [select field](https://filamentphp.com/docs/2.x/forms/fields#select) in FilamentPHP with some extra options for adding colors. You'll reference it like this:

```php
ColorbookPicker::make('color_selection')
    ->label('Your Label')
    ->placeholder('Your Placeholder')
    ->options([
      ['label' => 'Color Display Name', 'value' => 'color_value_name', 'hex' => 'FFFFFF'],
      ['label' => 'Color Display Name', 'value' => 'color_value_name', 'hex' => '000000'],
    ])
    ->searchable(),
```

You'll want to make sure to format your color book in this same way as the options are formatted here.

---

The only difference between this and a regular select field is that `->allowHtml()` is always set to on. This isn't a very common option, so you may not have seen it used. It's essentially only ever set on select fields and it's just a passthrough to a [choices.js](https://github.com/Choices-js/Choices) method.

This is something FilamentPHP's select field has by default so any security concerns you have with that should be considered here, but if you are using an external source to populate your options, you should be very careful that you have full control over it because this can allow XSS scripting injections. You can read more about that on [here on the choices.js repo](https://github.com/Choices-js/Choices#allowhtml).

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Mike Wall](https://github.com/daikazu)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
