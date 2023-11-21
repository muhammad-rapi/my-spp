<?php

namespace App\Listeners;

use App\Events\PaymentSuccessful;
use App\Models\PaymentHistoryLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendHistoryLog
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentSuccessful $event): void
    {
        $data_request = [
            "created_by" => \Auth::id(),
            "payment_id" => $event->payment->id,
            "notes" => 'Pembayaran berhasil dibuat'
        ];

        PaymentHistoryLog::create($data_request);
    }
}
