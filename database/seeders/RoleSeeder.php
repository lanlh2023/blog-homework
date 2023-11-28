<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->truncate();
        $roles = [
            ['name' => 'admin'],
            ['name' => 'editor'],
            ['name' => 'user'],
        ];
        DB::table('roles')->insert($roles);
    }
}
