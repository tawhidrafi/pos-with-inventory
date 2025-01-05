<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact\Customer;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        Customer::factory()->count(5)->create();
    }
}
