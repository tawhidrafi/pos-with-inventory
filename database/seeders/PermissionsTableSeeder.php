<?php

namespace Database\Seeders;

use App\Models\Admin\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'manage-brands',
            'manage-warehouses',
            'manage-units',
            'manage-product-categories',
            'manage-products',
            'manage-suppliers',
            'manage-customers',
            'manage-expense-categories',
            'manage-expenses',
            'manage-purchase',
            'manage-sale',
            'manage-purchase-return',
            'manage-sale-return',
            'manage-transfers',
            'manage-adjustments',
            'manage-variations',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
