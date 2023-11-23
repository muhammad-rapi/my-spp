@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-3">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Detail Pembayaran</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card">
                        <div class="card-body pt-2">
                            <p class="card-title h5 d-block text-darker mt-5 mb-1">
                                {{  $payment->students->name}}
                            </p>                           
                            <p class="card-description d-block text-darker">
                                {{  $payment->students->class}} {{  $payment->students->major->name}}
                            </p>                           
                            <p class="card-description mb-4">
                                Jumlah Pembayaran : Rp. {{ number_format($payment->amount_payment, 2, ',', '.') }}
                            </p>
                            <p class="card-description mb-4">
                                Bulan : {{  $payment->month}}
                            </p>
                            <p class="card-description mb-4">
                                Waktu Dibuat : {{  $payment->created_at}}
                            </p>
                            <p class="card-description mb-4">
                                Waktu Diubah : {{  $payment->updated_at}}
                            </p>                        
                            <p class="card-description mb-4">
                                Dibuat Oleh : {{  $payment->createdBy->name}}
                            </p>                        
                            <p class="card-description mb-4">
                                Diubah Oleh : {{  $payment->updatedBy->name}}
                            </p>                        
                    </div>                
                    <a class="text-body text-sm bg-light btn-sm w-15 font-weight-bold mb-4 mx-5 icon-move-left mt-auto" href='/list-payment'>
                        <i class="fas fa-arrow-left text-sm ms-1" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection