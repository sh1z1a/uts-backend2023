<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    // satu status punya banyak pasien  
    // method pasien buat relasi one to many ke class Status
    public function pasien(): HasMany{
        return $this->hasMany(Pasien::class);
    }
    
    use HasFactory;
}
