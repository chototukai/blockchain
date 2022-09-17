<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Patient;
use App\Models\Doctor;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
       $type = $request->query('type');
       
       if($type === 'patient') {
           $records = Patient::all();
       } else {
           $records = Doctor::all();
       }
        
        return response()->json([
            'data' =>$records,
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
    public function store(Request $request)
    {
        $requestedData = $request->all();
        $requestedData['password'] = Hash::make($requestedData['password']);
        $requestedData['public_key'] = Str::uuid()->toString();
        
        if($requestedData['type'] === 'patient' ) {
            unset($requestedData['type']);
            $user = Patient::create($requestedData);
        } else {
            unset($requestedData['type']);
            $user = Doctor::create($requestedData);
        }
        return response()->json([
            'data' => $user,
            'msg' => 'User created',
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
