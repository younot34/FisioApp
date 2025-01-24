<x-admint.admin-template :title="$title" :first-menu="$firstMenu" :second-menu="$secondMenu">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                        <h4 class="mb-sm-0">Analytics</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Analytics</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            @if($message)
                <div class="persistent-message">
                    <h5>{!! $message !!}</h5>
                </div>
            @endif
        </div>
        <!-- container-fluid -->
    </div>
</x-admint.admin-template>

<style>
    .persistent-message {
    background-color: #245742; /* Warna latar belakang */
    border: 1px solid #17a2b8; /* Warna border */
    color: #243a3e; /* Warna teks */
    padding: 15px; /* Jarak dalam elemen */
    margin-bottom: 20px; /* Jarak dengan elemen lain */
    border-radius: 5px; /* Sudut melengkung */
    font-size: 16px; /* Ukuran font */
    font-weight: bold;
}

</style>
