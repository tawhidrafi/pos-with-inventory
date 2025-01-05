<?php

namespace Database\Factories\Contact;

use App\Models\Contact\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition()
    {
        $users = User::all();
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->companyEmail,
            'phone' => $this->faker->unique()->phoneNumber,
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'company' => $this->faker->company,
            'tin' => $this->faker->unique()->randomNumber(9, true),
            'status' => 'active',
            'created_by' => $users->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
