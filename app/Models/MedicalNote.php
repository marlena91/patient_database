<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalNote extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
