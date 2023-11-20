<?php

namespace App\Http\Controllers\Auth;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    public $userService ;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.register');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(LoginRequest $request)
    {

        if ($this->userService->login($request->only(["username", "password"]))) {
            return response()->json([
                "status" => true,
                "redirect" => url("dashboard")
            ]);
        } else {
            return response()->json([
                "status" => false,
                "errors" => ["Invalid credentials"]
            ]);
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(RegisterRequest $request)
    {


        $user = $this->userService->create($request->validated());

        Auth::login($user);

        return response()->json([
            "status" => true,
            "redirect" => url("dashboard")
        ]);

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()) {
            return view('home');
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()
    {
        Auth::logout();

        return Redirect('login');
    }
}
