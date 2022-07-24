@extends('layouts.main')

@section('content')
    <div class="container-fluid mx-0">
        <div class="row">
            <div class="col-lg-9 mt-3">
                @if($news)
                    <div class="container-fluid bg-light border shadow border-bottom-0 rounded-top py-3 px-3 pb-0">
                        <h1 class="text-center mb-3">{{ $news[0]->title }}</h5>
                        {{-- <img src="{{ $news->thumbnail != null ? asset($news->thumbnail) : 'https://source.unsplash.com/1200x400?'.$news->category->name }}" alt="" class="img-thumbnails mb-3"> --}}
                        <div class="row pb-2 mt-3 border-bottom">
                            <div class="col text-center">
                                <i class="bi bi-person-fill"></i> Dibuat oleh <b>{{ $news[0]->author->name }}</b>
                            </div>
                            <div class="col text-center">
                                <i class="bi bi-stopwatch"></i> Dibuat pada <b>{{ $news[0]->created_at->diffForHumans() }}</b>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid rounded-bottom border border-top-0 pt-3">
                        {!! $news[0]->informasi !!}
                    </div>
                @else
                    <div class="container-fluid bg-light border shadow border-bottom-0 rounded-top py-3 px-3 pb-3">
                        <div class="row justify-content-center">
                            <img src="/images/404-missing-loop-01.gif" height="100" class="col-12 img-fluid" alt="missing page">
                        </div>
                        <h3 class="text-center mt-3">Oups.. Tidak ada yang bisa di lihat untuk saat ini</h1>
                    </div>
                @endif
            </div>
            <div class="col-lg-3 hide px-0">
                <div class="container-fluid h-100 bg-light pt-3">
                        <div class="my-2 border-bottom">
                            <h4 class="fw-bolder">Berita <span class="text-primary">Terkini</span></h4>
                        </div>
                        <div class="col bg-light">
                            <ul class="list-group list-group-flush mb-3">
                                @foreach ($rekomendasi as $item)   
                                    <a class="text-decoration-none" href="/post/{{ $item->slug }}"><li class="list-group-item text-truncate mylist"  style="background-color: transparent !important;">{{ $item->title }}</li></a>
                                @endforeach
                            </ul>

                            <div class="container fluid">
                                <iframe src="https://calendar.google.com/calendar/embed?src=id.indonesian%23holiday%40group.v.calendar.google.com&ctz=Asia%2FMakassar" style="border: 0; width: 100%;" height="200" frameborder="0" scrolling="no"></iframe>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-3">
            @include('component.loginCard')
        </div> --}}
    </div>
@endsection