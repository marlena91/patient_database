<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientIndexResource;
use App\Http\Resources\PatientShowResource;
use Illuminate\Http\Request;
use App\Models\Patient;
use Facade\FlareClient\Http\Response;
use Laravel\Ui\Presets\React;
use LDAP\Result;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        return  PatientIndexResource::collection(
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'pesel' => 'required|unique:patients',
            'birthday' => 'required|date'
        ]);

        $patient = Patient::create([
            'name' => $request->input('name'),
            'lastname' => $request->input('lastname'),
            'pesel' => $request->input('pesel'),
            'birthday' => $request->input('birthday'),
        ]);
        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new PatientShowResource(Patient::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        
        $patient->fill($request->post())->save();
        return response()->json([
            'message'=>'Patient Updated Successfully!!',
            'patient'=>$patient
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return response()->json([
            'message'=>'Category Deleted Successfully!!'
        ]);
    }
}
