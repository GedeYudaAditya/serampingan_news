@extends('layouts.main')

@section('content')
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ $img_splash != null ? asset($img_splash->splash_image1) : 'https://source.unsplash.com/1200x400?natural' }}" class="d-block w-100 bg-carousel" alt="Gambar 1">
      <div class="carousel-caption d-none d-md-block">
        <h2>Selamat Datang di</h5>
        <p>Website Desa Serampingan</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ $img_splash != null ? asset($img_splash->splash_image2) : 'https://source.unsplash.com/1200x400?natural' }}" class="d-block w-100 bg-carousel" alt="Gambar 2">
      <div class="carousel-caption d-none d-md-block">
        <h5>Desa Serampingan News</h5>
        <p>Tempat untuk mendapatkan beberapa informasi terkini tentang Desa Serampingan</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ $img_splash != null ? asset($img_splash->splash_image3) : 'https://source.unsplash.com/1200x400?natural' }}" class="d-block w-100 bg-carousel" alt="Gambar 3">
      <div class="carousel-caption d-none d-md-block">
        <h5>&copy; Powerd by KKN Undiksha 2022</h5>
        <p>Web hasil kerjasama antara KKN Undiksha 2022 dengan Desa Serampingan</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


    <div class="container mt-3">
      @if (request('search'))
        <h3 class="fw-bolder mt-5 border-bottom mb-3">Pencarian tentang <span class="text-primary">{{ request('search') }}</span></h3>         
      @else
        <h3 class="fw-bolder mt-5 border-bottom mb-3">Berita <span class="text-primary">Terkini</span></h3>         
      @endif
            {{-- <div class="row"> --}}
              <div class="list-group mb-3">
                @foreach ($allNews as $news)
                  <a href="/post/{{ $news->slug }}" class="list-group-item list-group-item-action shadow-sm p-3 mb-3 bg-body rounded">
                    <div class="row">
                      <div class="col-md-3">
                        <img src="{{ $news->thumbnail != null ? asset($news->thumbnail) : 'https://source.unsplash.com/1200x400?'.$news->category->name }}" class="img-cards" alt="">
                      </div>
                      <div class="col-md-9">
                        <div class="d-flex w-100 justify-content-between mt-2 mb-3 pb-2 border-bottom">
                          <h5 class="mb-1">{{ $news->title }}</h5>
                          <small class="text-muted">{{ $news->created_at->diffForHumans() }}</small>
                        </div>
                        {!! $news->excerpt !!}
                        <small class="mt-5">Di buat oleh {{ $news->author->name }} pada kategori {{ $news->category->name }}.</small>
                      </div>
                    </div>
                  </a>
                @endforeach
              </div>
            {{-- </div> --}}
            {{ $allNews->links() }}
        {{-- <div class="col-lg-3">
            @include('component.loginCard')
        </div> --}}
    </div>
@endsection
