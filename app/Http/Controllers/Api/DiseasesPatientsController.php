<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiseasePatient;
use App\Models\Patient;


class DiseasesPatientsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($diseaseId, $patientId)
    {
        $diseasepatient = DiseasePatient::where('disease_id', $diseaseId)->where('patient_id', $patientId)->count();
        if ($diseasepatient) {
            return redirect('/patients/' . $patientId);
        } else {
            $patient = Patient::find($patientId);
            $patient->diseases()->attach($diseaseId);
            return response()->json([
                'message' => 'Patient Updated Successfully!!',
            ]);
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($diseaseId, $patientId)
    {
        $patient = Patient::find($patientId);
        $patient->diseases()->detach($diseaseId);
        return response()->json([
            'message' => 'Disease Deleted Successfully!!',
        ]);
    }
}
