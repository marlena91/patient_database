<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedicalNoteIndexResource;
use App\Models\MedicalNote;
use Illuminate\Http\Request;

class MedicalNotesForPatientController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke($request)
    {
        return MedicalNoteIndexResource::collection(MedicalNote::where('patients_id', $request)->get());
    }
}
