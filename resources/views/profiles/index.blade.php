@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid mb-3">
        <div class="card card-body blur shadow-blur mx-4 mt-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="../assets/img/bruce-mars.jpg" alt="..." class="w-100 border-radius-lg shadow-sm">
                        <a href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                            <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Image"></i>
                        </a>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ Auth::user()->name }}
                        </h5>                       
                    </div>
                </div>                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-2 mx-3">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Profil User</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card">
                        <div class="card-body pt-0">
                            @if(Auth::check())
                            <p class="card-title h5 d-block text-darker mt-5 mb-3">
                                {{  Auth::user()->name}}
                            </p>                           
                            <p class="card-description mb-4">
                                Email : {{  Auth::user()->email}}
                            </p>
                            <p class="card-description mb-4">
                                Nomor Telp : 0{{  Auth::user()->phone}}
                            </p>
                            <p class="card-description mb-4">
                                Jenis Kelamin : {{  Auth::user()->gender}}
                            </p>
                            @endif
                    </div>               
                    <a class="text-body text-sm bg-light btn-sm w-15 font-weight-bold mb-4 mx-5 icon-move-left mt-auto" href='{{ url()->previous() }}'>
                        <i class="fas fa-arrow-left text-sm ms-1" aria-hidden="true"></i>
                        Kembali
                    </a> 
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection