@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-3">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Profil User</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card">
                        <div class="card-body pt-2">
                            @if(Auth::check())
                            <p class="card-title h5 d-block text-darker mt-5 mb-3">
                                {{  Auth::user()->name}}
                            </p>                           
                            <p class="card-description mb-4">
                                Email : {{  Auth::user()->email}}
                            </p>
                            <p class="card-description mb-4">
                                Nomor Telp : {{  Auth::user()->phone}}
                            </p>
                            @endif
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection