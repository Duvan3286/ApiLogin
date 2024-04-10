<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'identification' => $this->faker->randomNumber(),
            'name' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'type_person_id' => $this->faker->numberBetween(1, 5),
            'job' => $this->faker->jobTitle,
            'destination' => $this->faker->city,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'reason' => $this->faker->sentence,
        ];
    }
}
