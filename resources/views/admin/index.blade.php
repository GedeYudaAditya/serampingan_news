@extends('layouts.admin')

@section('container_view')
    
    <div class="row align-items-center justify-content-center pb-2 mb-3 border-bottom">
        <div class="col">
            <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">Berita Dipublikasi</div>
                <div class="card-body text-center">
                    <h1 class="card-title">{{ $count }}</h1>
                    <p class="card-text">Berita yang telah dipublikasikan.</p>
                </div>
            </div>       
        </div>
        <div class="col">
            <div class="card text-bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header">Terakhir kali update</div>
                <div class="card-body text-center">
                    <h1 class="card-title">{{ $last_update }}</h1>
                    <p class="card-text">Saat perubahan terakhir di lakukan.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header">Admin saat ini</div>
                <div class="card-body text-center">
                    <h3 class="card-title">{{ auth()->user()->name }}</h3>
                    <p class="card-text">Dapat Melakukan perubahan informasi pada website.</p>
                </div>
            </div>
        </div>
    </div>
    
@endsection
