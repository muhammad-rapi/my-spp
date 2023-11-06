@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-3">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Detail Siswa</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card">
                        <div class="card-body pt-2">
                            <p class="card-title h5 d-block text-darker mt-5 mb-3">
                                {{  $student->name}}
                            </p>                           
                            <p class="card-description mb-4">
                                Kelas : {{  $student->class}}
                            </p>
                            <p class="card-description mb-4">
                                Jurusan : {{  $student->major->name}}
                            </p>
                            <p class="card-description mb-4">
                                NIS : {{  $student->nis}}
                            </p>
                            <p class="card-description mb-4">
                                Alamat : {{  $student->address}}
                            </p>
                        {{-- <div class="author align-items-center">                        
                            <div class="name ps-3">
                            <span>Mathew Glock</span>
                            <div class="stats">
                                <small>Posted on 28 February</small>
                            </div>
                            </div>
                        </div> --}}
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection