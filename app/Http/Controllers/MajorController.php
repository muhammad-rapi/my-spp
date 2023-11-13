<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Major\Index as IndexRequest;
use App\Http\Requests\Major\Store as StoreRequest;
use App\Http\Requests\Major\Update as UpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class MajorController extends Controller
{

    private $majors;

    public function __construct(Major $majors)
    {
        $this->majors = $majors;
    }


    public function index()
    {
        $majors = $this->majors->all();
        return view('majors.index', compact('majors'));
    }

    public function create()
    {
        return view('majors.create');
    }

    public function store(StoreRequest $request)
    {

        $this->majors->create($request->validated());
        return redirect()->route('majors.index')->with('success', 'Jurusan berhasil ditambah');
    }

    public function edit(string $id)
    {
        $major = $this->majors->findOrFail($id);
        return view('majors.edit', compact('major'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        //
        $major = $this->majors->findOrFail($id);

        $major->update($request->validated());

        return redirect()->route('majors.index')->with('success', 'Jurusan berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->majors->findOrFail($id);
        $data->delete();
        return redirect()->route('majors.index')->with('success', 'Jurusan berhasil dihapus');
    }

}
