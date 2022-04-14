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

        $pesel = str_split($request->pesel);

        $reg = '/^[0-9]{11}$/';
        if (preg_match($reg, $request->pesel)) {

            $arrWagi = array(1, 3, 7, 9, 1, 3, 7, 9, 1, 3); // tablica z odpowiednimi wagami
            $intSum = 0;
            for ($i = 0; $i < 10; $i++) {
                $intSum += $arrWagi[$i] * $pesel[$i]; //mnożymy każdy ze znaków dla 10 pierwszych cyfr przez wagę i sumujemy wszystko
            }
            $int = 10 - $intSum % 10; //obliczamy sumę kontrolną i porównujemy ją z ostatnią cyfrą.
            $intControlNr = ($int == 10) ? 0 : $int; //sprawdzamy czy taka sama suma kontrolna jest w ciągu
            if ($intControlNr == $pesel[10]) {


                // Wyciągamy dzień i miesiąc
                $month = substr($request->pesel, 2, 2);
                $day = substr($request->pesel, 4, 2);

                // Budujemy tablicę miesięcy dozwolonych
                $arrAddToMonth = array(80, 0, 20, 40, 60);
                $arrMonthBase = range(1, 12);
                foreach ($arrAddToMonth as $monthAdditional) {
                    foreach ($arrMonthBase as $monthBase) {
                        $arrMonth[] = $monthAdditional + $monthBase;
                    }
                }

                // Odrzucamy nieprawidłowo podane miesiące
                if (in_array($month, $arrMonth)) {
                    // Set a century
                    if (substr($month, 0, 1) == '0' || substr($month, 0, 1) == '1') $century = 1900;
                    if (substr($month, 0, 1) == '8' || substr($month, 0, 1) == '9') $century = 1800;
                    if (substr($month, 0, 1) == '2' || substr($month, 0, 1) == '3') $century = 2000;
                    if (substr($month, 0, 1) == '5' || substr($month, 0, 1) == '4') $century = 2100;
                    if (substr($month, 0, 1) == '6' || substr($month, 0, 1) == '7') $century = 2200;
                    if ($century == '2000') $month = $month - 20;
                    if ($century == '1800') $month = $month - 80;
                    if ($century == '2100') $month = $month - 40;
                    if ($century == '2200') $month = $month - 60;

                    // Finally year
                    $year = $century + substr($request->pesel, 0, 2);

                    // Return the result
                    if (((substr($request->birthday, 0, 4)) == $year)
                        && ((substr($request->birthday, 5, 2)) == $month)
                        && ((substr($request->birthday, 8, 2)) == $day)
                    ) {
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
                    }
                }
            }


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
