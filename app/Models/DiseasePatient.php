<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseasePatient extends Model
{
    use HasFactory;

    protected $table = 'disease_patient';
    public $timestamps = false;

}
