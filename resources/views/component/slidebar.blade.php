<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ $active == 'dashboard' ? 'active' : '' }}" href="/dashboard">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $active == 'berita' ? 'active' : '' }}" href="/dashboard/berita">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Berita
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ $active == 'profil' ? 'active' : '' }}" href="/dashboard/profil">
                    <span data-feather="info" class="align-text-bottom"></span>
                    Profil Desa
                </a>
            </li>
        </ul>

        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Pengaturan</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
                <span data-feather="settings" class="align-text-bottom"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link {{ $active == 'keamanan' ? 'active' : '' }}" href="/dashboard/keamanan">
                    <span data-feather="shield" class="align-text-bottom"></span>
                    Keamanan Akun
                </a>
            </li>
            <li class="nav-item">
                <button class="nav-link border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span data-feather="log-out" class="align-text-bottom"></span>
                    Logout
                </button>
            </li>
        </ul>
    </div>
</nav>