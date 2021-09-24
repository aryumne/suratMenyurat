<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */

    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        if (Auth::user()->role_id == 1) {
            return redirect()->intended('admin.dashboard');
        } elseif (Auth::user()->role_id == 2) {
            return redirect()->intended('pengelola.dashboard');
        }
    }

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function create()
    {
        return view('auth.login',['title' => 'Sign In']);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (Auth::user()->role_id == 1) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->role_id == 2) {
            return redirect()->route('pengelola.dashboard');
        } else {
            return redirect()->route('login');
        }

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
