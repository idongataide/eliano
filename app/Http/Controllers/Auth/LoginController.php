<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\userlogin;
use App\Models\company;


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

    
    protected $redirectTo = 'user/home';
     


    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }


    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function findUsername()
    {
        $login = request()->input('email');
 
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
 
        request()->merge([$fieldType => $login]);
 
        return $fieldType;
    }
 
    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($logintype)
    {

       
        $checker = 'google_plus';

        if($logintype=='facebook')
            $checker=$logintype;
        if($logintype=='twitter')
            $checker=$logintype;

        if(!getSetting($checker.'_login', 'module'))
        {
            flash('Ooops..!', $logintype.'_login_is_disabled','error');
             return redirect(PREFIX);
        }
        $this->provider = $logintype;
        return Socialite::driver($this->provider)->redirect();

    }

     /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($logintype)
    {

        try{
            $user = Socialite::driver($logintype);

            if(!$user)
            {
                return redirect(PREFIX);
            }

            if ( 'twitter' === $logintype ) {
                $user = $user->user();
            } else {
                $user = $user->stateless()->user();
            }



             if($user)
             {
                if($this->checkIsUserAvailable($user, $logintype)) {
                    $availableuser = $this->dbuser;
                    Auth::loginUsingId($availableuser->id, true);
                    flash('Success...!', 'log_in_success', 'success');
                    return redirect($this->redirectTo);
                }
                flash('Ooops...!', 'faiiled_to_login', 'error');
                return redirect(PREFIX);
             }
         }
         catch (Exception $ex)
         {
            
            return redirect(PREFIX);
         }

    }

   


    public function authenticated(Request $request, $user)
    {

        $basic = company::first();
        $login_status = FALSE;
        if (Auth::attempt(['username' => $request->email, 'password' => $request->password])) {
                
                $login_status = TRUE;
        }
        elseif (Auth::attempt(['email'=> $request->email, 'password' => $request->password])) {
            $login_status = TRUE;
        }

        if(!$login_status)
        {
        	 $message = getPhrase("Please Check Your Details");
             flash('Ooops...!', $message, 'error');
			 return redirect()->back();
        }


       if($user->status == 0){
            $this->guard()->logout();
            return redirect('/login')->with('warning','Sorry Your Account is BLOCKED!');
       }

       if($basic->go_live == 1)
       {
                $user_ip = request()->ip();

                $baseUrl = "http://www.geoplugin.net/";
                $endpoint = "json.gp?ip=" . $user_ip."";
                $httpVerb = "GET";
                $contentType = "application/json"; //e.g charset=utf-8
                $headers = array (
                "Content-Type: $contentType",
                );
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_URL, $baseUrl.$endpoint);
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $content = json_decode(curl_exec( $ch ),true);
                
                    
                $err     = curl_errno( $ch );
                $errmsg  = curl_error( $ch );
                curl_close($ch);


            $continent = $content['geoplugin_continentName'];
            $country = $content['geoplugin_countryName'];
            $city = $content['geoplugin_city'];

            $ul = new userlogin();
        
            $ul->name = $request->email;
            $ul->user_id = $user->id;
            $ul->user_ip =  request()->ip();
            if($city){
            $ul->location = ''.$conti.', '.$country.' , '.$city.'';
            }
            else{
            $ul->location = 'Unknown';
                }
                $ul->details = $_SERVER['HTTP_USER_AGENT'];
        
       
            $ul->save();
        }


        //return true;
            

    }


    public function logout(Request $request)
    {
        Auth::guard()->logout();
        return redirect('/login')->with('success','You have been logged out!');
    }
}
