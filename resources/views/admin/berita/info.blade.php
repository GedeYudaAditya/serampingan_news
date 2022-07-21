@extends('layouts.admin')

@section('container_view')
    <h1 class="mb-5">{{ $news->title }}</h5>
    <div class="container-fluid mb-3 pb-3 border-bottom">
        <img src="{{ $news->thumbnail != null ? asset($news->thumbnail) : 'https://source.unsplash.com/1200x400?'.$news->category->name }}" class="img-thumbnails" alt="">
    </div>
    <div class="row mb-3 pb-2 border-bottom">
        <div class="col">
            <i class="bi bi-person-fill"></i> Dibuat oleh <b>{{ $news->author->name }}</b>
        </div>
        <div class="col">
            <i class="bi bi-folder2"></i> Dalam kategori <b>{{ $news->category->name }}</b>
        </div>
        <div class="col">
            <i class="bi bi-stopwatch"></i> Dibuat pada <b>{{ $news->created_at->diffForHumans() }}</b>
        </div>
    </div>

    <div class="container">
        {!! $news->body !!}
    </div>

@endsection