<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Major;
use App\Models\User;
use App\Http\Requests\Student\Store as StoreRequest;
use App\Http\Requests\Student\Update as UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class StudentController extends Controller
{

    protected $model, $major;

    public function __construct(Student $model, Major $major)
    {
        $this->model = $model;
        $this->major = $major;
    }

    public function index()
    {
        $students = $this->model->paginate(1);
        return view('students.index', compact('students'));
    }

    public function show(string $id)
    {
        $student = $this->model->findOrFail($id);
        return view('students.detail',compact('student'));
    }

    public function create()
    {
        $majors = $this->major->all();

        return view('students.create', compact('majors'));
    }

    public function store(StoreRequest $request)
    {
        $this->model->create($request->validated());
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
