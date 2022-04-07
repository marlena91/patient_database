<?php

namespace Database\Seeders;

use App\Models\DiseasePatient;
use Illuminate\Database\Seeder;

class DiseasePatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DiseasePatient::factory()->count(20)->create();
    }
}
