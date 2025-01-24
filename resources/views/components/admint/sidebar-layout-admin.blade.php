<div>
    <div class="app-menu navbar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <!-- Dark Logo-->
            <a href="{{route('adm.dashboard')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('template/velzon/assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                <span class="logo-lg">
                        FisioApp
                    </span>
            </a>
            <!-- Light Logo-->
            <a href="{{route('adm.dashboard')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('template/velzon/assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                <span class="logo-lg">
                        FisioApp
                    </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>
        <div id="scrollbar">
            <div class="container-fluid">
                <div id="two-column-menu">
                </div>
                <ul class="navbar-nav" id="navbar-nav">
                    <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link @if($firstMenu == "dashboard") active @endif" href="{{route('adm.dashboard')}}">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">MASTER DATA</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link @if($firstMenu == "poliklinik") active @endif" href="{{route('adm.poli')}}">
                            <i class="ri-asterisk"></i> <span data-key="t-dashboards">Data Poliklinik</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link @if($firstMenu == "karyawan") active @endif" href="#sidebarForms" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarForms">
                            <i class="ri-parent-line"></i> <span data-key="t-forms">Data Setting</span>
                        </a>
                        <div class="menu-dropdown navbar-expand @if($firstMenu != "karyawan") collapse @endif" id="sidebarForms">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('adm.karyawan')}}" class="nav-link @if($secondMenu == "karyawan") active @endif" data-key="t-basic-elements">Karyawan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('adm.dokter')}}" class="nav-link @if($secondMenu == "dokter") active @endif" data-key="t-form-select"> Dokter </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link menu-link @if($firstMenu == 'jadwal') active @endif" href="{{ route('adm.jadwal.index') }}">
                                        <span data-key="t-jadwal">Jadwal Praktek</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link @if($firstMenu == "myData") active @endif" href="#sidebarForms" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarForms">
                            <i class="ri-file-list-3-line"></i> <span data-key="t-forms">Data Obat</span>
                        </a>
                        <div class="menu-dropdown navbar-expand @if($firstMenu != "myData") collapse @endif" id="sidebarForms">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('adm.kategori')}}" class="nav-link @if($secondMenu == "kategori") active @endif" data-key="t-basic-elements">Kategori
                                        Obat</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('adm.golongan')}}" class="nav-link @if($secondMenu == "golongan") active @endif" data-key="t-form-select"> Golongan Obat </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('adm.obat')}}" class="nav-link @if($secondMenu == "obat") active @endif" data-key="t-checkboxs-radios">Data Obat</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- Sidebar -->
        </div>
        <div class="sidebar-background"></div>
    </div>
</div>
