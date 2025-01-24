<?php
/*
 * Copyright (c) 2025.
 * Develop By: Mando
 */

namespace Database\Seeders;

use App\Models\Karyawans;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class KaryawansSeeder extends Seeder
{

    public function run(): void
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $karyawan = [
            [
                "user_id" => 3,
                "nip" => "ST-123123123232",
                "alamat" => "lampung",
                "sex" => "P",
                "tanggal_bergabung" => date("Y-m-d"),
                "created_at" => $date,
                "updated_at" => $date,
            ],
            [
                "user_id" => 4,
                "nip" => "DK-3232323232",
                "alamat" => "lampung",
                "sex" => "L",
                "tanggal_bergabung" => date("Y-m-d"),
                "created_at" => $date,
                "updated_at" => $date,
            ],
            [
                "user_id" => 5,
                "nip" => "AP-42423323",
                "alamat" => "lampung",
                "sex" => "P",
                "tanggal_bergabung" => date("Y-m-d"),
                "created_at" => $date,
                "updated_at" => $date,
            ],
        ];
        Karyawans::insert($karyawan);
    }
}
