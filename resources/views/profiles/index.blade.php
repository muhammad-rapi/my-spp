@extends('layouts.user_type.auth')

@section('content')

<div>    
    <div class="row">
        <div class="col-6">
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
                        <div class="card-body pt-3">
                            <div class="avatar avatar-xxl position-relative">
                                <img src="../assets/img/profile-picture/admin.png" alt="..." class="w-100 rounded-circle shadow-sm">                                                     
                            </div>
                            @if(Auth::check())
                            <p class="card-title h5 d-block text-darker mt-2 mb-3">
                                {{  Auth::user()->name}}
                            </p>                           
                            <p class="card-description mb-4">
                                Email : {{   Auth::user()->email }}
                            </p>
                            <p class="card-description mb-4">
                                Nomor Telp : {{  Auth::user()->phone ? Auth::user()->phone : '-'}}
                            </p>
                            <p class="card-description mb-4">
                                Jenis Kelamin : {{  Auth::user()->gender ? Auth::user()->gender : '-'}}
                            </p>
                            @endif
                    </div>               
                    <a class="text-body text-sm bg-light btn-sm font-weight-bold mb-4 mx-5 icon-move-left mt-auto" href='{{ url()->previous() }}' style="width:150px">
                        <i class="fas fa-arrow-left text-sm ms-1" aria-hidden="true"></i>
                        Kembali
                    </a> 
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection