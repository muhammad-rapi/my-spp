<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Major;
use App\Models\User;
use App\Http\Requests\Payment\Store as StoreRequest;
use App\Http\Requests\Payment\Update as UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class PaymentController extends Controller
{

    protected $model, $major;

    public function __construct(Payment $model, Major $major)
    {
        $this->model = $model;
        $this->major = $major;
    }

    public function index()
    {
        $payment = $this->model->all();
        return view('payments.index', compact('payment'));
    }

    public function show(string $id)
    {
        $payment = $this->model->findOrFail($id);
        return view('payments.detail',compact('payment'));
    }

    public function create()
    {
        $major = Major::all();
        return view('payments.create', compact('major'));
    }

    public function store(StoreRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->route('payments.index')->with('success', 'Siswa berhasil ditambah');
    }

    public function edit(string $id)
    {
        $major = $this->major->all();
        $payment = $this->model->findOrFail($id);
        return view('payments.edit', compact('Payment', 'major'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Payment $payment)
    {
        $payment->update($request->validated());
        return redirect()->route('payments.index')->with('success', 'Siswa berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Siswa berhasil dihapus');
    }

}
