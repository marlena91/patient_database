<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patient;


class MedicalNoteFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->text(80),
            'description' => $this->faker->sentences(6,true),
            'patients_id' => Patient::inRandomOrder()->first()->id,
        ];
    }
}
