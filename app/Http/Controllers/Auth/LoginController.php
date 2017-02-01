<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function cURLtest()
    {
/*        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://www.google.com");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 22);
        $result = curl_exec($curl);
        curl_close($curl);
        print $result;*/
        $curl = curl_init();
        $fp = fopen("somefile.txt", "w");
        curl_setopt ($curl, CURLOPT_URL, "http://www.php.net");
        curl_setopt($curl, CURLOPT_FILE, $fp);

        curl_exec ($curl);
        curl_close ($curl);
    }

}
