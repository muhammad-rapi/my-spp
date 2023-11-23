<?php

namespace App\Http\Controllers;

use App\Models\Arrear;
use App\Models\Student;
use App\Models\Payment;
use App\Models\User;
use App\Http\Requests\Arrear\Store as StoreRequest;
use App\Http\Requests\Arrear\Update as UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ArrearController extends Controller
{

    protected $model, $student, $payment;

    public function __construct(Arrear $model, Student $student, Payment $payment)
    {
        $this->model = $model;
        $this->student = $student;
        $this->payment = $payment;
    }

    public function index()
    {
        $arrears = $this->model->sortable()->paginate(25);
        $paymentStatus = Payment::PAID;

        $payments = $this->payment->where('status', $paymentStatus)->get();
            
        return view('arrears.index', compact('arrears'));
    }

    public function show(string $id)
    {
        $arrear = $this->model->findOrFail($id);

        return view('arrears.detail', compact('arrear', 'payments'));
    }


    public function edit(string $id)
    {
        $arrear = $this->model->findOrFail($id);
        return view('arrears.edit', compact('arrear', 'student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Arrear $arrear)
    {
        $arrear->update($request->validated());
        return redirect()->route('arrears.index')->with('success', 'Tagihan berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Arrear $arrear)
    {
        $arrear->delete();
        return redirect()->route('arrears.index')->with('success', 'Tagihan berhasil dihapus');
    }

}