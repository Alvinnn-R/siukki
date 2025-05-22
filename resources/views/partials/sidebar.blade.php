<!-- Sidebar -->
<div class="col-md-3 col-lg-2 d-md-block p-0 sidebar">
    <div class="d-flex flex-column h-100">
        <div class="sidebar-content p-3">
            <div class="d-flex align-items-center mb-4 ps-3 pt-2">
                <img src="{{ asset('assets/images/Logo UKKI.png') }}" alt="Logo UKKI" style="height: 48px; width:auto;">
                <span class="ms-3 siukki-title text-white fw-semibold fs-4">SiUKKI</span>
            </div>
            <div class="input-group mb-4">
                <span class="input-group-text bg-white border-end-0">
                    <img src="{{ asset('assets/images/ikon search.png') }}" alt="Search Icon" class="ikon">
                </span>
                <input class="form-control border-start-0 bg-white" type="search" placeholder="Search">
            </div>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link active rounded-3 d-flex align-items-center" href="beranda.htm">
                        <img src="{{ asset('assets/images/ikon beranda.png') }}" alt="Beranda" class="me-2 ikon">
                        Beranda
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex hover-hijau rounded-3 align-items-center" href="misi.html">
                        <img src="{{ asset('assets/images/ikon misi.png') }}" alt="Misi" class="me-2 ikon">
                        Misi
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex hover-hijau rounded-3 align-items-center" href="#">
                        <img src="{{ asset('assets/images/ikon poin.png') }}" alt="Poin" class="me-2 ikon">
                        Poin
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex hover-hijau rounded-3 align-items-center" href="#">
                        <img src="{{ asset('assets/images/ikon kalender.png') }}" alt="Kalender" class="me-2 ikon">
                        Kalender Event
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex hover-hijau rounded-3 align-items-center" href="#">
                        <img src="{{ asset('assets/images/ikon leaderboard.png') }}" alt="Leaderboard"
                            class="me-2 ikon">
                        Leaderboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex hover-hijau rounded-3 align-items-center" href="#">
                        <img src="{{ asset('assets/images/ikon about.png') }}" alt="About" class="me-2 ikon">
                        About
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex hover-hijau rounded-3 align-items-center" href="#">
                        <img src="{{ asset('assets/images/ikon setting.png') }}" alt="Setting" class="me-2 ikon">
                        Setting
                    </a>
                </li>
            </ul>
        </div>
        <!-- Profile Footer -->
        <div class="mt-auto profile-footer">
            <div class="d-flex align-items-center justify-content-between px-3 py-2">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/images/Avater.png') }}" alt="Profile" class="rounded-circle avatar">
                    <div class="ms-2">
                        <div class="fw-semibold text-white" style="font-size:1.1em; line-height:1.2;">Riky
                        </div>
                        <div class="text-white-50" style="font-size: 0.95em;">230011100021</div>
                    </div>
                </div>
                {{-- <a href="#" class="ms-2">
                    <img src="{{ asset('assets/images/logout.png') }}" alt="Logout" class="logout-icon">
                </a> --}}
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn p-0 border-0 bg-transparent ms-2">
                        <img src="{{ asset('assets/images/logout.png') }}" alt="Logout" class="logout-icon">
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
