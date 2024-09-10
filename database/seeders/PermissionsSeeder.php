<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['action' => 'index', 'name' => 'read']);
        Permission::create(['action' => 'store', 'name' => 'create']);
        Permission::create(['action' => 'update', 'name' => 'update']);
        Permission::create(['action' => 'destroy', 'name' => 'delete']);
    }
}
