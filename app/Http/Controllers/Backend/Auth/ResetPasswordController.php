<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Backend\BackendController;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends BackendController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return $this->render('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }


    /**
     * redirect to after success login
     */
    protected function redirectTo()
    {
        return route('dashboard');
    }
}
