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
        $this->middleware('except_role:' . implode(',', [
            User::OPERATOR_ROLE,
        ]))->only(['store', 'update', 'destroy', 'index', 'create', 'edit']);
    }

    public function index(Request $request)
    {
        $payments = $this->model->query()->sortable();

        // filtering data
        $payments = $this->applyFilters($payments, $request);

        // pagination
        $payments = $payments->paginate(25);

        return view('payments.index', compact('payments', 'request'));
    }


    // membuat filtering
    private function applyFilters($payments, Request $request)
    {
        return $payments->when($request->filled('student_name'), function ($query) use ($request) {
            $studentName = $request->student_name;
            return $query->whereHas('students', function ($query) use ($studentName) {
                $query->where('name', 'LIKE', '%' . $studentName . '%');
            });
        })
            ->when($request->filled('student_class'), function ($query) use ($request) {
                $studentClass = $request->student_class;
                return $query->whereHas('students', function ($query) use ($studentClass) {
                    $query->where('class', $studentClass );
                });
            })
            ->when($request->filled('month'), function ($query) use ($request) {
                return $query->where('month', $request->month);
            })
            ->when($request->filled('year'), function ($query) use ($request) {
                return $query->where('year', $request->year);
            });
    }


    public function show(string $id)
    {
        $payment = $this->model->findOrFail($id);
        return view('payments.detail', compact('payment'));
    }

    public function create($student_id)
    {
        $months = [];

        $totalAmount = $this->model->amount_payment * count($months);

        setlocale(LC_TIME, 'id_ID');

        for ($i = 1; $i <= 12; $i++) {
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

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $months = $validated['month'];

        foreach ($months as $selectedMonth) {
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
