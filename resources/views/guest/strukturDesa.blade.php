@extends('layouts.main')

@section('content')
    <div class="container mt-3">
        <div class="col-lg-12">
            <img src="{{ asset($news[0]->struktur) }}" alt="..." class="img-fluid" style="object-position: center; object-fit:contain; height:460px; width:100% !important;">
        </div>
        {{-- <div class="col-lg-3">
            @include('component.loginCard')
        </div> --}}
    </div>
@endsection
