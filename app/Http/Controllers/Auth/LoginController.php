<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = 'board/board';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if(Auth::attempt($credentials)){
            return redirect()->intended('dashboard');
        }
    }

    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $confirm = DB::table('users')->where('email', $request->email)->value('activated');
        if($confirm != 1){
            return back()->with('message', '본인의 메일에서 인증해주세요.');
        }

        if(!auth()->attempt($request->only('email', 'password'), $request->has('remember'))){
            return back()->withInput();
        }

        return redirect()->intended('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('board.board');
    }
}
