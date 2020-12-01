# Laravel Themes

This Laravel themes package makes your theming more fun and complete. You will have your own `laravel.mix.js` and `package.json` for each theme. With that structure you could have one theme with tailwind, another with bootstrap or bulma. This package was originally developed by caffeinated.


## Installation
Simply install the package through Composer. From here the package will automatically register its service provider and `Theme` facade.

```
composer require dalholm/laravel-theme
```

#### Publish config
```
php artisan vendor:publish --provider="Dalholm\Themes\ThemesServiceProvider" --tag="laravel-themes-config"
```
#### Create your first theme
```
php artisan make:theme Default
```

## Changelog
You will find a complete changelog history within the [CHANGELOG](CHANGELOG.md) file.


## Security
If you discover any security related issues, please email mikael@dalholm.se directly instead of using the issue tracker.

## Credits
- [Caffeinated](https://github.com/caffeinated)
- [All Contributors](../../contributors)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
