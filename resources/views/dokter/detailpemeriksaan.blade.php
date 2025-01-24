<x-admint.admin-template :title="$title" :first-menu="$firstMenu" :second-menu="$secondMenu">
    @push('customCss')
        <!--datatable css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
        <!--picker-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
            <!-- start page title -->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                        <h4 class="mb-sm-0">Pemeriksaan Pasien</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dokter.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Pemeriksaan Pasien</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <!--start: Detail Pasien -->
                <div class="col-lg-4">
                    <div class="card">

                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">Nama : {{$dataPasien->pasien->nama_lengkap ?? "NA"}}</li>
                                <li class="list-group-item">Umur : {{$dataPasien->pasien->age ?? "0"}} Tahun</li>
                                <li class="list-group-item">Tekanan Darah : {{$dataPasien->tekanan_darah ?? "0"}}mm/g
                                </li>
                                <li class="list-group-item">Suhu : {{$dataPasien->suhu_badan ?? "0"}} Celcius</li>
                                <li class="list-group-item">Tinggi Badan : {{$dataPasien->tinggi_badan ?? "0"}} cm</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--end: Detail Pasien -->

                <!--start: Detail Keluhan -->
                <div class="col-lg-8">
                    <div class="card ">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3 class="float-start">Detail Keluhan:</h3>
                                    <a href="{{route('dokter.pemeriksaan')}}">
                                        <button class="btn btn-sm btn-danger float-end"><i
                                                class=" ri-arrow-left-s-line align-middle"></i> BACK
                                        </button>
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="mt-3">{{$dataPasien->keluhan_utama ?? "-"}}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end: Detail Keluhan -->
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">
                        <form action="{{route('dokter.pemeriksaan.selesai')}}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <input type="hidden" name="rekam_id" value="{{base64_encode($dataPasien->id)}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h3>Diagnosa: <span class="text-danger"> * </span></h3>
                                                <textarea name="diagnosa"  class="form-control @error('diagnosa') is-invalid @enderror" cols="30"
                                                          rows="3">{{old('diagnosa')}}</textarea>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-lg-12">
                                                <h3>Deskripsi Tindakan: <span class="text-danger "> * </span></h3>
                                                <textarea name="deskripsi_tindakan"  class="form-control @error('deskripsi_tindakan') is-invalid @enderror" cols="30"
                                                          rows="3">{{old('deskripsi_tindakan')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-12">
                                                <button type="submit" class="btn btn-success">SIMPAN PEMERIKSAAN</button>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-12">
                                                (<span class="text-danger">*</span>)  wajib diisi
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card card-body">
                                                    <h6 class="mb-1">Riwayat Medis</h6>
                                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm">See
                                                        Details</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="card card-body">
                                                    <h6 class="mb-1">Resep</h6>
                                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm">See
                                                        Details</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- container-fluid -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalPasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Temukan Pasien</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="tablePasien"
                           class="table table-bordered dt-responsive nowrap table-striped align-middle"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th data-ordering="false" class="text-center">No.</th>
                            <th data-ordering="false" class="text-center">KODE PASIEN</th>
                            <th data-ordering="false" class="text-center">NAMA</th>
                            <th data-ordering="false" class="text-center">ALAMAT</th>
                            <th data-ordering="false" class="text-center">PHONE</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
    @push('customJs')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!--datatable js-->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <!--picker-->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>

        </script>

    @endpush
</x-admint.admin-template>
