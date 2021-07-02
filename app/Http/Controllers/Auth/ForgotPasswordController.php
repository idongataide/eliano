<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Password;
use App\User;
use DB;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showLinkRequestForm()
    {
        $data['page_title'] = "Send Link password";
        return view('auth.passwords.email',$data);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $us = User::whereEmail($request->email)->count();
        if ($us == 0)
        {
            return redirect()->back()->with('danger', 'We can\'t find a user with that e-mail address.');
        }else{
            $user = User::whereEmail($request->email)->first();
            $to =$user->email;
            $name = $user->fname. ' '.$user->lname;
            $subject = 'Password Reset';
            $code = str_random(30);

            $link = url('/user-password/').'/reset/'.$code;
 
            $message = "<a href='{{$link}}'>Reset</a>";

            DB::table('password_resets')->insert(
                ['email' => $to, 'token' => $code,  'created_at' => date("Y-m-d h:i:s")]
            );           

            return redirect()->back()->with('success','Password Reset Link Send Your E-mail');
        } 
    }
}

