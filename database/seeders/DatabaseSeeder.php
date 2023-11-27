<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Insert roles into DB
        DB::table('roles')->truncate();
        $roles = [
            ['name' => 'admin'],
            ['name' => 'editor'],
            ['name' => 'user'],
        ];
        DB::table('roles')->insert($roles);

        // Insert users into DB
        DB::table('users')->truncate();
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'role_id' => '1',
            ],
            [
                'name' => 'editor',
                'email' => 'editor@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'role_id' => '2',
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'role_id' => '3',
            ],
        ];
        DB::table('users')->insert($users);

        // Insert permissions into DB
        $prefix = 'admin';

        $routes = collect(Route::getRoutes())->filter(function ($route) use ($prefix) {
            return Str::startsWith($route->uri, $prefix);
        });

        $permissions = $routes->map(function ($route) use ($prefix) {
            return ['name' => $route->getName()];
        })->values()->toArray();

        $prefixWithPost = 'admin.post';

        $permissionsForPost = collect($permissions)->filter(function ($route) use ($prefixWithPost) {
            return Str::startsWith($route['name'], $prefixWithPost);
        })->values()->toArray();
        // $permissions = [
        //     '0' => "admin.index",
        //     '1' => "admin.post.index",
        //     '2' => "admin.post.create",
        //     ...
        // ];
        DB::table('permissions')->truncate();
        DB::table('permissions')->insert($permissions);

        // Role permissions for Admin
        $rolePermissions = collect($permissions)->map(function ($permission, $index) {
            return ['role_id' => 1, 'permission_id' => ++$index];
        })->values()->toArray();

        // Role permissions for Editor
        $rolePermissionsForEditor = collect($permissionsForPost)->map(function ($permission, $index) {
            return ['role_id' => 2, 'permission_id' => ++$index];
        })->values()->toArray();

        DB::table('permission_role')->truncate();
        DB::table('permission_role')->insert([...$rolePermissions, ...$rolePermissionsForEditor]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
