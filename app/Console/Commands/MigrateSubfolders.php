<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;
use Artisan;

class MigrateSubfolders extends Command
{
    protected $signature = 'migrate:subfolders {--fresh} {--seed}';

    protected $description = 'Run migrations from subfolders in database/migrations, with optional fresh and seed';

    public function handle()
    {
        $migrationPath = database_path('migrations');
        $subfolders = File::directories($migrationPath);

        if ($this->option('fresh')) {
            $this->info('Dropping all tables...');
            Artisan::call('migrate:fresh');
            $this->info('Database has been refreshed.');
        }

        // Loop through each subfolder and run migrations
        foreach ($subfolders as $folder) {
            $this->info("Running migrations in: $folder");
            Artisan::call('migrate', ['--path' => 'database/migrations/' . basename($folder)]);
        }

        // Optionally run the seeder if requested
        if ($this->option('seed')) {
            $this->info('Running database seeder...');
            Artisan::call('db:seed');
            $this->info('Seeding completed.');
        }

        $this->info('Migrations from subfolders completed successfully.');
    }
}
