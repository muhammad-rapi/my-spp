<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class MajorController extends Controller
{

    public function index()
    {
        $major = Major::all();

        return view('majors/list-major', [
            'major' => $major,
        ]);
    }

    public function create()
    {
        return view('majors/add-major');
    }

    public function store(Request $request)
    {

        $attributes = $request->validate([
            'name'     => ['required', 'max:50'],
            'category' => ['required', 'max:50'],
        ]);


        Major::create([
            'name'     => $attributes['name'],
            'category' => $attributes['category'],
        ]);


        return redirect('/list-major')->with('success', 'Jurusan berhasil dibuat');
    }

    public function edit(string $id)
    {
        $data = $data = Major::findOrFail($id);
        return view('majors/edit-major',['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = Major::findOrFail($id);
        $attributes = $request->validate([
            'name'     => ['required', 'max:50'],
            'category' => ['required', 'max:50'],
        ]);


        $data->update([
            'name'     => $attributes['name'],
            'category' => $attributes['category'],
        ]);


        return redirect('/list-major')->with('success', 'Jurusan berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Major::findOrFail($id);
        $data->delete();
        return redirect('/list-major')->with('success', 'Jurusan berhasil dihapus');
    }

}
