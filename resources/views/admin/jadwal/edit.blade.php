<x-admint.admin-template :title="$title" :first-menu="$firstMenu" :second-menu="$secondMenu">
    @push('customCss')
        <style>
            .select option {
                color: whitesmoke !important;
                background: #3b439d !important;
            }
        </style>
    @endpush
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <x-admint.error-message-component/>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                        <h4 class="mb-sm-0">Edit Jadwal Praktek</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adm.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('adm.jadwal.index')}}">Jadwal Praktek</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="{{ route('adm.jadwal.update', $jadwal->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="dokter" class="form-label">Dokter <span
                                                    class="text-danger"> *</span></label>
                                                <select name="dokter_id" id="dokter" class="form-control">
                                                    @foreach($dokters as $dokter)
                                                        <option value="{{ $dokter->id }}" @if($dokter->id == $jadwal->dokter_id) selected @endif>
                                                            {{ $dokter->karyawan->user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="hari" class="form-label">Hari <span
                                                    class="text-danger"> *</span></label>
                                                <input type="text" name="hari" id="hari" class="form-control" value="{{ $jadwal->hari }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="jam_mulai" class="form-label">Jam Mulai <span
                                                    class="text-danger"> *</span></label>
                                                <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" value="{{ $jadwal->jam_mulai }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="jam_selesai" class="form-label">Jam Selesai <span
                                                    class="text-danger"> *</span></label>
                                                <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" value="{{ $jadwal->jam_selesai }}">
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
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('adm.jadwal.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </div>
</x-admint.admin-template>
