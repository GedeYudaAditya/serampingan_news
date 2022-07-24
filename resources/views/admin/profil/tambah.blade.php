@extends('layouts.admin')

@section('container_view')

<form action="{{ route('addProfil') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    <input type="hidden" name="is_active" value="{{ true }}">
    <div class="container-fluid border-bottom mb-3">
        <h3>Atur Profil Desa</h3>
    </div>
    <div class="container mb-3">
        <div class="mb-3">
            <label for="title" class="form-label">Title Informasi desa</label>
            <input class="form-control @error('title') is-invalid @enderror" name="title" type="text" id="title" placeholder="Berikan judul untuk informasi desa" value="{{ old('title') }}">
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="bd-callout bd-callout-info">
            <h5 class="fst-italic">Petunjuk</h5>
            <p>Tulis hal yang dapat mendeskripsikan desa, dapat berupa <code>Sejarah</code>, <code>info tentang desa</code>, dan lain-lain.
            </p>
        </div>

        <textarea name="informasi" class="ckeditor" id="ckedtor">
            {!! old('informasi') !!}
        </textarea>
        @error('informasi')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    
    <div class="container-fluid border-bottom">
        <h3>Struktur Organisasi</h3>
    </div>
    <div class="container mb-3">
        <div class="bd-callout bd-callout-info">
            <h5 class="fst-italic">Petunjuk</h5>
            <p>Tambahkan struktur <code>kepengurusan desa</code>, dapat berupa gambar <code>png, jpg, atau jpeg</code>. Selain itu <code>tidak ditolerir</code>.
            </p>
        </div>

        <div class="container d-flex justify-content-center">
            <img class="img-fluid img-thumbnail col-sm-5 img-preview">
        </div>
    
        <div class="mb-3">
            <label for="formFile" class="form-label">Gambar Struktur Organisasi</label>
            <input name="struktur" class="form-control @error('struktur') is-invalid @enderror" type="file" id="formFile" onchange="previewImage()">
            @error('struktur')
                <small class="text-danger">{{ $message }}</small>
            @enderror
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

