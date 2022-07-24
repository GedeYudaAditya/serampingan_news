<div class="fixed-top">

    {{-- <div class="container-fluid navbarFloating">

    </div> --}}
    <nav class="navbar shadow navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/beranda">
                <img src="/images/logo.png" alt="" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <div class="container-fluid d-flex justify-content-end">
                    <ul class="navbar-nav my-2 my-lg-0">
                        <li class="nav-item me-5">
                            <b><a class="nav-link {{ $active == 'beranda' ? 'active' : '' }}" aria-current="page" href="/beranda">Beranda</a></b>
                        </li>
                        <li class="nav-item me-5">
                            <b><a class="nav-link {{ $active == 'porfil' ? 'active' : '' }}" href="/profil">Profil</a></b>
                        </li>
                        <li class="nav-item me-5">
                            <b><a class="nav-link {{ $active == 'struktur' ? 'active' : '' }}" href="/struktur">Struktur Organisasi</a></b>
                        </li>
                        {{-- <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> --}}
                        <form action="/beranda">
                        <div class="input-group" role="search" style="width: 200px">
                            @if (request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if (request('author'))
                                <input type="hidden" name="author" value="{{ request('author') }}">
                            @endif
                            <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-outline-secondary" id="button-addon2"><i class="bi bi-search"></i></button>
                        </div>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


</div>

<div class="mt-5 spacer">

</div>