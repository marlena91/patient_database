<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patient;
use App\Models\Disease;

class DiseasePatientFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'disease_id' => Disease::inRandomOrder()->first()->id,  
            'patient_id' => Patient::inRandomOrder()->first()->id,  
        ];
    }
}
