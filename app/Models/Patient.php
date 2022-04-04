<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MedicalNote;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lastname', 'pesel', 'birthday'];

    public function medicalNote()
    {
        return $this->hasMany(MedicalNote::class);
    }

}
