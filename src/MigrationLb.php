<?php

namespace Netsells\MigrationLb;

use Illuminate\Foundation\Application;
use Illuminate\Database\Migrations\Migrator;

class MigrationLb
{
    protected $migrator;
    protected $laravel;

    public function __construct(Application $laravel)
    {
        $this->migrator = app('migrator');
        $this->laravel = $laravel;
    }

    public function isReady(): bool
    {
        return ! $this->hasMigrationsInCodebaseButNotDb();
    }

    public function hasMigrationsInCodebaseButNotDb(): bool
    {
        return count($this->getMigrationsInCodebaseButNotDb()) > 0;
    }

    public function hasMigrationsInDbButNotInCodebase(): bool
    {
        return count($this->getMigrationsInDbButNotInCodebase()) > 0;
    }

    public function getMigrationsInCodebaseButNotDb(): array
    {
        return array_diff($this->getMigrationsInCodebase(), $this->getMigrationsInDatabase());
    }

    public function getMigrationsInDbButNotInCodebase(): array
    {
        return array_diff($this->getMigrationsInDatabase(), $this->getMigrationsInCodebase());
    }

    protected function getMigrationsInDatabase(): array
    {
        return $this->migrator->getRepository()->getRan();
    }

    protected function getMigrationsInCodebase(): array
    {
        $migrationsPath = $this->laravel->databasePath() . DIRECTORY_SEPARATOR . 'migrations';
        $migrationFilePaths = array_merge([$migrationsPath], $this->migrator->paths());

        $migrationFiles = $this->migrator->getMigrationFiles($migrationFilePaths);

        return array_keys($migrationFiles);
    }
}
