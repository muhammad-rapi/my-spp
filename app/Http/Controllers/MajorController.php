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

    protected $model;

    public function __construct(Major $model)
    {
        $this->model = $model;
    }


    public function index()
    {
        $majors = $this->model->paginate(25);
        return view('majors.index', compact('majors'));
    }

    public function create()
    {
        return view('majors.create');
    }

    public function store(StoreRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->route('majors.index')->with('success', 'Jurusan berhasil ditambah');
    }

    public function edit(string $id)
    {
        $major = $this->model->findOrFail($id);
        return view('majors.edit', compact('major'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Major $major)
    {
        $major->update($request->validated());
        return redirect()->route('majors.index')->with('success', 'Jurusan berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major)
    {
        $major->delete();
        return redirect()->route('majors.index')->with('success', 'Jurusan berhasil dihapus');
    }

}
