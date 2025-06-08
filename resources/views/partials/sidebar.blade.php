<!-- Sidebar -->
<div class="col-md-3 col-lg-2 d-md-block p-0 sidebar">
    <div class="d-flex flex-column h-100">
        <div class="sidebar-content p-3">
            <!-- Logo dan Judul -->
            <div class="d-flex align-items-center mb-4 ps-2 pt-2">
                <img src="{{ asset('assets/images/Logo UKKI.png') }}" alt="Logo UKKI" style="height: 48px; width:auto;">
                <span class="siukki-title text-white fw-semibold fs-4">SiUKKI</span>
                @if (auth('admin')->check())
                    <span class="badge bg-warning text-dark ms-2 small">Admin</span>
                @endif
            </div>

            <!-- Search Bar -->
            <div class="input-group mb-4">
                <span class="input-group-text bg-white border-end-0">
                    <i class="material-icons text-muted">search</i>
                </span>
                <input class="form-control border-start-0 bg-white" type="search" placeholder="Search">
            </div>

            <!-- Navigation Menu -->
            <ul class="nav flex-column">
                @if (auth('admin')->check())
                    {{-- Admin Menu --}}
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                            href="{{ route('admin.dashboard') }}">
                            <i class="material-icons me-2 nav-icon">dashboard</i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ request()->routeIs('admin.anggota*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                            href="{{ route('admin.anggota.index') }}">
                            {{-- <a
                                class="nav-link {{ request()->routeIs('admin.anggota*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                                href="#"> --}}
                                <i class="material-icons me-2 nav-icon">people</i> Kelola Anggota
                            </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ request()->routeIs('admin.misi*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                            href="{{ route('admin.misi.index') }}">
                            {{-- <a
                                class="nav-link {{ request()->routeIs('admin.misi*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                                href="#"> --}}
                                <i class="material-icons me-2 nav-icon">assignment</i> Kelola Misi
                            </a>
                    </li>
                    <li class="nav-item mb-2">
                        {{-- <a
                            class="nav-link {{ request()->routeIs('admin.event*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                            href="{{ route('admin.event.index') }}"> --}}
                            <a class="nav-link {{ request()->routeIs('admin.event*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                                href="#">
                                <i class="material-icons me-2 nav-icon">event</i> Kelola Event
                            </a>
                    </li>
                    <li class="nav-item mb-2">
                        {{-- <a
                            class="nav-link {{ request()->routeIs('admin.poin*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                            href="{{ route('admin.poin.index') }}"> --}}
                            <a class="nav-link {{ request()->routeIs('admin.poin*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                                href="{{ route('poin.index') }}">
                                <i class="material-icons me-2 nav-icon">stars</i> Kelola Poin
                            </a>
                    </li>
                    <li class="nav-item mb-2">
                        {{-- <a
                            class="nav-link {{ request()->routeIs('admin.leaderboard*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                            href="{{ route('admin.leaderboard.index') }}"> --}}
                            <a class="nav-link {{ request()->routeIs('admin.leaderboard*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                                href="#">
                                <i class="material-icons me-2 nav-icon">leaderboard</i> Leaderboard
                            </a>
                    </li>
                    <li class="nav-item mb-2">
                        {{-- <a
                            class="nav-link {{ request()->routeIs('admin.laporan*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                            href="{{ route('admin.laporan.index') }}"> --}}
                            <a class="nav-link {{ request()->routeIs('admin.laporan*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                                href="#">
                                <i class="material-icons me-2 nav-icon">assessment</i> Laporan
                            </a>
                    </li>
                    <li class="nav-item mb-2">
                        {{-- <a
                            class="nav-link {{ request()->routeIs('admin.setting*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                            href="{{ route('admin.setting.index') }}"> --}}
                            <a class="nav-link {{ request()->routeIs('admin.setting*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                                href="#">
                                <i class="material-icons me-2 nav-icon">settings</i> Setting
                            </a>
                    </li>
                @else
                    {{-- Anggota Menu --}}
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                            href="{{ route('dashboard') }}">
                            <i class="material-icons me-2 nav-icon">home</i> Beranda
                        </a>
                    </li>
                    <li class="nav-item mb-2">
<<<<<<< HEAD
                        {{-- <a class="nav-link {{ request()->routeIs('misi*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                           href="{{ route('misi.index') }}"> --}}
                        <a class="nav-link {{ request()->routeIs('misi*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                            href="{{ route('misi') }}">
                            <i class="material-icons me-2 nav-icon">assignment</i> Misi
                        </a>
=======
                        {{-- <a
                            class="nav-link {{ request()->routeIs('misi*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                            href="{{ route('misi.index') }}"> --}}
                            <a class="nav-link {{ request()->routeIs('misi*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                                href="#">
                                <i class="material-icons me-2 nav-icon">assignment</i> Misi
                            </a>
>>>>>>> 57d39b01a3897c30015dc157b64ae886616ede7f
                    </li>
                    <li class="nav-item mb-2">
                        {{-- <a
                            class="nav-link {{ request()->routeIs('poin*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                            href="{{ route('poin.index') }}"> --}}
                            <a class="nav-link {{ request()->routeIs('poin.index') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                                href="{{ route('poin.index') }}">
                                <i class="material-icons me-2 nav-icon">stars</i> Poin
                            </a>
                    </li>
                    <li class="nav-item mb-2">
                        {{-- <a
                            class="nav-link {{ request()->routeIs('kalender*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                            href="{{ route('kalender.index') }}"> --}}
                            <a class="nav-link {{ request()->routeIs('kalender*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                                href="#">
                                <i class="material-icons me-2 nav-icon">event</i> Kalender Event
                            </a>
                    </li>
                    <li class="nav-item mb-2">
                        {{-- <a
                            class="nav-link {{ request()->routeIs('leaderboard*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                            href="{{ route('leaderboard.index') }}"> --}}
                            <a class="nav-link {{ request()->routeIs('leaderboard*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                                href="#">
                                <i class="material-icons me-2 nav-icon">leaderboard</i> Leaderboard
                            </a>
                    </li>
                    <li class="nav-item mb-2">
                        {{-- <a
                            class="nav-link {{ request()->routeIs('about*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                            href="{{ route('about.index') }}"> --}}
                            <a class="nav-link {{ request()->routeIs('about*') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                                href="{{ route('about') }}">
                                <i class="material-icons me-2 nav-icon">info</i> About
                            </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ request()->routeIs('setting') ? 'active' : 'hover-hijau' }} rounded-3 d-flex align-items-center"
                            href="{{ route('setting') }}">
                            <i class="material-icons me-2 nav-icon">settings</i> Setting
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <!-- Profile Footer -->
        <div class="mt-auto profile-footer">
            <div class="d-flex align-items-center justify-content-between px-3 py-4">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/images/Avater.png') }}" alt="Profile" class="rounded-circle avatar">
                    <div class="ms-2">
                        @if (auth('admin')->check())
                            <div class="fw-semibold text-white" style="font-size:0.99em; line-height:1.2;">
                                {{ auth('admin')->user()->nama }}
                            </div>
                            <div class="text-white-50" style="font-size: 0.92em;">
                                {{ auth('admin')->user()->id_admin }}
                            </div>
                        @else
                            <div class="fw-semibold text-white" style="font-size:0.99em; line-height:1.2;">
                                {{ auth()->user()->nama }}
                            </div>
                            <div class="text-white-50" style="font-size: 0.92em;">
                                {{ auth()->user()->npm }}
                            </div>
                        @endif
                    </div>
                </div>
                {{-- <form method="POST" action="{{ auth('admin')->check() ? route('admin.logout') : route('logout') }}"
                    class="d-inline">
                    @csrf
                    <button type="submit" class="btn p-0 border-0 bg-transparent ms-2">
                        <i class="material-icons logout-icon text-white">logout</i>
                    </button>
                </form> --}}
                <!-- Tombol Trigger Modal Logout -->
                <button type="button" class="btn p-0 border-0 bg-transparent ms-2" data-bs-toggle="modal"
                    data-bs-target="#logoutModal">
                    <i class="material-icons logout-icon text-white">logout</i>
                </button>

            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                <!-- Form Logout yang sebenarnya -->
                <form method="POST" action="{{ auth('admin')->check() ? route('admin.logout') : route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>