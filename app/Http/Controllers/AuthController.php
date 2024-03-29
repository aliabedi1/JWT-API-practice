<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api' , ['except' => ['login' , 'register']]);
    }
    public function register(RegisterRequest $request) {
        $inputs = $request->all();
        $inputs['password'] = Hash::make($inputs['password']);
        return Response::store('user created successfully.',User::create($inputs));
    }

    public function login(LoginRequest $request) {
        $inputs = $request->all();

        return !$token = auth()->attempt($inputs) ? Response::unauthorized(null, __('auth.failed')) : $this->createNewToken($token);
    }
    

    private function createNewToken($token)
    {
        
    }
}
