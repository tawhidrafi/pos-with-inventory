<?php

namespace Database\Seeders;

use App\Models\Contact\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::factory()->count(5)->create();
    }
}
