<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\User;
use App\SendCode;
use DB;
use Crypt;
class LoginController extends Controller
{
    
    use AuthenticatesUsers;

    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }

    public function redirectPath()
    {
        $catgId = Auth::user()->user_catg_id;
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }
        switch ($catgId) {
            case '1' : $login = '/admin';
                break;
            case '2':
                return $login = '/lawfirm';
                break;
            case '3':
                return $login = '/lawfirm';
                break;
            case '4':
                return $login = '/lawschools';
                break;
            case '5':
                return $login = '/customer';
                break;
            case '6':
                return $login = '/lawschools';
                break;  
            case '7':
                return $login = '/lawschools';
                break;  
            case '8':
                return $login = '/customer';
                break; 
            default:
                return $login='/';
        }
        return property_exists($this, 'redirectTo') ? $this->redirectTo : $login;
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string'
        ]);
    }

    
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
          $this->hasTooManyLoginAttempts($request)) {
          $this->fireLockoutEvent($request);

          return $this->sendLockoutResponse($request);
        }
        if($this->guard()->validate($this->credentials($request))){

          $user = $this->guard()->getLastAttempted();

          if(is_numeric($request->get('email'))){
              if($user->mobile_verified_at !=null && $this->attemptLogin($request)) {
                  if($user->pwd == null){
                    $user->pwd = Crypt::encrypt($request->get('password'));
                    $user->save();
                  }
                  return $this->sendLoginResponse($request);
              }else{
                 $user->otp = SendCode::sendCode($user->mobile); 
              
                 if($user->save()){
                      return redirect('/verify?phone='.$user->mobile)->with('success','We sent activation code, Check your mobile number');
                 }
              }
          }elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
              if($user->email_verified_at !=null && $this->attemptLogin($request)) {

                  if($user->pwd == null){
                     $user->pwd = Crypt::encrypt($request->get('password'));
                    $user->save();
                  }
                  return $this->sendLoginResponse($request);                
              }else{

                  $this->incrementLoginAttempts($request);
                  //$user->code = SendCode::sendCode($user->phone);
                  if($user->save()){
                     return redirect()->back()->with('warning','Your account is not active. We already sent activation link, Check your email and click on the link to verify your email');
                  }
              }
          }

        }
      
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
      }
      protected function credentials(Request $request)
      {
        if(is_numeric($request->get('email'))){
          return ['mobile'=>$request->get('email'),'password'=>$request->get('password')];
        }
        elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
          return ['email' => $request->get('email'), 'password'=>$request->get('password')];
        }
        return ['email' => $request->get('email'), 'password'=>$request->get('password')];
      }

//After login redirect

    protected function authenticated(Request $request, $user)
    {
        $url =  $this->redirectTo = url()->previous();
        $homeUrl =url('/').'/';   

        if($url == $homeUrl){
          return redirect()->intended($this->redirectPath());
        }
        else{
          return redirect()->intended($url);
        }
     }

    
}
