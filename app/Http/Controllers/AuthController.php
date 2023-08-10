<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api' , ['except' => ['login' , 'register']]);
    }
    public function register(Request $request) {
        
    }

    public function login(Request $request) {
        
    }
}
