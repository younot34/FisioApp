<?php
/*
 * Copyright (c) 2025.
 * Develop By: Mando
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokter extends Model
{
    use SoftDeletes;
    protected $table = "dokters";
    protected $fillable = ["karyawan_id","poliklinik_id","no_izin"];
    public function poli()
    {
        return $this->belongsTo(Poliklinik::class,'poliklinik_id','id');
    }
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawans::class, 'karyawan_id', 'id')->with('user');
    }
}
