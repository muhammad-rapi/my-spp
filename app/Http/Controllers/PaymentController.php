<?php

namespace App\Http\Controllers;

use App\Events\PaymentSuccessful;
use App\Models\Payment;
use App\Models\Student;
use App\Models\User;
use App\Http\Requests\Payment\Store as StoreRequest;
use App\Http\Requests\Payment\Update as UpdateRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class PaymentController extends Controller
{

    protected $model, $student;

    public function __construct(Payment $model, Student $student)
    {
        $this->model = $model;
        $this->student = $student;
    }

    public function index()
    {
        $payments = $this->model->with('students')->sortable()->paginate(25);
        $count = $this->model->count();
        $sum = $this->model->sum('amount_payment');
        return view('payments.index', compact('payments', 'count', 'sum'));
    }

    public function show(string $id)
    {
        $payment = $this->model->findOrFail($id);
        return view('payments.detail',compact('payment'));
    }

    public function create($student_id)
    {
        $months = [];

        $totalAmount = $this->model->amount_payment * count($months);

        setlocale(LC_TIME, 'id_ID');

        for($i = 1; $i <= 12; $i++) {
            $date = Carbon::create(null, $i, 1);
            $months[$i] = [
                'number'     => $i,
                'name'       => $date->formatLocalized('%B'), 
                'short_name' => $date->formatLocalized('%b'), 
            ];
        }

        $startYear = Carbon::now()->subYears(2)->format('Y');
        $endYear = Carbon::now()->format('Y');
        $years = range($startYear, $endYear);


        return view('payments.create', [
            'student_id' => $student_id,
            'months' => $months,
            'years' => $years,
        ]);
    }

    public function store(StoreRequest $request) {
        $validated = $request->validated();

        $months = $validated['month']; 

        foreach($months as $selectedMonth) {
            $payment = $this->model->create([
                'student_id'     => $validated['student_id'],
                'amount_payment' => $validated['amount_payment'],
                'month'          => $selectedMonth,
                'year'           => $validated['year'],
                'status'         => 'paid',
            ]);

            event(new PaymentSuccessful($payment));
        }

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil Dibuat');
    }


    public function edit(string $id)
    {
        $student = $this->student->all();
        $payment = $this->model->findOrFail($id);
        return view('payments.edit', compact('payment', 'student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Payment $payment)
    {
        $payment->update($request->validated());
        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus');
    }

}
