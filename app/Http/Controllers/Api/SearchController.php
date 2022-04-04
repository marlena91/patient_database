<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientShowResource;
use App\Models\Patient;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PatientShowResource
     */



    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'name' => 'string',
            'lastname' => 'string',
            'pesel' => 'integer',
            'birthday' => 'date'
        ]);

        $patients = Patient::where('name','like','%'.$data['name'].'%')
            ->orWhere('lastname','like','%'.$data['lastname'].'%')
            ->orWhere('pesel','like','%'.$data['pesel'].'%')
            ->orWhere('birthday','like','%'.$data['birthday'].'%')
            ->get();
        dd($patients);
    }
}
