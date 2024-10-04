<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\auth\LoginAdminRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Service\UserService;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @var UserService
     */
    protected UserService $service;

    /**
     * @param UserService $user
     */
    public function __construct(UserService $user)
    {
        $this->service = $user;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Factory|Application
    {
        return view('Admin.Auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(LoginAdminRequest $request)
    {
        try {
            $inputs = $request->only(['username', 'password']);
            $inputs["is_admin"] = true;
            if (Auth::attempt($inputs))
                return redirect()->intended('dashboard');
        } catch (Exception $exception) {
            return redirect()->back()->withErrors(['loginError' => 'Invalid credentials']);
        }
    }
}
