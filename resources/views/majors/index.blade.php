@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4 px-3">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">List Jurusan</h5>
                        </div>
                        <a href="/create-major" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Tambah Jurusan</a>
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
                            <table class="table align-items-center mb-3">
                                <thead>
                                    <tr>                            
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">
                                            No.
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            @sortablelink('name', __('nama'))
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            @sortablelink('category', __('kategori'))
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            @sortablelink('created_at', __('Waktu Dibuat'))
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            @sortablelink('updated_at', __('waktu diubah'))
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            @sortablelink('created_by', __('dibuat oleh'))
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            @sortablelink('updated_by', __('diubah oleh'))
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($majors as $key => $major)  
                                    <tr>
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $majors->firstItem() + $key}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $major->name }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $major->category }}</p>
                                        </td>                                
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $major->created_at }}</p>
                                        </td>                                
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $major->updated_at }}</p>
                                        </td>                                
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $major->createdBy->name }}</p>
                                        </td>                                
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $major->updatedBy->name }}</p>
                                        </td>                                
                                        <td class="text-center">
                                            <div class="d-flex gap-4 justify-content-between">
                                            <a href="/majors/{{ $major->id }}" class="mt-2 mb-2 "><i class="fas fa-info-circle fa-lg" style="color: #03a9f4"></i></a>
                                            <a href="/edit-major/{{ $major->id }}" class="mt-2 mb-2"><i class="fas fa-edit fa-lg" style="color:#fb8c00"></i></a>                                        
                                            <a class=" mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $major->id }}"><i class="far fa-trash-alt fa-lg" style="color: #f44335"></i></a>                             
                                        </div>
                                        </td>                                   
                                    </tr>                            
                                    @endforeach                          
                                </tbody>
                            </table>
                        </div>
                    {{ $majors->links('vendor.pagination.bootstrap-5') }}                       
                </div>
            </div>
        </div>
    </div>
</div>


{{-- modal --}}
@foreach ($majors as $m)
<div class="modal fade" id="exampleModal{{ $m->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal" id="exampleModalLabel">{{ 'Apakah kamu yakin ingin menghapus data ini?' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>    
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                <form method="POST" action="{{ route('majors.destroy', ['major' => $m->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn bg-gradient-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection