<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Patient extends Model
{
    // // membuat fungsi getPatients di model Patient
    // public function getPatients(){
    //     $patients = DB::select(('select * from patients'));
    //     return $patients;
    // }

    // // banyak pasien punya satu status
    // // method status buat relasi one to many (Inverse) ke class Patient
    // public function status(): BelongsTo
    // {
    //     return $this->belongsTo(Status::class);
    // }

    // // satu pasien punya satu rekam medis
    // // method rekam_medis buat relasi one to one ke class Patient
    // public function rekam_medis(): HasOne
    // {
    //     return $this->hasOne(RekamMedis::class);
    // }

    // define model attributes to make mass assignable
    protected $fillable = ['name', 'phone', 'address', 'in_date_at', 'out_date_at', 'status'];

    use HasFactory;
}
