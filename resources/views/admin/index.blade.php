@extends('layouts.admin')

@section('container_view')
    
    <div class="row align-items-center justify-content-center pb-2 mb-3 border-bottom">
        <div class="col">
            <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">Berita Dipublikasi</div>
                <div class="card-body text-center">
                    <h1 class="card-title">{{ $count }}</h1>
                    <p class="card-text">Berita yang telah dipublikasikan.</p>
                </div>
            </div>       
        </div>
        <div class="col">
            <div class="card text-bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header">Terakhir kali update</div>
                <div class="card-body text-center">
                    <h1 class="card-title">{{ $last_update }}</h1>
                    <p class="card-text">Saat perubahan terakhir di lakukan.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header">Admin saat ini</div>
                <div class="card-body text-center">
                    <h3 class="card-title">{{ auth()->user()->name }}</h3>
                    <p class="card-text">Dapat Melakukan perubahan informasi pada website.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3 justify-content-between align-items-center">
        <div class="col d-flex justify-content-start">
            <h4>Ganti Background Website Saat masuk ke <a class="text-decoration-none" href="{{ URL::to('/'); }}">Halaman Root Web</a></h4>
        </div>
        <form action="{{ route('bg') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container d-flex justify-content-center">
                @if ($img)
                    <img class="img-fluid img-thumbnail col-sm-5 img-preview" src="{{ asset($img->start_image) }}">
                @else
                    <img class="img-fluid img-thumbnail col-sm-5 img-preview">
                @endif
            </div>
        
            <div class="mb-3">
                <label for="formFile" class="form-label">Gambar Background</label>
                <input name="start_image" class="form-control @error('start_image') is-invalid @enderror" type="file" id="formFile" onchange="previewImage()">
                @error('start_image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="container mb-5">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row mb-3 justify-content-between align-items-center">
        <div class="col d-flex justify-content-start">
            <h4>Ganti slider background <a class="text-decoration-none" href="{{ URL::to('/beranda'); }}">Halaman Beranda Web</a></h4>
        </div>
        <form action="/dashboard/splash" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container d-flex justify-content-center">
                @if ($img && $img->splash_image1)
                    <img class="img-fluid img-thumbnail col-sm-5 img-preview1" src="{{ asset($img->splash_image1) }}">
                @else
                    <img class="img-fluid img-thumbnail col-sm-5 img-preview1">
                @endif
            </div>
        
            <div class="mb-3">
                <label for="formFile" class="form-label">Gambar Splash 1</label>
                <input name="splash_image1" class="form-control @error('splash_image1') is-invalid @enderror" type="file" id="formFile1" onchange="previewImage1()">
                @error('splash_image1')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="container d-flex justify-content-center">
                @if ($img && $img->splash_image2)
                    <img class="img-fluid img-thumbnail col-sm-5 img-preview2" src="{{ asset($img->splash_image2) }}">
                @else
                    <img class="img-fluid img-thumbnail col-sm-5 img-preview2">
                @endif
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Gambar Splash 2</label>
                <input name="splash_image2" class="form-control @error('splash_image2') is-invalid @enderror" type="file" id="formFile2" onchange="previewImage2()">
                @error('splash_image2')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="container d-flex justify-content-center">
                @if ($img && $img->splash_image3)
                    <img class="img-fluid img-thumbnail col-sm-5 img-preview3" src="{{ asset($img->splash_image3) }}">
                @else
                    <img class="img-fluid img-thumbnail col-sm-5 img-preview3">
                @endif
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Gambar Splash 3</label>
                <input name="splash_image3" class="form-control @error('splash_image3') is-invalid @enderror" type="file" id="formFile3" onchange="previewImage3()">
                @error('splash_image3')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="container mb-5">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>

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
        function previewImage1(){
            const img = document.querySelector("#formFile1");
            const imgPreview = document.querySelector(".img-preview1");
    
            imgPreview.style.display = 'block';
    
            const oFReader = new FileReader();
            oFReader.readAsDataURL(img.files[0]);
    
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
        function previewImage2(){
            const img = document.querySelector("#formFile2");
            const imgPreview = document.querySelector(".img-preview2");
    
            imgPreview.style.display = 'block';
    
            const oFReader = new FileReader();
            oFReader.readAsDataURL(img.files[0]);
    
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
        function previewImage3(){
            const img = document.querySelector("#formFile3");
            const imgPreview = document.querySelector(".img-preview3");
    
            imgPreview.style.display = 'block';
    
            const oFReader = new FileReader();
            oFReader.readAsDataURL(img.files[0]);
    
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    
    </script>
@endsection
