<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;

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
    protected $redirectTo = 'admin\login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin-portal.auth.login');
    }

    public function login(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');

        $message = [
          'email.required' => 'This field is required.',
          'email.email' => 'Email format not valid',
          'password.required' => 'This field is required.',
        ];

        $validator = Validator::make($request->all(), [
          'email' => 'required|email',
          'password' => 'required',
        ], $message);

        if($validator->fails())
        {
          return redirect()->route('loginForm')->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['email' => $email, 'password' => $password, 'confirmed'=>'Y' ]))
        {
            $set = User::find(Auth::user()->id);
            $getCounter = $set->login_count;
            $set->login_count = $getCounter+1;
            $set->update();

            return redirect()->route('adpor.dashboard');
        }
        else
        {
            return redirect()->route('loginForm')->with('status', 'Your account is not active or wrong password')->withInput();
        }
    }
}
