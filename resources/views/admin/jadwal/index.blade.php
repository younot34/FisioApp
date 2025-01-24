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
                        <h4 class="mb-4">Jadwal Praktek</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adm.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Jadwal Praktek</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('adm.jadwal.create') }}"><button class="btn btn-sm btn-primary">
                                ADD
                            </button></a>
                        </div>
                        <div class="card-body">
                            <table id="tableJadwal"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th data-ordering="false" class="text-center">NO</th>
                                        <th data-ordering="false" class="text-center">DOCTER</th>
                                        <th data-ordering="false" class="text-center">DAY</th>
                                        <th data-ordering="false" class="text-center">TIME</th>
                                        <th class="text-center">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwal as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $item->dokter->karyawan->user->name ?? 'Nama Dokter Tidak Ditemukan' }}</td>
                                            <td class="text-center">{{ $item->hari }}</td>
                                            <td class="text-center">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('adm.jadwal.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('adm.jadwal.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admint.admin-template>
