<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\user\Index as IndexRequest;
use App\Http\Requests\user\Store as StoreRequest;
use App\Http\Requests\user\Update as UpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
        $this->middleware('except_role:'.implode(',', [
            User::ADMIN_ROLE, User::HEADMASTER_ROLE
        ]))->only(['store', 'update', 'destroy', 'index', 'create', 'edit']);
    }


    public function index()
    {
        $users = $this->model->sortable()->paginate(25);
        $count = $this->model->count();
        return view('users.index', compact('users', 'count'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($request->password);

        $this->model->create($validated);
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambah');
    }

    public function edit(string $id)
    {
        $user = $this->model->findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->validated());
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus');
    }

}
