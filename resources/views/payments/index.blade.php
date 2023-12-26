@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <form role="form text-left" method="GET" action="/list-payment">
                {{-- @csrf --}}
                <div class="form-group d-flex flex-wrap gap-2 mx-3">
                    <div class="d-flex flex-col flex-wrap gap-2 w-25">
                        <input class="form-control" type="text" placeholder="Filter Nama Siswa"  name="student_name" value="{{ $request->student_name }}">
                        <input class="form-control" type="text" placeholder="Filter Kelas Siswa" name="student_class" value="{{ $request->student_class }}">
                    </div>
                    <div class="d-flex flex-col flex-wrap gap-2 w-25">
                        <input class="form-control" type="text" placeholder="Filter Bulan Pembayaran" name="month" value="{{ $request->month }}">
                        <input class="form-control" type="number" placeholder="Filter Tahun Pembayaran" name="year" min="1900" max="2099" step="1" value="{{ $request->year }}">
                    </div>
                    <div class="d-flex gap-3 mx-2">
                        <button type="submit" class="btn bg-gradient-info btn-md mt-4 mb-4">{{ 'Filter' }}</button>
                        <button type="reset" class="btn bg-gradient-warning btn-md mt-4 mb-4">{{ 'Clear' }}</button>
                    </div>
                </div>
            </form>
            <div class="card mb-4 mx-3 px-3">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">List Pembayaran</h5>
                        </div>                        
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
                <div class="card-body px-0 pt-2 pb-2 ">
                    <div class="table-responsive p-0 ">
                        <table class="table align-items-center mb-3 ">
                            <thead>
                                <tr>                  
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">
                                        No.
                                    </th>          
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('name', __('nama siswa'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('class', __('kelas'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('major', __('jurusan'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('amount_payment', __('nominal pembayaran'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('month', __('bulan'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('year', __('tahun'))
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
                                @if($payments->count() > 0)
                                @foreach ($payments as $key =>  $payment)                              
                                <tr>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $payments->firstItem() + $key }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $payment->students->name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $payment->students->class }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $payment->students->major->name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">Rp.{{ number_format($payment->amount_payment, 2, ',', '.') }}</p>
                                    </td>                                
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $payment->month }}</p>
                                    </td>                                
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $payment->year }}</p>
                                    </td>                                
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">
                                            <span class="badge bg-gradient-{{$payment->status == 'paid' ? 'success' : 'danger'}}">{{ $payment->status == 'paid' ? 'Lunas' : 'Belum Lunas' }}</span>
                                        </p>
                                    </td>                                
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">
                                            {{ $payment->created_at->addHours(7)->format('d-m-Y H:i') }}
                                                WIB
                                        </p>                         
                                    </td>                                
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0"> 
                                            {{ $payment->updated_at->addHours(7)->format('d-m-Y H:i') }}
                                            WIB
                                        </p>
                                    </td>                                    
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $payment->createdBy->name}}</p>
                                    </td>                                
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $payment->updatedBy->name}}</p>
                                    </td>          
                                    <td class="text-center position-sticky end-0 bg-body">
                                        <div class="d-flex gap-4 justify-content-between">
                                            <a href="/payments/{{ $payment->id }}" class="btn btn-secondary mt-2 mb-2 ">Detail</a>     
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
                    </div>
                        {{ $payments->links('vendor.pagination.bootstrap-5') }}                       
                </div>
            </div>
        </div>
    </div>
</div>
 



@endsection