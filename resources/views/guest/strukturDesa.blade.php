@extends('layouts.main')

@section('content')
    <div class="container mt-3">
        @if ($news)
            <div class="col-lg-12">
                <img src="{{ asset($news[0]->struktur) }}" alt="..." class="img-fluid" style="object-position: center; object-fit:contain; height:460px; width:100% !important;">
            </div>        
        @else
            <div class="container-fluid bg-light border shadow border-bottom-0 rounded-top py-3 px-3 pb-3">
                <div class="row justify-content-center">
                    <img src="/images/404-missing-loop-01.gif" height="100" class="col-12 img-fluid" alt="missing page">
                </div>
                <h3 class="text-center mt-3">Oups.. Tidak ada yang bisa di lihat untuk saat ini</h1>
            </div>
        @endif
        {{-- <div class="col-lg-3">
            @include('component.loginCard')
        </div> --}}
    </div>
@endsection
