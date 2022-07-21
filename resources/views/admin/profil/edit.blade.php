@extends('layouts.admin')

@section('container_view')

<form action="/dashboard/profil/edit/{{ $news->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    <input type="hidden" name="is_active" value="{{ true }}">
    <div class="container-fluid border-bottom mb-3">
        <h3>Atur Profil Desa</h3>
    </div>
    <div class="container mb-3">
        <div class="mb-3">
            <label for="title" class="form-label">Title Informasi desa</label>
            <input class="form-control" name="title" type="text" id="title" value="{{ $news->title }}">
        </div>

        <div class="bd-callout bd-callout-info">
            <h5 class="fst-italic">Petunjuk</h5>
            <p>Tulis hal yang dapat mendeskripsikan desa, dapat berupa <code>Sejarah</code>, <code>info tentang desa</code>, dan lain-lain.
            </p>
        </div>

        <textarea name="informasi" class="ckeditor" id="ckedtor">
            {!! $news->informasi !!}
        </textarea>
    </div>
    
    <div class="container-fluid border-bottom">
        <h3>Struktur Desa</h3>
    </div>
    <div class="container mb-3">
        <div class="bd-callout bd-callout-info">
            <h5 class="fst-italic">Petunjuk</h5>
            <p>Tambahkan struktur <code>kepengurusan desa</code>, dapat berupa gambar <code>png, jpg, atau jpeg</code>. Selain itu <code>tidak ditolerir</code>.
            </p>
        </div>

        <div class="container d-flex justify-content-center">
            @if ($news->struktur)
                <img class="img-fluid img-thumbnail col-sm-5 img-preview" src="{{ asset($news->struktur) }}">
            @else
                <img class="img-fluid img-thumbnail col-sm-5 img-preview">
            @endif
        </div>
    
        <div class="mb-3">
            <label for="formFile" class="form-label">Gambar Struktur desa</label>
            <input type="hidden" name="oldImage" value="{{ $news->struktur }}">
            <input value="{{ $news->struktur }}" name="struktur" class="form-control" type="file" id="formFile" onchange="previewImage()">
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