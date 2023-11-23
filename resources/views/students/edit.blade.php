@extends('layouts.user_type.auth')

@section('content')


<div>
    <div class="container-fluid">
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
                            {{ $student->name }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ $student->class}} {{$student->major->name }}
                        </p>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Profile Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('students.update', ['student' => $student->id]) }}" method="POST" role="form text-left">
                    @csrf
                    @method('PATCH')
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
                                <label for="student-name" class="form-control-label">{{ __('Name') }}</label>
                                <div class="@error('student.name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" value="{{ $student->name }}" placeholder="Name" id="student-name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="major" class="form-control-label">{{ __('Jurusan') }}</label>
                                <div class="@error('major.id')border border-danger rounded-3 @enderror">
                                    <select name="major_id" class="form-select" aria-label="Default select example">
                                        <option selected>Pilih Jurusan</option>
                                        @foreach ($major as $m)                                            
                                        <option value="{{ $m->id }}" @if($m->id == $student->major_id) selected @endif>
                                            {{ $m['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('major')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror                                        
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="class" class="form-control-label">{{ __('Kelas') }}</label>
                                <div class="@error('student.class')border border-danger rounded-3 @enderror">
                                    <select name="class" class="form-select" aria-label="Default select example">
                                        <option value="" selected>Pilih Kelas</option>
                                        <option value="X" @if($student->class == 'X') selected @endif>X</option>
                                        <option value="XI" @if($student->class == 'XI') selected @endif>XI</option>
                                        <option value="XII" @if($student->class == 'XII') selected @endif>XII</option>
                                    </select>

                                        @error('class')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror                                        
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nis" class="form-control-label">{{ __('NIS') }}</label>
                                <div class="@error('student.nis')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" value="{{$student->nis }}"  placeholder="NIS" id="nis" name="nis">
                                        @error('nis')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror                                        
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="class" class="form-control-label">{{ __('Alamat') }}</label>
                                <div class="@error('student.address')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" value="{{$student->address }}"  placeholder="Alamat" id="address" name="address">
                                        @error('address')
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
                <a class="text-body text-sm bg-light btn-sm w-15 font-weight-bold mb-4 mx-5 icon-move-left mt-auto" href='{{ url()->previous() }}'>
                        <i class="fas fa-arrow-left text-sm ms-1" aria-hidden="true"></i>
                        Kembali
                    </a>
            </div>
        </div>
    </div>
</div>
@endsection