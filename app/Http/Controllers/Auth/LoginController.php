<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Report;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;   


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

    /**
 * Handle an authentication attempt.
 *
 * @return Response
 */

    public function authenticate(Request $request)
    {       
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            Report::where('from', $request->session()->get('sessionid'))->
            update(array('from'  => $request->user()->name));
          
            return Redirect::to("wec/show")->with('alert', 'IT WORKS! LOGIN VERIFIED');
        }

        else{            
            $file = ("../public/output/inspection.html"); 
            echo "<script>
                alert('E-mail or password is invalid');
                </script>";
            return view('anonymous/failedLogin')->with('relatorio', $file);             
        }
    }

}
