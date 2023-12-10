<?php

namespace App\Listeners;

use App\Events\ArrearCreated;
use App\Models\Payment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendArrear
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
    public function handle(ArrearCreated $event): void
    {
        $data_request = [
            "created_by" => \Auth::id(),
            "amount_payment" => 75000,
            "status" => Payment::UNPAID,
            "year" => 2023,
            "month" => $event->payment->month
        ];

        Payment::create($data_request);
    }
}
