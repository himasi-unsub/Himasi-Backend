# Himasi Backend

## About

Himasi Backend is a web application that is used to manage the Himasi organization's data. This application is built using the Laravel framework and is equipped with various features such as user management, role management, and document management.

## Installation

1. Clone this repository
2. Run `composer install` or `composer update`
3. Run `npm install` or `yarn install`
4. Run `cp .env.example .env`
5. Run `php artisan key:generate`
6. Run `php artisan migrate`
7. Run `php artisan storage:link`
8. Run `php artisan serve`

### For debugging purpose

1. Run `php artisan telescope:install`
2. Run `php artisan migrate`
3. Set `TELESCOPE_ENABLED=true` in `.env`
4. Run `php artisan serve`

## [Folder Structure](folder-structure.md)

## [To-Do List](to-do-list.md)

## Libraries

-   [Laravel](https://laravel.com)
-   [Laravel Jetstream](https://laravel.com/docs/11.x/starter-kits)
-   [Laravel Sanctum](https://laravel.com/docs/11.x/sanctum)
-   [Laravel Telescope](https://laravel.com/docs/11.x/telescope)
-   [Laravel Livewire](https://livewire.laravel.com)
-   [FilamentPHP](https://filamentphp.com)
-   [TailwindCSS](https://tailwindcss.com)
-   [PhpWord](https://phpword.readthedocs.io)
-   [MaryUI](https://maryui.com)

## License

The Himasi Backend is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
