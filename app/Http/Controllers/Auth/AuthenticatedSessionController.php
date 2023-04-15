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
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // set DITS-HMIS TYPE here
        //    1. hospital
        //    2. medical-collage
        //    3. nursing-home
       //
        $request->session()->put('dits-hmis-type', 'hospital');

        if ($request->session()->has('dits-hmis-type')) {

            $request->authenticate();

            $request->session()->regenerate();

            //IF DITS-HMIS is present in session then it redirect to dashboard page.........

            return redirect()->intended(RouteServiceProvider::HOME);
        }
        else{
            //IF DITS-HMIS is not present in session then it redirect to login page.........
            return redirect()->intended(RouteServiceProvider::ABCD);
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
        Auth::guard('web')->logout();
        //for remove DITS-HMIS type
        $request->session()->forget('dits-hmis-type');
        // dd($request->session()->pull('dits-hmis-type'));

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
