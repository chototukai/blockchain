<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Patient;
use App\Models\Doctor;
use Fliq\IpfsLaravel\Facades\Ipfs;

class PatientController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {


        return response()->json([
                    'data' => 'Patient Index',
                    'msg' => '',
                    'status' => true
                        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $patientId = $request->get('patient_id');
        if ($patientId) {
            //file upload
            $medicalFile = $request->file('medical_file');
            $fileName = time().$medicalFile->getClientOriginalName();
            $pathName = $medicalFile->getPathName();
            $resource = fopen($pathName, 'r');
            $results = Ipfs::add([
                        "$fileName" => $resource,
                            ], ['wrap-with-directory' => true]);
            $hashId = $results->last()['Hash'];
            $patient = Patient::find($patientId);
            $prevMedicalHistory = ($patient->medical_history != null) ? json_decode($patient->medical_history) : [];
            array_push($prevMedicalHistory,$hashId);
            $patient->medical_history = json_encode($prevMedicalHistory); 
            $patient->save();
            
            
        }


        return response()->json([
                    'msg' => 'Patient data',
                    'data' => 'Patient file uploaded successfully',
                    'status' => true,
                    'hash' => $hashId,
                        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $patient = Patient::find($id);
        //Update Patient info
        $requestedData = $request->all();
        
            foreach ($requestedData as $key => $val) {
                $patient->{$key} = $val;
            }
        
        $patient->save();
        return response()->json([
                    'msg' => 'Patient data',
                    'data' => $patient,
                    'status' => true
                        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
