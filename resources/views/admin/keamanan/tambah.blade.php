@extends('layouts.admin')

@section('container_view')
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session()->has('failed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('failed') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form action="{{ route('addUser') }}" method="POST">
    @csrf
    <div class="form-group row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-right">Nama</label>
        <div class="col-md-6">
            <input type="text" id="name" class="form-control" name="name" required autofocus>
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
        <div class="col-md-6">
            <input type="text" id="username" class="form-control" name="username" required autofocus>
            @if ($errors->has('username'))
                <span class="text-danger">{{ $errors->first('username') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
        <div class="col-md-6">
            <input type="text" id="email" class="form-control" name="email" required autofocus>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
        <div class="col-md-6">
            <input type="password" id="password" class="form-control" name="password" required autofocus>
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
        <div class="col-md-6">
            <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
            @if ($errors->has('password_confirmation'))
                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>
    </div>
    
    
    <div class="container mb-5">
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </div>
</form>

<script>
    function previewImage(){
        const img = document.querySelector("#formFile");
        const imgPreview = document.querySelector(".img-preview");

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(img.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

</script>
@endsection

