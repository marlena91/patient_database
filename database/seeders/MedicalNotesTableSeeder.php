<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicalNote;

class MedicalNotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MedicalNote::factory()->count(50)->create();
    }
}
