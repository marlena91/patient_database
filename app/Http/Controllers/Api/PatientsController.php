<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientIndexResource;
use App\Http\Resources\PatientShowResource;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Services\PeselValidate;
use Facade\FlareClient\Http\Response;
use Laravel\Ui\Presets\React;
use LDAP\Result;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {

        return PatientIndexResource::collection(
            Patient::all()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'pesel' => 'required|unique:patients|digits:11',
            'birthday' => 'required|date'
        ]);

        $pesel =  new PeselValidate($request->pesel, $request->birthday);
         if ($pesel->validate()) {
             $patient = Patient::create([
                 'name' => $request->input('name'),
                 'lastname' => $request->input('lastname'),
                 'pesel' => $request->input('pesel'),
                 'birthday' => $request->input('birthday'),
             ]);

             return response()->json([
                 'message' => 'Patient Created Successfully!!',
                 'patient' => $patient
             ]);
         } else {
             return response()->json([
                 'message' => 'Patient Not Created!!',
             ]);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PatientShowResource
     */
    public function show($id)
    {
        $patient = Patient::findOrFail($id);

        return new PatientShowResource($patient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'pesel' => 'required|digits:11',
            'birthday' => 'required|date'
        ]);


        $patient->fill($request->post())->save();
        return response()->json([
            'message' => 'Patient Updated Successfully!!',
            'patient' => $patient
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return response()->json([
            'message' => 'Patient Deleted Successfully!!'
        ]);
    }
}
