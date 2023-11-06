<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Major;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class StudentController extends Controller
{

    
    public function index()
    {
        $student = Student::all();
        return view('students/list-student', [
            'student' => $student,
        ]);
    }

    public function show(string $id)
    {
        $student = Student::findOrFail($id);
        return view('students/detail-student', [
            'student' => $student
        ]);
    }

    public function create()
    {
        $major = Major::all();
        return view('students/add-student', ['major' => $major]);
    }

    public function store(Request $request)
    {

        $attributes = $request->validate([
            'name'     => ['required', 'max:50'],
            'major_id'     => ['required', 'max:50'],
            'class' => ['required', 'max:50'],
            'nis' => ['required', 'max:50'],
            'address' => ['required', ],
        ]);


        Student::create([
            'name'     => $attributes['name'],
            'major_id' => $attributes['major_id'],
            'class' => $attributes['class'],
            'nis' => $attributes['nis'],
            'address' => $attributes['address'],
        ]);


        return redirect('/list-student')->with('success', 'Siswa berhasil ditambah');
    }

    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        $major = Major::all();
        return view('students/edit-student', [
            'major' => $major,
            'student' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = Student::findOrFail($id);
        $attributes = $request->validate([
            'name'     => ['required', 'max:50'],
            'major_id' => ['required', 'max:50'],
            'class'    => ['required', 'max:50'],
            'nis'      => ['required', 'max:50'],
            'address'  => ['required',],
        ]);

        $data->Update([
            'name'     => $attributes['name'],
            'major_id' => $attributes['major_id'],
            'class'    => $attributes['class'],
            'nis'      => $attributes['nis'],
            'address'  => $attributes['address'],
        ]);



        return redirect('/list-student')->with('success', 'Siswa berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Student::findOrFail($id);
        $data->delete();
        return redirect('/list-student')->with('success', 'Siswa berhasil dihapus');
    }

}
