<?php
/*
 * Copyright (c) 2025.
 * Develop By: Mando
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Golongan_obat extends Model
{

    use SoftDeletes;

    protected $fillable =['name'];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtolower($value),
            set: fn (string $value) => strtolower($value)
        );
    }
}
