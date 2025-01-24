<?php
/*
 * Copyright (c) 2025.
 * Develop By: Mando
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poliklinik extends Model
{

    use SoftDeletes;

    protected $table = "polikliniks";

    protected $fillable = ["name"];

    public function dokter(){
        return $this->belongsTo(Dokter::class,'id','poliklinik_id');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
