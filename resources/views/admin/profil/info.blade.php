@extends('layouts.admin')
{{-- @dd($news) --}}
@section('container_view')
    <h1 class="mb-5">{{ $news->title }}</h5>
    
    <div class="row mb-3 pb-2 border-bottom">
        <div class="col">
            <i class="bi bi-person-fill"></i> Dibuat oleh <b>{{ $news->author->name }}</b>
        </div>
        <div class="col">
            <i class="bi bi-stopwatch"></i> Dibuat pada <b>{{ $news->created_at->diffForHumans() }}</b>
        </div>
    </div>

    <div class="container">
        {!! $news->informasi !!}
    </div>

    <h4 class="mt-5 pt-5 border-top">Gambar Struktur Organisasi</h4>
    <div class="container my-3">
        <img src="{{ asset($news->struktur) }}" alt="..." class="img-fluid">
    </div>

@endsection