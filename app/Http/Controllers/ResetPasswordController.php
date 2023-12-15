<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ResetPassword\Update as UpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request)
    {

        $user = $request->user();

        if ( Hash::check($request->current_password, $user->password) ) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            return back()->with('success', 'Password Berhasil Diedit');
        }

        throw ValidationException::withMessages([
            'current_password' => 'Password Saat Ini Tidak Sesuai'
        ]);

    }


}
