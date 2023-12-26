@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <form role="form text-left" method="GET" action="/list-student">
                {{-- @csrf --}}
                <div class="form-group d-flex flex-wrap gap-2 mx-3">
                    <div class="d-flex flex-col flex-wrap gap-2 w-25">
                        <input class="form-control" type="text" placeholder="Filter Nama Siswa"  name="name" value="{{ $request->name }}">
                        <input class="form-control" type="text" placeholder="Filter Jurusan Siswa"  name="major"value="{{ $request->major }}">
                    </div>
                    <div class="d-flex flex-col flex-wrap gap-2 w-25">
                        <input class="form-control" type="text" placeholder="Filter Kelas Siswa" name="class" value="{{ $request->class }}">
                        <input class="form-control" type="text" placeholder="Filter NIS Siswa" name="nis" value="{{ $request->nis }}">
                    </div>
                    <div class="d-flex gap-3 mx-2">
                        <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Filter' }}</button>
                        <button type="reset" class="btn bg-gradient-warning btn-md mt-4 mb-4">{{ 'Clear' }}</button>
                    </div>
                </div>
            </form>
            <div class="card mb-4 mx-3">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">List Siswa</h5>
                        </div>
                        @if(Auth::user()->hasRole('operator') || Auth::user()->hasRole('headmaster'))
                            <a href="/create-student" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Tambah Siswa</a>
                        @endif
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
                    @if(session('error'))
                        <div class="m-3  alert alert-danger alert-dismissible fade show" id="alert-danger" role="alert">
                            <span class="alert-text text-white">
                            {{ session('error') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="card-body px-0 pt-0 pb-2 mx-3">
                    <div class="table-responsive p-0 ">
                        <table class="table align-items-center mb-3 ">
                            <thead>
                                <tr>     
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">
                                        No.
                                    </th>                       
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('name', __('nama'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('major_id', __('Jurusan'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('class', __('kelas'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('nis', __('NIS'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('gender', __('Jenis Kelamin'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('address', __('alamat'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('status', __('status'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('created_at', __('waktu dibuat'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('updated_at', __('waktu diubah'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('createdBy', __('dibuat oleh'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('updatedBy', __('diubah oleh'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder position-sticky end-0 bg-body">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($students->count() > 0 )
                                    @foreach ($students as $key => $student) 
                                    <tr>
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $students->firstItem() + $key }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $student->name }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $student->major->name }}</p>
                                        </td>                                
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $student->class }}</p>
                                        </td>                                
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $student->nis}}</p>
                                        </td>                                
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $student->gender}}</p>
                                        </td>                                
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $student->address}}</p>
                                        </td>                                
                                        <td class="text-center">
                                            <span class="badge bg-gradient-{{$student->status ? 'success' : 'danger'}}">{{ $student->status ? 'Aktif' : 'Non Aktif' }}</span>
                                        </td>                                
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $student->created_at->addHours(7)->format('d-m-Y H:i') }}
                                                WIB
                                            </p>                         
                                        </td>                                
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0"> 
                                                {{ $student->updated_at->addHours(7)->format('d-m-Y H:i') }}
                                                WIB
                                            </p>
                                        </td>                                      
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $student->createdBy->name}}</p>
                                        </td>                                
                                        <td class="text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $student->updatedBy->name}}</p>
                                        </td>                                
                                        <td class="text-center position-sticky end-0 bg-body">
                                            <div class="d-flex gap-4 justify-content-between">
                                                @if(Auth::user()->hasRole('admin'))
                                                <a href="/students/{{ $student->id }}" class=" btn bg-gradient-secondary btn-xs mt-2">
                                                    Detail
                                                </a>
                                                @else
                                                <a href="/students/{{ $student->id }}" class=" mt-2 mb-2 ">
                                                    <i class="fas fa-search-plus fa-lg" style="color:#03a9f4"></i>
                                                </a>
                                                @endif
                                                @if(!Auth::user()->hasRole('admin'))
                                                <a href="/edit-student/{{ $student->id }}" class="mt-2 mb-2">
                                                    <i class="fas fa-edit fa-lg" style="color:#fb8c00"></i>
                                                </a>                                        
                                                <a class=" mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $student->id }}"><i class="far fa-trash-alt fa-lg" style="color: #f44335"></i></a>   
                                                @endif  
                                                @if(!Auth::user()->hasRole('operator'))
                                                <a class="btn bg-gradient-success btn-xs mt-2" href="{{ route('payment.create', ['student_id' => $student->id]) }}" >
                                                    Bayar
                                                </a>
                                                @endif
                                            </div>
                                        </td>                                   
                                    </tr>    
                                    @endforeach       
                                @else
                                <tr>
                                    <td colspan="12" class="text-left">
                                        <p class="text-xl font-weight-bold mb-0">{{ 'Data Tidak Ditemukan' }}</p>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $students->links('vendor.pagination.bootstrap-5') }}                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 

{{-- modal --}}
@foreach ($students as $student)
<div class="modal fade" id="exampleModal{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form method="POST" action="{{ route('students.destroy', ['student' => $student->id]) }}">
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