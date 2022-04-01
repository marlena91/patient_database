<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Disease;

class DiseaseFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->text($maxNbChars = 30),
        ];
    }
}
