<?php
/*
 * Copyright (c) 2025.
 * Develop By: Mando
 */

namespace App\Http\Controllers\Pendaftaran;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pendaftaran\PasienRequest;
use App\Models\Pasien;
use App\Models\Poliklinik;
use App\Models\Rekam;
use App\Models\User;
use App\Services\Pendaftaran\PendaftaranService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    protected User $users;
    protected string $prefix;
    protected PendaftaranService $pendaftaranService;

    public function __construct(PendaftaranService $pendaftaranService)
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
        $this->prefix = "SKRPSI-" . date("mY") . "-";
        $this->pendaftaranService = $pendaftaranService;

    }

    public function index(Request $request)
    {
        $dataPasien = "";
        if($request->get('pasien') != null){
            try{
                $pasien_id = decrypt($request->get('pasien'));
                $dataPasien = Pasien::findOrfail($pasien_id);
            }catch (\Exception $exception){
                abort('404','NOT FOUND');
            }
        }

        // Mendapatkan Poliklinik
        $poliklinik = Poliklinik::with('dokter')->orderBy('name','asc')->get();
        $filteredPoliklinik = $poliklinik->filter(function ($poliklinik) {
            return $poliklinik->dokter != null;
        });

        // Mendapatkan Rekam Medis pada hari ini
        $rekam = Rekam::with('antrian')->today()->get();
        
        // Menghitung total antrian yang belum diproses
        $totalAntrian = $rekam->where('status', 0)->count();

        // Mengambil pasien yang sedang diproses
        $onProses = $rekam->where('status', '=', "1")->sortBy('id')->first();
        $onProsesAntrian = $onProses->antrian->nomor ?? ($rekam->count() + 1);

        // Menghitung nomor antrian berdasarkan jumlah pasien pada hari tersebut
        $todayPasienCount = Pasien::whereDate('created_at', now()->toDateString())->count();
        $nomorAntrianHariIni = $todayPasienCount + 1;

        return view('front.pendaftaran', array(
            'title' => "Dashboard Administrator | FisioApp v.1.0",
            'firstMenu' => 'pendaftaran',
            'secondMenu' => 'pendaftaran',
            'dataPasien' => $dataPasien,
            'dataPoli' => $filteredPoliklinik,
            'totalAntrian' => $totalAntrian,
            'onProsesAntrian' => $onProsesAntrian,
            'nomorAntrianHariIni' => $nomorAntrianHariIni,  // Kirim nomor antrian hari ini ke view
        ));
    }
    private function generateZero($totalData, $length, $lastId):string
    {
        $str = "0";
        for ($i = 0; $i < (($totalData - 1) - $length); $i++) {
            $str = $str . "0";
        }
        return $str . $lastId;
    }

    public function generateCode()
    {
        do {
            $totalData = 7;
            $finalCode = "0000001";
            $lastPasien = Pasien::orderBy('id', 'desc')->first();
            if ($lastPasien != null) {
                $lastId = ((int)$lastPasien->id) + 1;
                $length = strlen($lastId);
                if ($length > 0 && $length <= $totalData) {
                    $finalCode = $this->generateZero($totalData,$length,$lastId);
                } else if($length > $totalData){
                    $finalCode = $this->generateZero($totalData+1,$length,$lastId);
                }
            }
            $code = $this->prefix . $finalCode;
        } while (Pasien::where('kode_pasien', $code)->exists());
        return json_encode($code);
    }

    public function getDataPasien(Request $request)
    {
        if ($request->ajax()) {
            return $this->pendaftaranService->getDataPasien($request);
        }
        return null;
    }

    public function store(PasienRequest $request)
    {
        $request->validated(); // Validasi data dari request
        DB::beginTransaction(); // Memulai transaksi database
        try {
            // Cek apakah NIK sudah ada di database
            $existingPasien = Pasien::where('nik', $request->nik)->first();
            if ($existingPasien) {
                // Jika NIK ditemukan, update data pasien
                $this->pendaftaranService->update($request, $existingPasien->id, $this->users->name ?? '');
            } else {
                // Jika NIK tidak ditemukan, simpan data pasien baru
                $this->pendaftaranService->save($request, $this->users->name ?? '');
            }
            DB::commit(); // Commit transaksi
            return redirect(route('front.pendaftaran'))->with(['success' => "Pasien berhasil didaftarkan!"]);
        } catch (\Exception $e) {
            DB::rollback(); // Rollback transaksi jika terjadi kesalahan
            return redirect(route('front.pendaftaran'))->withErrors(['error' => "Terjadi kesalahan: " . $e->getMessage()]);
        }
    }
}