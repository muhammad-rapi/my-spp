<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use App\Models\User;
use App\Http\Requests\Payment\Store as StoreRequest;
use App\Http\Requests\Payment\Update as UpdateRequest;
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
        return view('payments.index', compact('payments'));
    }

    public function show(string $id)
    {
        $payment = $this->model->findOrFail($id);
        return view('payments.detail',compact('payment'));
    }

    public function create($student_id)
    {
        // $payments = $this->model;       
        return view('payments.create', ['student_id' => $student_id]);
    }

    public function store(StoreRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil Dibuat');
    }

    public function edit(string $id)
    {
        $student = $this->student->all();
        $payment = $this->model->findOrFail($id);
        return view('payments.edit', compact('Payment', 'student'));
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
