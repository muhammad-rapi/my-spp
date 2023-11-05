@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">List Jurusan</h5>
                        </div>
                        <a href="/add-major" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Tambah Jurusan</a>
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
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Category
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($major as $m)  
                                <tr>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $m['name'] }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $m['category'] }}</p>
                                    </td>                                
                                    <td class="text-center">
                                        <div class="d-flex gap-3 justify-content-center">
                                            <a href="/update-major/{{ $m['id'] }}" class="btn bg-gradient-info btn-sm mt-2 mb-2">{{ 'Edit' }}</a>
                                            <form method="POST" action="/delete-major/{{ $m['id'] }}" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn bg-gradient-danger btn-sm mt-2 mb-2">Delete</button>
                                            </form>                                      
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