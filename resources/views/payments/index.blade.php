@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-3">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">List Pembayaran</h5>
                        </div>
                        <a href="/create-student" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Tambah Pembayaran</a>
                    </div>
                    @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>                            
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Siswa
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nominal Pembayaran
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Bulan
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Dibuat Pada
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Dibuat Oleh
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payment as $std)                              
                                <tr>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $std->name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $std->major->name }}</p>
                                    </td>                                
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $std->class }}</p>
                                    </td>                                
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $std->nis}}</p>
                                    </td>                                
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $std->address}}</p>
                                    </td>                                
                                    <td class="text-center">
                                        <div class="d-flex gap-3 justify-content-center">
                                            <a href="/students/{{ $std->id }}" class="btn bg-gradient-secondary btn-xs mt-2 mb-2">{{ 'Detail' }}</a>
                                            <a href="/edit-student/{{ $std->id }}" class="btn bg-gradient-info btn-xs mt-2 mb-2">{{ 'Edit' }}</a>                                                                    
                                        </div>
                                    </td>                                   
                                </tr>    
                                @endforeach                          
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 



@endsection