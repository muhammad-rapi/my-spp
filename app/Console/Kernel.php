<?php

namespace App\Console;

use App\Models\Arrear;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */

    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    // protected function schedule(Schedule $schedule)
    // {
    //     $hour = config('app.hour');
    //     $min = config('app.min');
    //     $scheduledInterval = $hour !== '' ? ( ($min !== '' && $min != 0) ?  $min .' */'. $hour .' * * *' : '0 */'. $hour .' * * *') : '*/'. $min .' * * * *';
    //     if(env('IS_DEMO')) {
    //         $schedule->command('migrate:fresh --seed')->cron($scheduledInterval);
    //     }
    // }

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {

            // Mendapatkan tanggal hari ini
            $today = Carbon::today();

            // Mendapatkan bulan dan tahun hari ini
            $month = $today->month;
            $year = $today->year;

            $payments = Payment::whereMonth('month', $month - 1)->whereYear('year', $year)->get();

            foreach ($payments as $payment) {
                // Jika status pembayaran adalah unpaid
                if ( $payment->status == Payment::UNPAID ) {
                    // Membuat data arrear baru
                    $arrear = new Arrear();
                    $arrear->student_id = $payment->student_id;
                    $arrear->payment_id = $payment->id;
                    $arrear->month = $month;
                    $arrear->year = $year;
                    $arrear->amount_of_arrears = $payment->amount_payment;
                    $arrear->save();

                    // Mengubah status pembayaran menjadi unpaid
                    $payment->status = Payment::UNPAID;
                    $payment->save();
                }
            }
        })->monthlyOn(1);
    }


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
