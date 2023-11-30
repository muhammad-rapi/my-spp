<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Major;
use App\Models\Payment;
use App\Models\User;
use App\Http\Requests\Student\Store as StoreRequest;
use App\Http\Requests\Student\Update as UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class StudentController extends Controller
{

    protected $model, $major, $payment;

    public function __construct(Student $model, Major $major, Payment $payment)
    {
        $this->model = $model;
        $this->major = $major;
        $this->payment = $payment;
    }

    public function index()
    {
        $students = $this->model->sortable()->paginate(25);

        $isAdmin = USER::ADMIN_ROLE;

        $isOperator = USER::OPERATOR_ROLE;

        $count = $this->model->count();
        return view('students.index', compact('students', 'count', 'isAdmin', 'isOperator'));
    }

    public function show(string $id)
    {
        $student = $this->model->findOrFail($id);
        $payments = $this->payment->where('student_id', $id)->sortable()->get();

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];


        return view('students.detail',compact('student', 'payments', 'months'));
    }

    public function create()
    {
        $majors = $this->major->all();

        return view('students.create', compact('majors'));
    }

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $validated['status'] = 1;

        $this->model->create($validated);
        return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambah');
    }

    public function edit(string $id)
    {
        $major = $this->major->all();
        $student = $this->model->findOrFail($id);
        return view('students.edit', compact('student', 'major'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Student $student)
    {
        $student->update($request->validated());
        return redirect()->route('students.index')->with('success', 'Siswa berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Siswa berhasil dihapus');
    }

}
