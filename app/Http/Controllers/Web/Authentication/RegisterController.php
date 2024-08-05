<?php

namespace App\Http\Controllers\Web\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\RegisterRequest;

class RegisterController extends Controller
{
    public function index()
    {
        return view('Authentication.register');
    }

    public function registerStore(RegisterRequest $request)
    {
        // Store data to database
        // Redirect to login page with success message
    }
}