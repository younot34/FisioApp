<?php
/*
 * Copyright (c) 2025.
 * Develop By: Mando
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Obat extends Model
{

    use SoftDeletes;

    protected $table = "obats";
    protected $fillable = ["kategoriobat_id", "golonganobat_id","code","name","type","price","stock"];

    protected static function booted()
    {
        static::creating(function ($obat) {
            $obat->code = Obat::generateCode();
        });
    }

    public static function generateCode()
    {
        do {
            $code = Str::random(10);
        } while (Obat::where('code', $code)->exists());

        return $code;
    }

    public function golongan()
    {
        return $this->belongsTo(Golongan_obat::class,'golonganobat_id','id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori_obat::class,'kategoriobat_id','id');
    }
}
