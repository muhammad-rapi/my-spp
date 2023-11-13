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
                <form action="{{ route('majors.store') }}" method="POST" role="form text-left">
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
                                <label for="major-name" class="form-control-label">{{ __('Nama') }}</label>
                                <div class="@error('major.name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Nama Jurusan" id="major-name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="category" class="form-control-label">{{ __('Kategori') }}</label>
                                <div class="@error('major.category')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Kategori Jurusan" id="category" name="category">
                                        @error('category')
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
@endsection