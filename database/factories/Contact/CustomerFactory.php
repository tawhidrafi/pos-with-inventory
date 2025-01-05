<?php

namespace Database\Factories\Contact;

use App\Models\Contact\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        $users = User::all();

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->phoneNumber,
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'status' => 'active',
            'created_by' => $users->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
