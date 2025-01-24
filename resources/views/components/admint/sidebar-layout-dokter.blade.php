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
                        <a class="nav-link menu-link @if($firstMenu == "dashboard") active @endif" href="{{route('dokter.dashboard')}}">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                        </a>
                    </li>

                    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">AKTIVITAS</span></li>


                    <li class="nav-item">
                        <a class="nav-link menu-link @if($firstMenu == "pemeriksaan") active @endif" href="{{route('dokter.pemeriksaan')}}">
                            <i class="ri-asterisk"></i> <span data-key="t-dashboards">Pemeriksaan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link @if($firstMenu == "pemeriksaan") active @endif" href="{{route('dokter.pemeriksaan')}}">
                            <i class="ri-asterisk"></i> <span data-key="t-dashboards">Riwayat Pemeriksaan</span>
                        </a>
                    </li>

                    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">REPORT</span></li>

                    <li class="nav-item">
                        <a class="nav-link menu-link @if($firstMenu == "pemeriksaan") active @endif" href="{{route('dokter.pemeriksaan')}}">
                            <i class="ri-asterisk"></i> <span data-key="t-dashboards">Report Bulanan</span>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- Sidebar -->
        </div>

        <div class="sidebar-background"></div>
    </div>
</div>
