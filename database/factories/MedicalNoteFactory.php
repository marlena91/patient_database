<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MedicalNote;
use App\Models\Patient;


class MedicalNoteFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->text(80),
            'description' => $this->faker->text(1000),
            'patient_id' => Patient::inRandomOrder()->first()->id,
        ];
    }
}
