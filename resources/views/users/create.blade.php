@extends('layouts.user_type.auth')

@section('content')


<div>
    <div class="container-fluid">       
    </div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Informasi Jurusan') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('users.store') }}" method="POST" role="form text-left">
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
                                <label for="user-name" class="form-control-label">{{ __('Nama') }}</label>
                                <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Nama Pengguna" id="user-name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="role" class="form-control-label">{{ __('Role') }}</label>
                                <div class="@error('user.role')border border-danger rounded-3 @enderror">
                                    <select name="role" class="form-select" aria-label="Default select example">
                                        <option selected disabled="disabled">Pilih Peran</option>
                                        <option>admin</option>
                                        <option>operator</option>
                                    </select>
                                        @error('role')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="role" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('user.email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="email" placeholder="Email Pengguna" id="email" name="email">
                                        @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone" class="form-control-label">{{ __('No Hp') }}</label>
                                    <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="No Hp pengguna" id="phone" name="phone">
                                        @error('phone')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="role" class="form-control-label">{{ __('Password') }}</label>
                                <div class="@error('user.password')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="password" placeholder="Password Pengguna" id="password" name="password">
                                    @error('password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="role" class="form-control-label">{{ __('Jenis Kelamin') }}</label>
                                    <div class="@error('user.role')border border-danger rounded-3 @enderror">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="pria" checked value="Pria">
                                            <label class="form-check-label" for="pria">
                                                {{ __('Pria') }}
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="wanita" value="Wanita">
                                            <label class="form-check-label" for="wanita">
                                                {{ __('Wanita') }}
                                            </label>
                                        </div>
                                            @error('gender')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                    </div>
                </form>
                <a class="text-body text-sm bg-light btn-sm w-15 font-weight-bold mb-4 mx-5 icon-move-left mt-auto" href='{{ url()->previous() }}'>
                        <i class="fas fa-arrow-left text-sm ms-1" aria-hidden="true"></i>
                        Kembali
                    </a>
            </div>
        </div>
    </div>
</div>
@endsection