<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\VerifyUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use App\Mail\VerifyMail;
use App\SendCode;
use App\Models\Package;
use DB;
use Mail;
use App\Role;
use Illuminate\Http\Request;
use Crypt;
use App\Models\Referral;
use App\Notifications\Notifications;
use App\Models\UserPackage;
use App\Helpers\Helpers;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

   

    protected function validator(array $data,$id)
    {
        // return $data;
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'mobile' => ['required','string','max:11','min:10', 'unique:users,mobile,'.$id],
            'user_category' => 'required|not_in:0',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'captcha' => 'required|captcha',
            'referral_code' => 'nullable|exists:referrals'
        ],
        [
            'captcha.captcha'=>'Invalid captcha code.'
        ]);
    }


    public function register(Request $request)
    {
        $email = User::where('email',$request->email)->where('on_database','1')->first();
        $mobile = User::where('mobile',$request->mobile)->where('on_database','1')->first();
        $id = null;

        if(!empty($email) || !empty($mobile)){
            if(!empty($email)){
                $id = $email->id;
            }else{
                $id = $mobile->id;

            }
        }
        
        // return $id;
        $this->validator($request->all(),$id)->validate();
        // return $id;

        event(new Registered($user = $this->create($request->all(),$id)));
        // $this->guard()->login($user);
        return $this->registered($request, $user)
                        ?: redirect('/verify?phone='.$request->mobile)->with('success','We sent activation code, Check your mobile and also check your email and click on the link to verify your email');
    }

    protected function create(array $data,$id)
    {

        $status = DB::table('status_mast')->select('*')->get();
        $status_id = $status[2]->status_id;

        if($id ==null){
            $user =  User::create([
                'name'          => $data['name'],
                'email'         => $data['email'],
                'password'      => Hash::make($data['password']),
                'mobile'        => $data['mobile'],
                'user_catg_id'  => $data['user_category'],
                'status'        => $status_id,
                'pwd'           => Crypt::encrypt($data['password']),
                'referral_code' => $data['referral_code']
            ]);
        }else{
            $user = User::find($id);
            $user->name             = $data['name'];
            $user->email            = $data['email'];
            $user->password         = Hash::make($data['password']);
            $user->mobile           = $data['mobile'];
            $user->user_catg_id     = $data['user_category'];
            $user->status           = $status_id;
            $user->pwd              = Crypt::encrypt($data['password']);
            $user->referral_code    = $data['referral_code'];
            $user->save();
        }
                      
        if($user){
            
            $user->attachRole(request()->user_category);

            // $user->otp = '5000';
            $user->otp = SendCode::sendCode($user->mobile);
            $user->remember_token = str_random(40);
            $user->registration_date = date('Y-m-d H:i:s');
            $user->save();
            $package = Package::find('4');
            if($user->user_catg_id == '2' || $user->user_catg_id == '3'){
                
                $userPackageData = [
                    'user_id' => $user->id,
                    'package_id' => '4',
                    'discount_perc' => null,
                    'dicount_amount' => null,
                    'net_amount' => '0',
                    'reference_by' => null,
                    'package_start' => date('Y-m-d'),
                    'package_end' => Helpers::package_end_date($package),
                    'payment_mode' => 'Payumoney',
                    'txnid' => 'free',
                ];

                $user_package = UserPackage::create($userPackageData); 


                $user->attachPermission('6');

                $user->user_package_id = $user_package->id;
                $user->package_start = $user_package->package_start;
                $user->package_end = $user_package->package_end;
                $user->save();
            }



            Referral::where('referral_code',$data['referral_code'])->increment('summary_count','1');
            Mail::to($user->email)->send(new VerifyMail($user));


            $admins = User::whereRoleIs('admin')->get();

            $sendData = [
                'id' =>'',
                'title' => "New Registration",
                'url'   => 'users',
                'message'=> $user->name." is registered."
            ];
            foreach ($admins as $admin) {            
                $admin->notify(new Notifications($sendData));
            }


        }

    }


    // protected function create(array $data)
    // {

    //      $status = DB::table('status_mast')->select('*')->get();
    //      $status_id = $status[2]->status_id;
      
    //     $user = User::create([
    //         'name'          => $data['name'],
    //         'email'         => $data['email'],
    //         'password'      => Hash::make($data['password']),
    //         'mobile'        => $data['mobile'],
    //         'user_catg_id'  => $data['user_category'],
    //         'status'        => $status_id,
    //     ]);
    //     $user->attachRole(request()->user_category);

    //     $verifyUser = VerifyUser::create([
    //         'user_id' => $user->id,
    //         'token' => str_random(40)
    //     ]);

    //     Mail::to($user->email)->send(new VerifyMail($user));

    //     return $user;

    // }

    // public function verifyUser($token)
    // {
    //    $status = DB::table('status_mast')->select('*')->get();
       
    //    $result = json_decode(json_encode($status, true));
    //    foreach($result as $key => $value)
    //         {
    //             $result[$key] = (array) $value;
    //         }  

    //   $verifyUser = VerifyUser::where('token', $token)->first();

    //     if(isset($verifyUser) ){
    //         $user = $verifyUser->user;
    //         if($user->status== $result[2]['status_id']) {
    //             $verifyUser->user->status = $result[0]['status_id'];
    //             $verifyUser->user->save();
    //             $success = $result[0]['status_text'];
    //         }else{
    //             $success = "Your e-mail is already verified. You can now login.";
    //         }
    //     }else{
    //         return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
    //     }

    //     return redirect('/login')->with('success', $success);
    // }

    

    public function showRegistrationForm()
    {
        $user_catgs = Role::whereNotIn('id',['1','6','7','8'])->get();
        $status = false;
        if(request('referral_code') !=''){
        	if(is_numeric(request('referral_code'))){
        		$referral = Referral::where('referral_code',request('referral_code'))->first();
        		$status = !empty($referral) ? true :false;
        		$referral_code = request('referral_code');

        	}else{
        		$status = false;
        		
        	}        	
        }else{
        	return view('auth.register', compact('user_catgs'));
        }

        if($status){
        	return view('auth.register', compact('user_catgs','referral_code'));
        }else{
        	return view('error_pages.404page');
        }

        
    }
    
    // protected function registered(Request $request, $user)
    // {
    //     $this->guard()->logout();
    //      $status = DB::table('status_mast')->select('*')->where('status_id','c')->get();
    //         foreach($status as $status){
    //            $status_text = $status->status_text;
    //         }
    //     return redirect('/login')->with('success',$status_text);
    // }  
    
}   