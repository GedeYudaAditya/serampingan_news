@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session()->has('loginError'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('loginError') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@auth
  <div class="card text-center">
    <div class="card-header">
        Selamat datang {{ auth()->user()->name }}
    </div>
    <div class="card-body">
        <div class="row justify-content-between">
          <div class="col my-1">
            <a href="/dashboard" class="btn btn-success"><i class="bi bi-speedometer2"></i> Dashboard</a>
          </div>

          <div class="col my-1">
            <form action="/logout" method="POST">
              @csrf
              <button type="submit" class="btn btn-danger mx-3"><i class="bi bi-box-arrow-right"></i> Logout</button>
            </form>
          </div>
        </div>
    </div>
  </div>
@else
  <div class="card text-center">
    <div class="card-header">
        Login Admin
    </div>
    <div class="card-body">
        <form action="/beranda" method="POST">
            @csrf
            <div class="mb-4 mt-2">
                <input type="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" name="password" placeholder="Password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <div class="card-footer text-muted">
        Tidak punya akun? <a href="">Daftar</a>
    </div>
  </div>
@endauth
