<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MedicalNote;
use App\Http\Resources\MedicalNoteIndexResource;
use App\Http\Resources\MedicalNoteShowResource;

class MedicalNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  MedicalNoteIndexResource::collection(
            MedicalNote::all()
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
            'title' => 'required',
            'description' => 'required',
            'patients_id' => 'required'
        ]);

        $medicalNote = MedicalNote::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'patients_id' => $request->input('patients_id')
        ]);
        return response()->json([
            'message' => 'Medical Note Updated Successfully!!',
            'medicalNote' => $medicalNote
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return MedicalNoteShowResource
     */
    public function show($id)
    {
        return new MedicalNoteShowResource(MedicalNote::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, MedicalNote $medicalNote)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $medicalNote->fill($request->post())->save();
        return response()->json([
            'message' => 'Medical Note Updated Successfully!!',
            'medicalNote' => $medicalNote
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalNote $medicalNote)
    {
        $medicalNote->delete();
        return response()->json([
            'message' => 'Category Deleted Successfully!!'
        ]);
    }
}
