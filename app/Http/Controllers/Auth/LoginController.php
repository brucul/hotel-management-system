<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\SettingHotel;

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

    public function showLoginForm()
    {
        $getsetting = SettingHotel::latest('id')->first();
        $apk_name = 'default';
        $hotel_name = 'default';
        $pict = 'default';
        if (!empty($getsetting)) {
            $apk_name = $getsetting->apk_name;
            $hotel_name = $getsetting->hotel_name;
            $pict = $getsetting->pict;
        }
        $title = "Login";
        $sub_title = "";
        return view('auth.login', compact('title', 'sub_title', 'apk_name', 'hotel_name', 'pict', 'getsetting'));
    }
}
