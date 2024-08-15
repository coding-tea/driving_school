<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{


    /***
     *
     * @return
     */
    public function index()
    {
        $this->setPageTitle(trans('auth.log_in'));
        return view('pages.auth.login');
    }

    /***
     *
     * @return
     */
    public function performAuthentication(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /***
     *
     * @return
     */
    public function performLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(
            RouteServiceProvider::HOME
        );
    }
}
