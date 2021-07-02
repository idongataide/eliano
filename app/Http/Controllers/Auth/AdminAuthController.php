<?php
namespace App\Http\Controllers\Auth;
use Validator;
use Session;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\admin;


class AdminAuthController extends Controller
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
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLogin()
    {
        return view('auth.admin.login');
    }

    /**
     * Show the application loginprocess.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'),'status' => '1']))
        {
            $user = auth()->guard('admin')->user();
            return redirect()->route('dashboard');
            
        }
        elseif(auth()->guard('admin')->attempt(['username' => $request->input('email'), 'password' => $request->input('password'),'status' => '1']))
        {
            $user = auth()->guard('admin')->user();
            return redirect()->route('dashboard');
        }
        else {
            return back()->with('warning','your username/email and password are incorrect or maybe your account is blocked.');
        }

    }

    /**
     * Show the application logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {       
        auth()->guard('admin')->logout();
        \Session::flush();
        \Session::put('success','You are logout successfully');        
        return redirect(route('admin'));
    }
}