<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MedicalNote;

class MedicalNoteFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->text(80),
            'description' => $this->faker->text(1000),
        ];
    }
}
