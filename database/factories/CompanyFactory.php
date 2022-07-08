<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()


    {
        return [
            'name'=>$this->faker->unique()->domainWord(),
            'email'=>$this->faker->unique()->email(),
            'website'=>$this->faker->unique()->domainName(),
            'logo'=>'logo-1.svg'
        ];
    }
}
