<?php

namespace Database\Seeders;

use App\Models\Disease;
use Illuminate\Database\Seeder;
use App\Models\MedicalNote;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Patient::factory(10)->create()->each(function ($patient) {

        //     $med_notes = MedicalNote::factory(5)->make();
        //     $patient->med_notes()->saveMany($med_notes);
        // });


        $this->call([
            UsersTableSeeder::class,
            PatientsTableSeeder::class,
            MedicalNotesTableSeeder::class,
            DiseasesTableSeeder::class,
            DiseasePatientTableSeeder::class,
        ]);

    }
}
