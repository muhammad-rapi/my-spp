@extends('layouts.user_type.auth')

@section('content')


<div>
    <div class="container-fluid">

    </div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Informasi Siswa') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('payments.store') }}" method="POST" role="form text-left">
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
                                <label for="student-name" class="form-control-label">{{ __('Nama') }}</label>
                                <div class="@error('student.name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Nama Siswa" id="student-name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="amount_payment" class="form-control-label">{{ __('Nominal Pembayaran') }}</label>
                                <div class="@error('student.amount_payment')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="number" placeholder="Nominal Pembayaran" id="amount_payment" name="amount_payment">
                                        @error('amount_payment')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror                                        
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="class" class="form-control-label">{{ __('Bulan') }}</label>
                                <div class="@error('student.month')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="month" id="month" name="month">
                                        @error('month')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror                                        
                                </div>
                            </div>
                        </div>                       
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection