# Laravel Migration Loadbalancer

Provides middleware that returns a 503 should there be any migrations that need migrating or if there are migrations on the db that do not exist in the codebase. This is to be used with a loadbalancer so that only the correct codebase is live when the database migrates.

See https://engineering.instawork.com/elegant-database-migrations-on-ecs-74f3487da99f

## Installation

You can install the package via composer:

```bash
composer require netsells/laravel-migration-loadbalanceer
```

## Usage

Laravel will auto-load the service provider. All you need to do is add the global middleware to the top of your stack in `app/Http/Kernel.php`.

``` php
protected $middleware = [
    \Netsells\MigrationLb\HandleMigrationLbMiddleware::class,
    // Other middleware
];
```

## Security

If you discover any security related issues, please email sam@netsells.co.uk instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
