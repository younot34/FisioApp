<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Dokter;
use Illuminate\Http\Request;

class JadwalController extends Controller
{

    public function index()
    {
        $title = 'Jadwal Praktek';
        $firstMenu = 'Jadwal';
        $secondMenu = 'Praktek';

        // Ambil semua data jadwal praktek
        $jadwal = Jadwal::with('dokter')->get();

        return view('admin.jadwal.index', compact('title', 'firstMenu', 'secondMenu', 'jadwal'));
    }

    public function create()
    {
        $title = 'Tambah Jadwal Praktek';
        $firstMenu = 'Jadwal';
        $secondMenu = 'Praktek';

        // Ambil data dokter dengan relasi ke user dan karyawan
        $dokters = Dokter::with('karyawan.user')->get();

        return view('admin.jadwal.create', compact('title', 'firstMenu', 'secondMenu', 'dokters'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        Jadwal::create($request->all());
        return redirect()->route('adm.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit($id)
    {
        $title = 'Edit Jadwal Praktek';
        $firstMenu = 'Jadwal';
        $secondMenu = 'Praktek';

        $jadwal = Jadwal::findOrFail($id); // Ambil data jadwal praktek berdasarkan ID
        $dokters = Dokter::with('karyawan.user')->get(); // Ambil data dokter untuk dropdown

        return view('admin.jadwal.edit', compact('title', 'firstMenu', 'secondMenu', 'jadwal', 'dokters'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'dokter_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update([
            'dokter_id' => $request->dokter_id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('adm.jadwal.index')->with('success', 'Jadwal berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('adm.jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }
}
