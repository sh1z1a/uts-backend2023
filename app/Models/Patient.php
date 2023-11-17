<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    // banyak pasien punya satu status
    // method status buat relasi one to many (Inverse) ke class Patient
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    // satu pasien punya satu rekam medis
    // method rekam_medis buat relasi one to one ke class Patient
    public function rekam_medis(): HasOne
    {
        return $this->hasOne(RekamMedis::class);
    }
    
    use HasFactory;
}
