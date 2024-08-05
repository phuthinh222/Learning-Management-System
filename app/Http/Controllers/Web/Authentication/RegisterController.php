<?php

namespace App\Http\Controllers\Web\Authentication;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return view('Authentication.register');
    }
}