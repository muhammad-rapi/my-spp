@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- Left Column -->
        <div class="col-md-4">
            <div class="card mb-2">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">{{ 'Profil User' }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card">
                        <div class="card-body pt-3">
                            <div class="avatar avatar-xxl">
                                @php
                                    $roleImages = [
                                    'admin' => '../assets/img/profile-picture/admin.png',
                                    'operator' => '../assets/img/profile-picture/operator.png',
                                    'headmaster' => '../assets/img/profile-picture/headmaster.png',
                                    ];
                                @endphp

                                @foreach($roleImages as $role => $imagePath)
                                    @if(Auth::user()->hasRole($role))
                                        <img src="{{ $imagePath }}" alt="..." class="w-100 rounded-circle shadow-sm">
                                    @endif
                                @endforeach
                            </div>
                            @if(Auth::check())
                                <p class="card-title h5 d-block text-darker mt-2 mb-3">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="card-description mb-4">
                                    Role : <span class="badge bg-gradient-success font-weight-bold mb-0">{{ Auth::user()->role }}</span>
                                </p>
                                <p class="card-description mb-4">
                                    Email : {{ Auth::user()->email }}
                                </p>
                                <p class="card-description mb-4">
                                    Nomor Telp : {{ Auth::user()->phone ? Auth::user()->phone : '-' }}
                                </p>
                                <p class="card-description mb-4">
                                    Jenis Kelamin : {{ Auth::user()->gender ? Auth::user()->gender : '-' }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-md-8">
            <div class="card mb-2">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">{{ __('Ganti Password') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-4">
                    <div class="card">
                        <div class="card-body pt-3">
                            <form action="{{ route('password.edit') }}" method="POST" role="form text-left" autocomplete="off">
                                @method('PATCH')
                                @csrf
                                @if($errors->any())
                                    <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                                        <span class="alert-text text-white">
                                        {{$errors->first()}}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                            <i class="fa fa-close" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                @endif
                                @if(session('success'))
                                    <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                                        <span class="alert-text text-white">
                                        {{ session('success') }}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                            <i class="fa fa-close" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="current_password" class="form-control-label">{{ __('Password Saat Ini') }}</label>
                                            <div class="@error('user.current_password')border border-danger rounded-3 @enderror">
                                                <input class="form-control" type="password" placeholder="Password Saat Ini" id="current_password" name="current_password">
                                                    @error('current_password')
                                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                    @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password" class="form-control-label">{{ __('Masukkan Password Baru') }}</label>
                                            <div class="@error('user.password')border border-danger rounded-3 @enderror">
                                                <input class="form-control" type="password" placeholder="Password Baru" id="password" name="password">
                                                    @error('password')
                                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                    @enderror
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password_confirmation" class="form-control-label">{{ __('Konfirmasi Password Baru') }}</label>
                                            <div class="@error('user.password')border border-danger rounded-3 @enderror">
                                                <input class="form-control" type="password" placeholder="Masukkan Konfirmasi Password Baru" id="password_confirmation" name="password_confirmation">
                                                    @error('password')
                                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                    @enderror
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="exit-button my-3">
            <a class="text-body text-sm bg-light btn-sm font-weight-bold mb-4 mx-5 icon-move-left mt-auto" href="{{ url()->previous() }}" style="width:150px">
                <i class="fas fa-arrow-left text-sm ms-1" aria-hidden="true"></i>
                Kembali
            </a>
        </div>
    </div>
</div>


@endsection