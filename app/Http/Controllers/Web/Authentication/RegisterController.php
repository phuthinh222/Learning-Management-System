<?php

namespace App\Http\Controllers\Web\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Http\Service\Authentication\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    protected $register_service;

    public function __construct(RegisterService $register_service)
    {
       $this->register_service = $register_service;
    }
    public function index()
    {
        return view('Authentication.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->register_service->register($request);
        
        if (!$user) {
            flash()->options(['timeout' => 6000, 'position' => 'top-center'])
            ->error(__('auth.register.failed'));
            return redirect()->route('register');
        }

        return redirect()->route('email_verify', $user->id);
    }

    public function verifyEmail($id, Request $request)
    {
        $user = $this->register_service->find(Auth::user()->id);
        
        return view('Authentication.email_verify', compact('user'));
    }

    public function verifyEmailToken(Request $request, $id)
    {
        $result = $this->register_service->verifyEmail($id, $request->email_verify_token);
        if($result === TRUE) {
            Auth::logout();
            flash()->options(['timeout' => 6000, 'position' => 'top-center'])
            ->success(__('auth.verify_successfull'));
            return redirect()->route('login');
        }
        
        return redirect()->back()->with([
            'failed_verify' => __('email.failed_verify'),
            'user' => $result
        ]);
    }

    public function resendEmailVerification() 
    {
        $result = $this->register_service->resendEmailVerification();

        if ($result) {
            return response()->json([
                'status_code' => Response::HTTP_OK,
                'message' => __('email.resend_successfully'),
            ]);
        }

        return response()->json([
            'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => __('email.resend_failed'),
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}