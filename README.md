# Himasi Backend

## About

Himasi Backend is a web application that is used to manage the Himasi organization's data. This application is built using the Laravel framework and is equipped with various features such as user management, role management, and document management.

## System Requirements

To run the Himasi Backend application, your system must meet the following requirements:

- PHP >= 8.2
- Composer
- Node.js >= 12.x
- NPM or Yarn
- MySQL or MariaDB or PostgreSQL
- Apache or Nginx

## Installation

1. Clone this repository
2. Run `composer install` or `composer update`
3. Run `npm install` or `yarn install`
4. Run `npm run build` or `yarn run build`
5. Run `cp .env.example .env`
6. Run `php artisan key:generate`
7. Run `php artisan migrate`
8. Run `php artisan storage:link`
9. Run `php artisan serve`

### For debugging purpose

1. Set `TELESCOPE_ENABLED=true` in `.env`
2. Run `php artisan serve`

### For creating user

1. Run `php artisan make:filament-user`
2. Fill all input in terminal

### What you need to learn?

-   [Laravel](https://laravel.com)
-   [Laravel Livewire](https://livewire.laravel.com)
-   [FilamentPHP](https://filamentphp.com)
-   [TailwindCSS](https://tailwindcss.com)

## [Folder Structure](folder-structure.md)

## [To-Do List](to-do-list.md)

## Libraries

-   [Laravel](https://laravel.com)
-   [Laravel Jetstream](https://laravel.com/docs/11.x/starter-kits)
-   [Laravel Sanctum](https://laravel.com/docs/11.x/sanctum)
-   [Laravel Telescope](https://laravel.com/docs/11.x/telescope)
-   [Laravel Pulse](https://laravel.com/docs/11.x/pulse)
-   [Laravel Octane](https://laravel.com/docs/11.x/octane)
-   [Laravel Livewire](https://livewire.laravel.com)
-   [FilamentPHP](https://filamentphp.com)
-   [TailwindCSS](https://tailwindcss.com)
-   [PhpWord](https://phpword.readthedocs.io)
-   [MaryUI](https://maryui.com)

## License

The Himasi Backend is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
