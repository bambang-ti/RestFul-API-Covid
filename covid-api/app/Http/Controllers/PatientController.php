<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{   
     /** 
      * Fungsi untuk menampilkan semua data/resource
      * Menggunakan eloquent All
      * Cek isi data patients ada atau tidak menggunakan isEmpty dan if else 
      */
    public function index()
    {
        $patients = Patient::all();
        $output = $patients->isEmpty();
        if($output) {
            $data = [
                'message' => 'Data is empty'
            ];
            return response()->json($data,200);
             
        } else {
            $data = [
             'message' => 'Get All Resource',
             'data' => $patients
         ];
             return response()->json($data, 200);
        }
    }


    /**
     *  Fungsi untuk menambahkan data
     * menggunakan eloquent create
     * Validasi data dengan method validate 
     */
    public function store(Request $request)
    {   
        $validateData = $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'status' => 'required',
            'in_date_at' => 'required|date',
            'out_date_at' => 'required|date'
        ]);

        $patient = Patient::create($validateData);

        $data = [
            'message' => 'Resource is added succesfully',
            'data' => $patient
        ];
        return response()->json($data, 201);
    }


    /** 
     * Fungsi untuk menampilkan detail data/resource
     * Menggunakan eloquent find
     * Cek data ada atau tidak menggunakan if else
     */
    public function show($id)
    {
        $patient = Patient::find($id);

        if($patient){
            $data = [
            'message' => 'Get Detail Resource',
            'data' => $patient
            ];

            return response()->json($data, 200);
        } else{
            $data = [
            'message' => 'Resource not found',
        ];

        return response()->json($data, 404);
        }
    }


    /**
     * Fungsi untuk mengupdate data
     * Menggunakan eloquent find, update
     * Cek data ada atau tidak menggunakan if else
     * Validasi data jika yang di update partial
     */
    public function update(Request $request, $id)
    {   
        $patient = Patient::find($id);

        if($patient){

            $input = [
                'name' => $request->name ?? $patient->name,
                'phone' => $request->phone ?? $patient->phone,
                'address' => $request->address ?? $patient->address,
                'status' => $request->status ?? $patient->status,
                'in_date_at' => $request->in_date_at ?? $patient->in_date_at,
                'out_date_at' => $request->out_date_at ?? $patient->out_date_at
            ];

            $patient->update($input);

            $data = [
                'message' => 'Resource is update successfully',
                'data' => $patient
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found',
            ]; 

            return response()->json($data, 404);
        }
    }


    /* Fungsi untuk menghapus data
     * Menggunakan eloquent find, delete
     * Validasi data ada atau tidak menggunakan if else 
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);

        if($patient){
            $patient->delete();

            $data = [
                'message' => 'Resource is delete successfully'
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);
        }
    }


    /**
     * Fungsi untuk mencari data berdasarkan nama
     * Menggunakan eloquent where,get
     * Cek data apakah ada atau tidak menggunakan if else
     */
    public function search($name)
    {
    $patient = Patient::where('name', 'like', "%$name%")->get();
        if($patient){
            $data = [
            'message' => 'Get Searched Resource',
            'data' => $patient
            ];

            return response()->json($data, 200);
        } else{
            $data = [
            'message' => 'Resource not found',
        ];

        return response()->json($data, 404);
        }
    }


    /**
     * Fungsi untuk menampilkan data status positive
     * Menggunakan eloquent where, get
     * Menghitung banyak data menggunakan count
     * Cek data ada atau tidak menggunakan isEmpty dan if else
     */
    public function positive()
    {
        $patient = Patient::where('status', 'like', "%positive%")->get();
        $total = count($patient);
        $output = $patient->isEmpty();
        if($output){
            $data = [
            'message' => 'Get Positive resource',
            'total' => $total,
            'data' => 'Data patient positive is empty'
        ];
        return response()->json($data,200);
        } else {
            $data = [
            'message' => 'Get Positive resource',
            'total' => $total,
            'data' => $patient
        ];
        return response()->json($data,200);
        }
    }


    /**
     * Fungsi untuk menampilkan data status recovered
     * Menggunakan eloquent where, get
     * Menghitung banyak data menggunakan count
     * Cek data ada atau tidak menggunakan isEmpty dan if else
     */
    public function recovered()
    {
        $patient = Patient::where('status', 'like', "%recovered%")->get();
        $total = count($patient);
        $output = $patient->isEmpty();
        if($output){
            $data = [
            'message' => 'Get Recovered resource',
            'total' => $total,
            'data' => 'Data patient recovered is empty'
            ];
        return response()->json($data,200);
        } else {
            $data = [
            'message' => 'Get Recovered resource',
            'total' => $total,
            'data' => $patient
            ];
        return response()->json($data,200);
        }
    }


    /**
     * Fungsi untuk menampilkan data status dead
     * Menggunakan eloquent where, get
     * Menghitung banyak data menggunakan count
     * Cek data ada atau tidak menggunakan isEmpty dan if else
     */
    public function dead()
    {
        $patient = Patient::where('status', 'like', "%dead%")->get();
        $total = count($patient);
        $output = $patient->isEmpty();
        if($output){
            $data = [
            'message' => 'Get Dead resource',
            'total' => $total,
            'data' => 'Data patient dead is empty'
            ];
        return response()->json($data,200);
        } else {
            $data = [
            'message' => 'Get Dead resource',
            'total' => $total,
            'data' => $patient
            ];
        return response()->json($data,200);
        }
    }

    
}
