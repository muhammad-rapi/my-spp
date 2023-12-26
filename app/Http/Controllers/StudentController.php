<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Major;
use App\Models\Payment;
use App\Models\User;
use App\Http\Requests\Student\Store as StoreRequest;
use App\Http\Requests\Student\Update as UpdateRequest;
use Illuminate\Http\Request;


class StudentController extends Controller
{

    protected $model, $majorModel, $paymentModel;

    public function __construct(Student $model, Major $majorModel, Payment $paymentModel)
    {
        $this->model = $model;
        $this->majorModel = $majorModel;
        $this->paymentModel = $paymentModel;
    }

    public function index(Request $request)
    {
        $students = $this->model->query()->sortable();

        // role pada user
        $isAdmin = USER::ADMIN_ROLE;
        $isOperator = USER::OPERATOR_ROLE;

        // membuat filtering
        $students = $this->applyFilters($students, $request);

        // pagination
        $students = $students->paginate(25);

        return view('students.index', compact('students', 'isAdmin', 'isOperator', 'request'));
    }

    private function applyFilters($students, Request $request)
    {
        return $students->when($request->filled('name'), function ($query) use ($request) {
            return $query->where('name', 'LIKE', '%' . $request->name . '%');
        })
            ->when($request->filled('major'), function ($query) use ($request) {
                $major = $request->major;
                return $query->whereHas('major', function ($query) use ($major) {
                    $query->where('name', 'LIKE', '%' . $major . '%');
                });
            })
            ->when($request->filled('class'), function ($query) use ($request) {
                return $query->where('class', $request->class);
            })
            ->when($request->filled('nis'), function ($query) use ($request) {
                return $query->where('nis', $request->nis);
            });
    }


    public function show(string $id)
    {
        $student = $this->model->findOrFail($id);
        $payments = $this->paymentModel->where('student_id', $id)->sortable()->get();

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        return view('students.detail', compact('student', 'payments', 'months'));
    }

    
    public function create()
    {
        $majors = $this->majorModel->all();

        return view('students.create', compact('majors'));
    }

    public function store(StoreRequest $request)
    {
        \DB::beginTransaction();
        try {
            $validated = $request->validated();
            $validated['status'] = 1;
            $this->model->create($validated);
            \DB::commit();
            return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambah');
        } catch (\Illuminate\Database\QueryException $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Proses Data Gagal Silakan Coba Lagi');
        }

    }

    public function edit(string $id)
    {
        $major = $this->majorModel->all();
        $student = $this->model->findOrFail($id);
        return view('students.edit', compact('student', 'major'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Student $student)
    {
        \DB::beginTransaction();
        try {
            $student->update($request->validated());
            \DB::commit();
            return redirect()->route('students.index')->with('success', 'Siswa berhasil diedit');
        } catch (\Illuminate\Database\QueryException $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Proses Data Gagal Silakan Coba Lagi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try{
            $student->delete();
            \DB::commit();
            return redirect()->route('students.index')->with('success', 'Siswa berhasil dihapus');
        }catch(\Illuminate\Database\QueryException $e){
            \DB::commit();
            return redirect()->route('students.index')->with('error', 'Proses Data Gagal Silakan Coba Lagi');
        }
    }

}
