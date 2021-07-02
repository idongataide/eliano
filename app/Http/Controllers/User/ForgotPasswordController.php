<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Password;
use App\Mail\PasswordMail;
use Illuminate\Support\Facades\Mail;
use App\User;
use DB;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
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
            session(['user_name'=>$user->name]);
            $name = $user->fname. ' '.$user->lname;
            $subject = 'Password Reset';
            $code = str_random(30);
            $data = array('email'=>$user->email);
            $link = url('/user-password/').'/reset/'.$code;
 
            $message = $code;//'<a href={{$link}}>Reset</a>';

            DB::table('password_resets')->insert(
                ['email' => $to, 'token' => $code,  'created_at' => date("Y-m-d h:i:s")]
            );

            Mail::to($data['email'])->send(new PasswordMail($message));

            return redirect()->back()->with('success','Password Reset Link Send Your E-mail');
        }
    } 
}
