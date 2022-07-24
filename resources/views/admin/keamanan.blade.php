@extends('layouts.admin')

@section('container_view')
    <div class="container mb-3 pb-3 border-bottom">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <form action="/dashboard/keamanan" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="name" class="form-control" name="name" id="name" value="{{ auth()->user()->name }}" placeholder="{{ auth()->user()->name }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ auth()->user()->email }}" placeholder="{{ auth()->user()->email }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="username" class="form-control" name="username" id="username" value="{{ auth()->user()->username }}" placeholder="{{ auth()->user()->username }}">
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                @if (session()->has('failed'))
                    <small class="text-danger">{{ session('failed') }}</small>
                @endif
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="row justify-content-between">
                <button type="submit" class="col-5 btn btn-primary">Ubah Informasi</button>
                <a href="{{ route('forget.password.get') }}" class="col-5 btn btn-warning">Ubah Password</a>
            </div>
        </form>
    </div>

    <div class="container">
        <div class="row mb-3 justify-content-between align-items-center">
            <div class="col d-flex justify-content-start">
                <h4>List User</h4>
            </div>
            <div class="col d-flex justify-content-center search-hide">
                <form action="/dashboard/keamanan">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="col d-flex justify-content-end">
                <a class="btn btn-primary" href="{{ route('tambahUser') }}"><i class="bi bi-plus-circle"></i> Tambah User</a>
            </div>
        </div>

        <form action="/dashboard/keamanan">
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
                        <th scope="col" class="col-3">Name</th>
                        <th scope="col" class="col-3 show-md">Email</th>
                        <th scope="col" class="col-4 show-s">Dibuat Pada</th>
                        <th scope="col" class="col-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($users as $user)
                    <tr class="@if($user->id == auth()->user()->id) green-active @endif" >
                        <th scope="row">{{ $i }}</th>
                        <td class="fst-italic fw-bold">{{ $user->name }}</td>
                        <td class="show-md">
                            {{ $user->email }}
                        </td>
                        <td class="show-s">{{ $user->created_at->diffForHumans() }}</td>
                        <td>
                            @if ($user->id != auth()->user()->id)
                            <form action="/dashboard/user/delete/{{ $user->username }}" method="post">
                                @csrf
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    {{-- <a href="/dashboard/user/info/{{ $user->username }}" type="button" class="btn btn-outline-primary"><i class="bi bi-info-square"></i></a> --}}
                                    <button onclick="confirm('Anda yakin akan menghapus?')" type="submit" class="btn btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                                    {{-- <a href="/dashboard/berita/delete/{{ $news->slug }}" onclick="confirm('Anda yakin?')" type="button" class="btn btn-outline-danger"><i class="bi bi-trash-fill"></i></a> --}}
                                </div>
                            </form>
                            @else
                                Sedang Digunakan
                            @endif
                        </td>
                    </tr> 
                    @php
                        $i++;
                    @endphp
                    @endforeach
                    {{ $users->links() }}
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
@endsection