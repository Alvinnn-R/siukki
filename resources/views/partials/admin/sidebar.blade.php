<div class="col-md-3 col-lg-2 sidebar bg-dark text-white p-3">
    <h4 class="text-white mb-4">Admin SiUKKI</h4>
    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">Dashboard</a>
        </li>
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white">Kelola Anggota</a>
        </li>
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white">Kelola Misi</a>
        </li>
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white">Event</a>
        </li>
        <li class="nav-item mt-4">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
        </li>
    </ul>
</div>
