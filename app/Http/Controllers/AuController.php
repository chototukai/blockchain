<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientEhrAuRequest;
use App\Models\PatientEhrRequest;

class AuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
       $requestedData = $request->all();
       $record = PatientEhrAuRequest::create($requestedData);
       //update EhrRequest table
       $patientEhrReq = PatientEhrRequest::find($requestedData['patient_ehr_request_id']);
       $patientEhrReq->status = 1;
       $patientEhrReq->save();
       
        return response()->json([
            'data' => $record,
            'msg' => 'Request sent to AU',
            'status' => true
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requestedData = $request->all();
        $patientEhrAuRequest = PatientEhrAuRequest::find($id);
        $patientEhrAuRequest->status = $requestedData['status'];
        $patientEhrAuRequest->save();
        //update EhrRequest table
        $patientEhrReq = PatientEhrRequest::find($patientEhrAuRequest->patient_ehr_request_id);
        $patientEhrReq->status = 2;
        $patientEhrReq->save();
        return response()->json([
            'msg' => 'AU updated the request',
            'status' => true
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
