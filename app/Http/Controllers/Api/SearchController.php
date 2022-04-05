<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientIndexResource;
use App\Models\Patient;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PatientIndexResource
     */

    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|nullable',
            'lastname' => 'string|nullable',
            'pesel' => 'numeric|nullable',
            'birthday' => 'date|nullable'
        ]);
        
        $dataName = $request->input('name');
        $dataLastname = $request->input('lastname');
        $dataPesel = $request->input('pesel');
        $dataBirthday = $request->input('birthday');

        return $patients = PatientIndexResource::collection(Patient::when($dataName, function ($query, $dataName) {
            $query->where('name','like','%'.$dataName.'%', 'AND');
        })->when($dataLastname, function ($query, $dataLastname) {
            $query->orWhere('lastname','like','%'.$dataLastname.'%', 'AND');
        })->when($dataPesel, function ($query, $dataPesel) {
            $query->orWhere('pesel','like','%'.$dataPesel.'%', 'AND');
        })->when($dataBirthday, function ($query, $dataBirthday) {
            $query->orWhere('birthday','like','%'.$dataBirthday.'%', 'AND');
        })
        ->get());
    
    }
}
