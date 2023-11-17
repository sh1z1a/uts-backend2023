<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class RekamMedis extends Model
{
    // satu rekam medis milik satu pasien
    // method pasien buat relasi one to one ke class RekamMedis
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }
    
    use HasFactory;
}
