<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\MedicalNote;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lastname', 'pesel', 'birthday'];

    public function medicalNote()
    {
        return $this->hasMany(MedicalNote::class);
    }

    public function searchQuery(Builder $query, $data)
    {
        return $query->where('name','like','%'.$data.'%')
            ->orWhere('lastname','like','%'.$data.'%')
            ->orWhere('pesel','like','%'.$data.'%')
            ->orWhere('birthday','like','%'.$data.'%')
            ->get();
        

    }

    
}
