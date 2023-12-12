@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-2 mx-3">
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
                            <p class="card-description mb-2">
                                {{  $student->class}}  {{  $student->major->name}}
                            </p>                            
                            <p class="card-description mb-2">
                                NIS : {{  $student->nis}}
                            </p>
                            <p class="card-description mb-2">
                                Jenis Kelamin : {{  $student->gender}}
                            </p>
                            <p class="card-description mb-2">
                                Alamat : {{  $student->address}}
                            </p>                        
                            <p class="card-description mb-2">
                                Status : <span class="badge bg-gradient-{{$student->status ? 'success' : 'danger'}}">{{ $student->status ? 'Aktif' : 'Tamat' }}</span>
                            </p>                        
                    </div>             

                    @if(!Auth::user()->hasRole('operator'))
                    <div class="d-flex flex-row justify-content-between m-4">
                        <div>
                            <h5 class="mb-0">List Pembayaran</h5>
                        </div>                        
                    </div>
                    <div class="table-responsive p-0 mx-5">
                        <table class="table align-items-center mb-3">
                            <thead>
                                <tr>                  
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">
                                        No.
                                    </th>          
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('month', __('bulan'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('month', __('tahun'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('amount_payment', __('nominal pembayaran'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('created_at', __('tanggal pembayaran'))
                                    </th>                                    
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('created_at', __('status'))
                                    </th>                                    
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('createdBy', __('dibuat oleh'))
                                    </th>                            
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder position-sticky end-0 bg-body">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $key =>  $payment)                              
                                <tr>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $key + 1 }}
                                        </p>
                                    </td>                                   
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $payment->month }}</p>
                                    </td>                                
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $payment->year }}</p>
                                    </td>                                
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">Rp.{{ number_format($payment->amount_payment, 2, ',', '.') }}</p>
                                    </td>                                
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ date_format($payment->created_at,"d-m-Y H:i")}} WIB</p>
                                    </td>                                                                     
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">
                                            <span class="badge bg-gradient-{{$payment->status == 'paid' ? 'success' : 'danger'}}">{{ $payment->status == 'paid' ? 'Lunas' : 'Belum Lunas' }}</span>
                                        </p>                                        
                                    </td>                                                                 
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $payment->createdBy->name}}</p>
                                    </td>                                                                
                                    <td class="text-center position-sticky end-0 bg-body">
                                        <div class="d-flex gap-4 justify-content-between">
                                            <a href="/payments/{{ $payment->id }}" class="btn btn-secondary mt-2 mb-2 ">Detail</a>     
                                        </div>                                      
                                    </td>                                
                                </tr>    
                                @endforeach                          
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex flex-row justify-content-between m-4">
                        <div>
                            <h5 class="mb-0">List Tagihan</h5>
                        </div>
                    </div>
                    {{-- <div class="table-responsive p-0 mx-5">
                        <table class="table align-items-center mb-3">
                            <thead>
                                <tr>                  
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">
                                        No.
                                    </th>          
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('name', __('nama siswa'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('amount_payment', __('nominal pembayaran'))
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        @sortablelink('month', __('bulan'))
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
                                @foreach ($payments as $key =>  $payment)                              
                                <tr>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $key + 1 }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $payment->students->name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">Rp.{{ number_format($payment->amount_payment, 2, ',', '.') }}</p>
                                    </td>                                
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $payment->month }}</p>
                                    </td>                                
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $payment->created_at}}</p>
                                    </td>                                
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $payment->updated_at}}</p>
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
                            </tbody>
                        </table>
                    </div> --}}
                    @endif
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