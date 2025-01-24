<?php
/*
 * Copyright (c) 2025.
 * Develop By: Mando
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ObatRequest;
use App\Models\Golongan_obat;
use App\Models\Kategori_obat;
use App\Models\Obat;
use App\Services\Admin\ObatService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ObatController extends Controller
{

    protected $users;
    protected ObatService $obatService;

    public function __construct(ObatService $obatService)
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
        $this->obatService = $obatService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->obatService->index($request);
        }

        return view('admin.obat', array(
            'title' => "Dashboard Administrator | FisioApp v.1.0",
            'firstMenu' => 'myData',
            'secondMenu' => 'obat',
        ));
    }

    public function create()
    {
        $kategori = Kategori_obat::orderBy('name','ASC')->get();
        $golongan = Golongan_obat::orderBy('name','ASC')->get();
        $obat = Obat::count();
        return view('admin.addobat', array(
            'title' => "Dashboard Administrator | FisioApp v.1.0",
            'firstMenu' => 'myData',
            'secondMenu' => 'obat',
            'optionKategori' => $kategori,
            'optionGolongan' => $golongan,
            'jumlahObat' => $obat
        ));
    }

    public function store(ObatRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try{
            $this->obatService->save($request);
            DB::commit();
            return redirect(route('adm.obat'))->with(['success' => "Data Obat berhasil ditambahkan!"]);
        }catch (Exception $e){
            DB::rollback();
            abort('404', 'NOT FOUND');
        }
    }

    public function edit(string $id=null){
        if($id != null){
            try{
                $obat = Obat::all();
                $kategori = Kategori_obat::orderBy('name','ASC')->get();
                $golongan = Golongan_obat::orderBy('name','ASC')->get();
                $dataObat = $obat->where('id',decrypt($id))->first();
                if($dataObat != null || $dataObat = ""){
                    return view('admin.editobat', array(
                        'title' => "Dashboard Administrator | FisioApp v.1.0",
                        'firstMenu' => 'myData',
                        'secondMenu' => 'obat',
                        'optionKategori' => $kategori,
                        'optionGolongan' => $golongan,
                        'jumlahObat' => $obat->count(),
                        'dataObat' => $dataObat,
                        'idObat' => $id,
                    ));
                }
                abort('404',"NOT FOUND");
            }catch (Exception $e){
                abort('404',"NOT FOUND");
            }
        }
        abort('404',"NOT FOUND");
    }

    public function update(ObatRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try{
            $this->obatService->update($request);
            DB::commit();
            return redirect(route('adm.obat.edit',$request->obat_id))->with(['success' => "Data Obat berhasil diperbaharui!"]);
        }catch (Exception $e){
            DB::rollback();
            abort('404', 'NOT FOUND');
        }
    }

    public function destroy(ObatRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try{
            $id = base64_decode($request->obat_id);
            $this->obatService->delete($id);
            DB::commit();
            return redirect(route('adm.obat'))->with(['delete' => "Data Obat berhasil dihapus!"]);
        }catch (Exception $e){
            DB::rollback();
            abort('404', 'NOT FOUND');
        }
    }
}
