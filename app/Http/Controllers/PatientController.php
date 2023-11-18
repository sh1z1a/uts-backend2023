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

            // mengembalikan data (json) dan kode 404
            return response()->json($data, 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    // membuat method store untuk menambah data
    public function store(Request $request, Patient $patients)
    {
        
        // validasi data dari data yg ditangkap lalu mau di tambahkan
        $validateData = $request->validate([
            'name'=>'required',
            'phone'=>'numeric|required',
            'address'=>'required',
            'in_date_at'=>'required',
            'out_date_at'=>'required',
            'status'=>'required',
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

            // mengembalikan data (json) dan kode 404
            return response()->json($data, 404);
        }
       
    }

    // membuat method show untuk menampilkan data
    public function show(Request $request, Patient $patients, $id)
    {
        //  cari id patients yang ingin didapatkan 
        $patients = Patient::where($id);

        if($patients){
            $data = [
                'message'=> 'Get detail resource',
                'data' => $patients
            ];

            // mengembalikan data(json) dan kode 200
            return response()->json($data, 200);
        }
        else{
            $data = [
                'message' => 'Rsource not found',
            ];

            // mengembalikan data (json) dan kode 404
            return response()->json($data, 404);
        }

    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Patient $patients)
    {
        
     
    }

    // membuat method update untuk mengubah/mengupdate data
    public function update(Request $request, Patient $patients )
    {
       // menghandle data yang tidak ada
        if($patients){
            // menangkap data request
            $input = [
                'name' => $request-> name ?? $patients->name,
                'phone' => $request -> phone ?? $patients->phone,
                'address' => $request -> address ?? $patients->address,
                'in_date_at'=>$request-> in_date_at ?? $patients->in_date_at,
                'out_date_at'=>$request-> out_date_at ?? $patients->out_date_at,
                'status'=>$request-> status ?? $patients->status
            ];

            // temukan resources pasien
            $patients->find($input);

            // melakukan update data
            $patients->update($input);

            // tampilkan response
            $data = [
                'message' => 'Resource is updated successfully',
                'data' => $patients
            ];

            // mengembalikan data (json) dan kode 200
            return response()-> json($data, 200);
        }
        else {
            $data = [
                'message' => 'Resource not found'
            ];

            // mengembalikan data (json) dan kode 404
            return response()->json($data, 404);
        }
    }

    // membuat method destroy untuk menghapus data
    public function destroy(string $id)
    {
        $patients = Patient::find($id);

        // menghandle data yg tidak ada
        if($patients){
            // hapus data patient tersebut
            $patients->delete();

            // buat tampilkan data message
            $data = [
                'message' => 'Resource is delete successfully'
            ];

            // mengembalikan data (json) dan kode 200
            return response()->json($data, 200);
        }

        // jika resource tidak ada
        else {
            // tampilkan pesan resource 
            $data = [
                'message' => 'Resource not found',
                'data'=> $patients
            ];

            // mengembalikan data (json) dan kode 404
            return response()->json($data, 404);
        }
    }

    // 

    public function getPositiveResource(Request $request, Patient $patients)
    {
        $total = Patient::where('status', 'positive')->count();
        $data = Patient::where('status', 'positive')->get();
        
        if($patients) {

            // buat tampilkan data message
            $data = [
                'total' => $total,
                'message' => 'Get positive resource',
                'data' => $patients
            ];

            // mengembalikan data (json) dan kode 200
            return response()->json($data, 200);
        } 
        else {
            // tampilkan pesan resource not found
            $data = [
                'message' => 'Resource not found'
            ];

            // mengembalikan data (json) dan kode 404
            return response()->json($data, 404); 

        }
        
    }

}
