<?php
/******************************************************************************
 *                                                                            *
 *  * Copyright (c) 2025.                                                     *
 *  * Develop By:  Mando                                     *
 *                                                                            *
 ******************************************************************************/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeKaryawan($query)
    {
        return $query->where('role_id', '!=', 1)->where('role_id', '!=', 2)->where('role_id', '!=', 4)->where('role_id', '!=', 6);
    }

    public function karyawandokter()
    {
        return $this->hasOne(Karyawans::class,'user_id','id')->with('dokter');
    }

    public function karyawan()
    {
        return $this->hasOne(Karyawans::class,'user_id','id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($roles)
    {
        $this->have_role = $this->getUserRole();
        if(is_array($roles)){
            foreach($roles as $need_role){
                if($this->cekUserRole($need_role)){
                    return true;
                }
            }
        } else {
            return $this->cekUserRole($roles);
        }
        return false;
    }

    private function getUserRole()
    {
        return $this->role()->getResults();
    }

    private function cekUserRole($role)
    {
        return (strtolower($role)==strtolower($this->have_role->name)) ? true : false;
    }
}
