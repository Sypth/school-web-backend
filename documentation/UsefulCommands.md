php artisan make:model Post -m (To create model and migration at the same time.)
php artisan make:controller Api/PostController --api (To create a controller with methods for RESTful API)
php artisan migrate (To migrate all the newly created migrations)
php artisan migrate:fresh --seed (To recreate the database table and insert all the seeder data on each table.)
php artisan serve (to expose all the api on the local network address)

INSTALLING SANCTUM
composer require laravel/sanctum
php artisan install:api

INSTALLING SPATIE LARAVEL PERMISSIONS
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate

CUTOM COMMANDS
To drop all tables and rerun migrations from subfolders:
command: php artisan migrate:subfolder --fresh

To drop all tables, rerun migrations, and seed the database:
command: php artisan migrate:subfolders --fresh --seed

To just run the migrations from subfolders (without dropping tables or seeding):
command: php artisan migrate:subfolders

To only run migrations and seed the database:
command: php artisan migrate:subfolders --seed

Note: You can modify this command on app/Console/Commands/MigrateSubfolders.php
