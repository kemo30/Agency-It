<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Project;

class taskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'details' => $this->faker->sentence(40),
            'employee_id' => User::all()->where('is_admin', 0)->random()->id,
            'project_id' =>  Project::all()->random()->id,
            

        ];
    }
}
