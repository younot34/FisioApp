<x-admint.admin-template :title="$title" :first-menu="$firstMenu" :second-menu="$secondMenu">
    @push('customCss')
        <!--datatable css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
        <!--datatable responsive css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>

        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    @endpush
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <x-admint.error-message-component/>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                        <h4 class="mb-4">Tambah Jadwal Praktek</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adm.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('adm.jadwal.index')}}">Jadwal Praktek</a></li>
                                <li class="breadcrumb-item active">Add</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="{{ route('adm.jadwal.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="dokter" class="form-label">Dokter <span
                                                    class="text-danger"> *</span></label>
                                                <select name="dokter_id" id="dokter" class="form-control">
                                                    <option value="" disabled selected>Pilih Dokter</option>
                                                    @foreach($dokters as $dokter)
                                                        <option value="{{ $dokter->id }}">{{ $dokter->karyawan->user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="hari" class="form-label">Hari <span
                                                    class="text-danger"> *</span></label>
                                                <input type="text" name="hari" id="hari" class="form-control" placeholder="Masukkan Hari">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="jam_mulai" class="form-label">Jam Mulai <span
                                                    class="text-danger"> *</span></label>
                                                <input type="time" name="jam_mulai" id="jam_mulai" class="form-control">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="jam_selesai" class="form-label">Jam Selesai <span
                                                    class="text-danger"> *</span></label>
                                                <input type="time" name="jam_selesai" id="jam_selesai" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <span class="text-small text-danger">( * ) Wajib diisi</span>
                                    </div>
                                    <div class="col-lg-12">
                                        <span class="text-small text-danger">Kolom tidak boleh kosong</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit"
                                                class="btn btn-success btn-label waves-effect waves-light"><i
                                                class="ri-save-2-fill label-icon align-middle fs-16 me-2"></i> SIMPAN
                                        </button>
                                        <a href="{{route('adm.jadwal.index')}}">
                                            <button type="button" class="btn btn-danger m-1">BATAL</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </div>
</x-admint.admin-template>
