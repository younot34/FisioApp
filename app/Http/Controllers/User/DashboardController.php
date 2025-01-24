<?php

namespace App\Http\Controllers\User;

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

class DashboardController extends Controller
{
    protected User $users;
    protected string $prefix;
    protected PendaftaranService $pendaftaranService;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
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

        $isRole6 = $this->users->role_id === 6;
        if ($isRole6) {
            // Ambil dokter yang terhubung dengan poliklinik
            $dokter = $filteredPoliklinik->first()->dokter;
    
            // Ambil jadwal dokter berdasarkan hari ini (misalnya)
            $hariIni = now()->locale('id')->format('l');
    
            // Cek jika ada jadwal untuk hari ini
            $jadwalHariIni = $dokter->jadwals()->where('hari', $hariIni)->first();

            $dokterPraktekJam = $jadwalHariIni ? $jadwalHariIni->jam_mulai . ' - ' . $jadwalHariIni->jam_selesai : 'Belum tersedia';
    
            // Pesan
            $message = "Halo! {$this->users->name}, Terima kasih telah menggunakan layanan kami. 
                        Nomor antrean Anda adalah {$nomorAntrianHariIni}, dan jam praktek dokter adalah {$dokterPraktekJam}.";
    
            // Simpan ke sesi jika belum ada atau data baru hari ini
            $storedDate = session('message_date');
            $currentDate = now()->toDateString();
            if ($storedDate !== $currentDate) {
                session([
                    'message' => $message,
                    'message_date' => $currentDate, // Tandai tanggal hari ini
                ]);
            }
        }
        return view('user.dashboard', array(
            'title' => "Dashboard Administrator | FisioApp v.1.0",
            'firstMenu' => 'dashboard',
            'secondMenu' => 'dashboard',
            'message' => $message,
        ));
    }
}
