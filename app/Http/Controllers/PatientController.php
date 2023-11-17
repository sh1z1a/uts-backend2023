<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // membuat method index untuk menampilkan data
    public function index()
    {

        // menampilkan data patients dari database
        $patients = Patient::all();

        // validasi data pasien
        if($patients){
             $data = [
            'message' => 'Get all resource',
            'data' => $patients
        ];

        // mengembalikan kode status 200 (request berhasil)
        return response()->json($data, 200);

        }

        // buat tampilkan data pasien kosong
        if($patients->isEmpty()){
            $data = [
                "message" => "Data is empty",
                "data" => []
            ];

            // mengembalikan kode status 200 
            return response()->json($data, 200);
        }

        // tampilkan data jika tidak ada
        else{
            $data = [
                "message" => "Data not found",
                "data" => []
            ];
            return response()->json($data, 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Patient $patients)
    {
        
        // validasi data dari data yg ditangkap lalu mau di tambahkan
        $validateData = $request->validate([
            'name'=>'required',
            'phone'=>'numeric|required',
            'address'=>'required',
        ]);

        // menggunakan model Patient untuk insert data
        $patients = Patient::create($validateData);

        if($patients){

            $data = [
            'message' => 'resources is added succesfully',
            'data' => $patients,

            ]; 

            // mengembalikan data (json) dan kode 201
            return response()->json($data, 201);
        }

        // buat tampilkan data pasien kosong
        if($patients->isEmpty()){

            $data = [
                "message" => "Resources is empty",
                "data" => []
            ];

            // mengembalikan data (json) dan kode status 200 
            return response()->json($data, 200);
        }

        // tampilkan data jika tidak ada
        else{
            $data = [
                "message" => "Resources not found",
                "data" => []
            ];
            return response()->json($data, 404);
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Patient $patients)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Patient $patients)
    {
        
        // menghandle data yang tidak ada
        if($patients){
            // menangkap data request
            $input = [
                'name' => $request-> name ?? $patients->name,
                'phone' => $request -> phone ?? $patients->phone,
                'address' => $request -> address ?? $patients->address,
            ];

            // temukan resources pasien
            $patients->find($input);

            // melakukan update data
            $patients->update($input);

            // tampilkan response
            $data = [
                'message' => 'Resources is updated successfully',
                'data' => $patients
            ];

            // mengembalikan data (json) dan kode 200
            return response()-> json($data, 200);
        }
        else {
            $data = [
                'message' => 'Resources not found'
            ];

            return response()->json($data, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
