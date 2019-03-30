<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Namshi\JOSE\JWT;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authorization(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWT::attempt($credentials)) {
                throw new \Exception('Неверные данные');
            }
            Auth::attempt($credentials, true);
            $user = Auth::user();
            if ($user->hasRole('admin')) {
                return response()->json([
                    'user' => $user,
                    'token' => $token,
                    'csrf' => csrf_token()
                ], 200);
            }
            return response()->json([
                'user' => $user,
                'token' => $token
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'status' => 'error',
                'msg' => $error->getMessage()
            ]);
        }
    }
}
