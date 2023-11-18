<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // membuat method index untuk menampilkan resource 
    public function index()
    {

        // menampilkan resource patients dari database
        $patients = Patient::all();

        // untuk menghandle jika resource patient yang ingin ditampilkan ada
        if($patients){
            
            $data = [
            // tampilkan resource message, resource berhasil didapatkan 
            'message' => 'Get all resource',
            // tampilkan resource patients yang berhasil didapatkan 
            'data' => $patients
        ];

        // mengembalikan kode status 200 (request berhasil)
        return response()->json($data, 200);

        }

        // untuk menghandle jika resource patient yang ingin ditambahkan kosong
        if($patients->isEmpty()){
            $data = [
                // tampilkan resource message, resource kosong 
                "message" => "Resource is empty",
                // tampilkan resource patients kosong 
                "data" => []
            ];

            // mengembalikan kode status 200 
            return response()->json($data, 200);
        }

        // untuk menghandle jika resource patient yang ingin ditambahkan tidak ditemukan
        else{
            $data = [
                // tampilkan resource message, resource tidak ditemukan
                "message" => "Resource not found",
                // tampilkan resource tidak ada
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

        // untuk menghandle jika resource patient yang ingin ditambahkan ada
        if($patients){

            $data = [
                // tampilkan resource message, resource berhasil ditambahkan 
                'message' => 'Resource is added succesfully',
                'data' => $patients,

            ]; 

            // mengembalikan data (json) dan kode 201
            return response()->json($data, 201);
        }

        // buat tampilkan data pasien kosong
        if($patients->isEmpty()){

            $data = [
                // tampilkan resource message, resource kosong
                "message" => "Resource is empty",
                // tampilkan resource kosong
                "data" => []
            ];

            // mengembalikan data (json) dan kode status 200 
            return response()->json($data, 200);
        }

        // untuk menghandle jika resource patient yang ingin ditambahkan tidak ditemukan
        else{
            $data = [
                // tampilkan resource message, resource tidak ditemukan
                "message" => "Resources not found",
                // tampilkan resource tidak ada
                "data" => []
            ];

            // mengembalikan data (json) dan kode 404
            return response()->json($data, 404);
        }
        // ============================
        
    }

    // membuat method show untuk menampilkan data
    public function show(Request $request, Patient $patients, $id)
    {
        //  cari id patients yang ingin didapatkan 
        $patients = Patient::where($id);

        // untuk menghandle jika detail resource patient yang ingin ditampilkan ada
        if($patients){
            $data = [
                'message'=> 'Get detail resource',
                'data' => $patients
            ];

            // mengembalikan resource(json) dan kode 200
            return response()->json($data, 200);
        }
        // untuk menghandle jika detail resource patient yang ingin ditambahkan tidak ada
        else{
            $data = [
                'message' => 'Resource not found',
            ];

            // mengembalikan resource (json) dan kode 404
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
        // untuk menghandle jika resource patient yang ingin diupdate ada
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
        // untuk menghandle jika resource patient yang ingin diupdate tidak ada
        else {
            $data = [
                'message' => 'Resource not found'
            ];

            // mengembalikan data (json) dan kode 404
            return response()->json($data, 404);
        }
    }

    // membuat method destroy untuk menghapus data
    public function destroy($id)
    {
        // // variabel patients untuk menemukan resource Patient berdasarkan id
        $patients = Patient::find($id);

        // menghandle data yg tidak ada
        if($patients !== null){
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

    // membuat method search untuk mencari resource berdasarkan nama
    public function search(Request $request, Patient $patients, $name)
    {
        // variabel patients untuk menampilkan resource Patient berdasarkan nama yang dicari
        $patients = Patient::where('name', 'LIKE', "%$name%")->get();
        
        // untuk menghandle jika resource patient berdasarkan nama yang dicari ada
        if($patients !== null) {

            $data = [
                // buat tampilkan resource message, resource berdasarkan nama berhasil didapatkan 
                'message' => 'Get searched resource "'.$name.'"',
                // buat tampilkan resource berdasarkan name
                'data' => $patients
            ];

            // mengembalikan data (json) dan kode 200
            return response()->json($data, 200);
        } 
        // untuk menghandle jika resource patient berdasarkan nama yang dicari tidak ada
        else {
            // tampilkan pesan resource not found
            $data = [
                'message' => 'Resource not found'
            ];

            // mengembalikan data (json) dan kode 404
            return response()->json($data, 404); 

        }
        
    }

    // membuat method positive untuk menampilkan resource Patient yang positive
    public function positive(Request $request, Patient $patients)
    {
        // variabel total untuk menampilkan total resource Patient yang positive
        $total = Patient::where('status', 'positive')->count();
        // variabel patient untuk menampilkan resource Patient yang positive
        $patients = Patient::where('status', 'positive')->get();
        
        // untuk menghandle jika resource patient positive ada
        if($patients !== null) {

            // buat tampilkan resource message
            $data = [
                // untuk menampilkan total resource Patient yang positive
                'total' => $total,
                // tampilkan resource message, resource positive berhasil didapatkan 
                'message' => 'Get positive resource',
                // untuk menampilkan resource Patient yang positive
                'data' => $patients
            ];

            // mengembalikan data (json) dan kode 200
            return response()->json($data, 200);
        } 
        // untuk menghandle jika resource patient positive tidak ada
        else {
            // tampilkan pesan resource not found
            $data = [
                'message' => 'Resource not found'
            ];

            // mengembalikan data (json) dan kode 404
            return response()->json($data, 404); 

        }
        
    }

    // membuat method recovered untuk menampilkan resource Patient yang recovered
    public function recovered(Request $request, Patient $patients)
    {
        // variabel total untuk menampilkan total resource Patient yang recovered
        $total = Patient::where('status', 'recovered')->count();
        // variabel patients untuk menampilkan resource Patient yang recovered
        $patients = Patient::where('status', 'recovered')->get();
        
        if($patients !== null) {

            // buat tampilkan data message
            $data = [
                // untuk menampilkan total resource Patient yang recovered
                'total' => $total,
                // tampilkan data message, resource recovered berhasil didapatkan  
                'message' => 'Get recovered resource',
                // untuk menampilkan resource Patient yang recovered
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

    // membuat method dead untuk menampilkan resource Patient yang dead
    public function dead(Request $request, Patient $patients)
    {
        // variabel total untuk mengambil total resource Patient hanya yang dead
        $total = Patient::where('status', 'dead')->count();
        // variabel patients untuk mengambil resource Patient hanya yang dead
        $patients = Patient::where('status', 'dead')->get();
        
        // jika resource patients yang dead ada
        if($patients !== null ){

            $data = [
                // untuk menampilkan total resource Patient yang dead
                'total' => $total,
                // tampilkan data message, resource dead berhasil didapatkan 
                'message' => 'Get dead resource',
                // untuk menampilkan resource Patient yang dead
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
