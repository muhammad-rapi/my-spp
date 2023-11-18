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

class ProfilController extends Controller
{

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $user = $this->model->all();
        return view('profiles.index', compact('user'));
    }

}
