@extends('layouts.admin')

@section('container_view')
    <div class="bd-callout bd-callout-info">
        <h5>Tambah Berita</h5>
        <p>Tambahkan berita yang ingin di publikasikan pada website
        </p>
    </div>

    <form action="/dashboard/berita/tambah" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="excerpt" id="excerpt">
        <div class="mb-3 row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control" id="title" value="{{ old("title") }}">
            </div>
        </div>

        <div class="mb-3 row">
            <div class="container d-flex justify-content-center">
                <img class="img-fluid img-thumbnail col-sm-5 img-preview">
            </div>
        </div>
    
        <div class="mb-3 row">
            <label for="formFile" class="col-sm-2 col-form-label">Gambar Struktur desa</label>
            <div class="col-sm-10">
                <input name="thumbnail" class="form-control" type="file" id="formFile" onchange="previewImage()">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="category_id" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
                {{-- <select name="category_id" class="btn btn-secondary dropdown-toggle" id="">
                    <option value="">Hahaha</option>
                    <option value="">Hahaha1</option>
                    <option value="">Hahaha2</option>
                </select> --}}
                <input type="text" name="category_id" class="form-control" id="category_id" value="{{ old("category_id") }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="slug" class="col-sm-2 col-form-label">Slug</label>
            <div class="col-sm-10">
                <input type="text" name="slug" class="form-control" id="slug" value="{{ old("slug") }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="ckedtor" class="col-sm-2 col-form-label">Isi Berita</label>
            <div class="col-sm-10">
                <textarea name="body" class="ckeditor" id="ckedtor">
                    {!! old("body") !!}
                </textarea>
            </div>
        </div>
        <div class="container mb-5">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </form>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function () {
            fetch('/dashboard/berita/createSlug?title='+title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug);
        });

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