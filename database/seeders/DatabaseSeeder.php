<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $roles = [
            ['name' => 'admin'],
            ['name' => 'editor'],
            ['name' => 'user'],
        ];
        DB::table('roles')->insert($roles);

        $permissions = [
            ['name' => 'create_post'],
            ['name' => 'edit_post'],
            ['name' => 'delete_post'],
            ['name' => 'create_user'],
            ['name' => 'edit_user'],
            ['name' => 'delete_user'],
        ];
        DB::table('permissions')->insert($permissions);

        $rolePermissions = [
            ['role_id' => 1, 'permission_id' => 1], // admin - create_post
            ['role_id' => 1, 'permission_id' => 2], // admin - edit_post
            ['role_id' => 1, 'permission_id' => 3], // admin - delete_post
            ['role_id' => 1, 'permission_id' => 4], // admin - create_user
            ['role_id' => 1, 'permission_id' => 5], // admin - edit_user
            ['role_id' => 1, 'permission_id' => 6], // admin - delete_user
            ['role_id' => 2, 'permission_id' => 1], // editor - create_post
            ['role_id' => 2, 'permission_id' => 2], // editor - edit_post
            ['role_id' => 2, 'permission_id' => 3], // editor - delete_post
            ['role_id' => 3, 'permission_id' => 1], // user - create_post
        ];
        DB::table('permission_role')->insert($rolePermissions);
    }
}
