<div class="container py-4">
    <div class="grid-6">
        <a href="{{ route('ppid') }}">
            <div class="nav-card {{ request()->routeIs('ppid') ? 'active' : '' }}">
                <img src="{{ asset('frontend/img/house.svg') }}" alt="">
                <p>Beranda</p>
            </div>
        </a>
        <a href="{{ route('ppid.profil') }}">
            <div class="nav-card {{ request()->routeIs('ppid.profil') ? 'active' : '' }}">
                <img src="{{ asset('frontend/img/resume.svg') }}" alt="">
                <p>Profil PPID</p>
            </div>
        </a>
        <a href="{{ route('ppid.regulasi') }}">
            <div class="nav-card {{ request()->routeIs('ppid.regulasi') ? 'active' : '' }}">
                <img src="{{ asset('frontend/img/regulation (1).svg') }}" alt="">
                <p>Regulasi</p>
            </div>
        </a>
        <a href="{{ route('ppid.standar-layanan') }}">
            <div class="nav-card {{ request()->routeIs('ppid.standar-layanan') ? 'active' : '' }}">
                <img src="{{ asset('frontend/img/customer-service.svg') }}" alt="">
                <p>Standar Layanan</p>
            </div>
        </a>

        <a href="{{ route('ppid.informasi-publik') }}">
            <div class="nav-card {{ request()->routeIs('ppid.informasi-publik') ? 'active' : '' }} ">
                <img src="{{ asset('frontend/img/info.svg') }}" alt="">
                <p>Informasi Publik</p>
            </div>
        </a>

        <a href="{{ route('ppid.laporan') }}">
            <div class="nav-card {{ request()->routeIs('ppid.laporan') ? 'active' : '' }}">
                <img src="{{ asset('frontend/img/report.svg') }}" alt="">
                <p>Laporan</p>
            </div>
        </a>

    </div>
</div>
