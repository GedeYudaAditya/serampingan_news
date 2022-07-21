@extends('layouts.admin')

@section('container_view')

    <div class="bd-callout bd-callout-info">
        <h5>Update porfil desa</h5>
        <p>Untuk melakukan update tentang <code>porfil desa</code>, ini dapat berupa isi tentang <code>sejarah desa</code>, <code>informasi tentang desa</code>, dan <code>struktur desa</code>.
        </p>
    </div>

    <div class="row mb-3 justify-content-between align-items-center">
        <div class="col d-flex justify-content-start">
            <h4>List Profil</h5>
        </div>
        <div class="col d-flex justify-content-center search-hide">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
            </div>
        </div>
        <div class="col d-flex justify-content-end">
            <a class="btn btn-primary" href="{{ route('tambahProfil') }}"><i class="bi bi-plus-circle"></i> Tambah Profil</a>
        </div>
    </div>
    <div class="input-group search-show">
        <input type="text" class="form-control" placeholder="Search">
        <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
    </div>
    <div class="table-responsive">
        <table class="table table align-middle table-striped">
            <thead>
                <tr>
                    <th scope="col" class="col-1">No</th>
                    <th scope="col" class="col-4">Title</th>
                    <th scope="col" class="col-3 show-md">Dibuat pada</th>
                    <th scope="col" class="col-3">Active</th>
                    <th scope="col" class="col-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($allNews as $news)
                <tr class="@if($news->is_active == 1) green-active @endif">
                    <th scope="row">{{ $i }}</th>
                    <td class="fst-italic fw-bold">{{ $news->title }}</td>
                    <td class="show-md">
                        {{ $news->created_at->diffForHumans() }}
                    </td>
                    <td>{{ $news->is_active }}</td>
                    <td>
                        <div class="d-flex justify-content-between" role="group" aria-label="Basic outlined example">
                            <form action="/dashboard/profil/activate/{{ $news->id }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-dark rounded-start"><i class="bi bi-toggles"></i></i></button>
                            </form>
                            <a href="/dashboard/profil/edit/{{ $news->id }}" type="button" class="btn btn-outline-success"><i class="bi bi-pencil-square"></i></a>
                            <a href="/dashboard/profil/info/{{ $news->id }}" type="button" class="btn btn-outline-primary"><i class="bi bi-info-square"></i></a>
                            <form action="/dashboard/profil/delete/{{ $news->id }}" method="post">
                                @csrf
                                <button onclick="confirm('Anda yakin akan menghapus?')" type="submit" class="btn btn-outline-danger rounded-end"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </div>
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