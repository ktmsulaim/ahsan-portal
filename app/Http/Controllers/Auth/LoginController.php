<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        $user->last_login = Carbon::now();
        $user->save();

        return Redirect::intended(route('home'));
    }

    protected function loggedOut(Request $request) {
        return redirect('/login');
    }

    /**
     * Get the login credentials from the request, normalized for mobile/autocomplete.
     * Trims whitespace and lowercases email to avoid "invalid credentials" from
     * keyboard/paste quirks (e.g. trailing space, wrong case).
     */
    protected function credentials(Request $request)
    {
        $email = $request->input($this->username());
        $password = $request->input('password');

        return [
            $this->username() => is_string($email) ? strtolower(trim($email)) : $email,
            'password' => is_string($password) ? trim($password) : $password,
        ];
    }
}
