<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        $permissions = [
            'create_category',
            'read_category',
            'update_category',
            'delete_category',
            'create_book',
            'read_book',
            'update_book',
            'delete_book',
            'create_user',
            'read_user',
            'update_user',
            'delete_user',
            'manage_roles'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
