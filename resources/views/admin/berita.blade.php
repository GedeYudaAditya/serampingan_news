@extends('layouts.admin')

@section('container_view')

    <div class="bd-callout bd-callout-info">
        <h5>CRUD Berita</h5>
        <p>Menambahkan, mengedit, dan menghapus berita (<code>Create Read Update Delete</code>) yang akan ditampilkan pada website serampingan news
        </p>
    </div>
    
    <div class="row mb-3 justify-content-between align-items-center">
        <div class="col d-flex justify-content-start">
            <h4>List Berita</h5>
        </div>
        <div class="col d-flex justify-content-center search-hide">
            <form action="/dashboard/berita">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
        <div class="col d-flex justify-content-end">
            <a class="btn btn-primary" href="{{ route('tambahBerita') }}"><i class="bi bi-plus-circle"></i> Tambah Berita</a>
        </div>
    </div>
    <form action="/dashboard/berita">
        <div class="input-group search-show">
            <input type="text" name="search" class="form-control" placeholder="Search">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table align-middle table-striped">
            <thead>
                <tr>
                    <th scope="col" class="col-1">No</th>
                    <th scope="col" class="col-3">Title</th>
                    <th scope="col" class="col-3 show-md">Dibuat pada</th>
                    <th scope="col" class="col-4 show-s">Excpert</th>
                    <th scope="col" class="col-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($allNews as $news)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td class="fst-italic fw-bold">{{ $news->title }}</td>
                    <td class="show-md">
                        {{ $news->created_at->diffForHumans() }}
                    </td>
                    <td class="show-s">{!! $news->excerpt !!}</td>
                    <td>
                        <form action="/dashboard/berita/delete/{{ $news->slug }}" method="post">
                            @csrf
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <a href="/dashboard/berita/edit/{{ $news->slug }}" type="button" class="btn btn-outline-success"><i class="bi bi-pencil-square"></i></a>
                                <a href="/dashboard/berita/info/{{ $news->slug }}" type="button" class="btn btn-outline-primary"><i class="bi bi-info-square"></i></a>
                                <button onclick="confirm('Anda yakin akan menghapus?')" type="submit" class="btn btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                                {{-- <a href="/dashboard/berita/delete/{{ $news->slug }}" onclick="confirm('Anda yakin?')" type="button" class="btn btn-outline-danger"><i class="bi bi-trash-fill"></i></a> --}}
                            </div>
                        </form>
                    </td>
                </tr> 
                @php
                    $i++;
                @endphp
                @endforeach
                {{ $allNews->links() }}
            </tbody>
        </table>
        {{ $allNews->links() }}
    </div>
@endsection
