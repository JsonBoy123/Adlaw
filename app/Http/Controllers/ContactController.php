<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Mail;
use App\Role;
use App\User;
use App\Mail\Contact;
use App\Mail\SubscriptionContact;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\ContactUs;
use App\Models\SubcriptionContact;
use App\Notifications\SubscriptionReminder;
use App\Notifications\Notifications;

class ContactController extends Controller
{

    public function index()
    {
	  return view('pages.subpages.contact_us');
    }

    public function store(Request $request){
       
       $user =  $this->validate($request,[
                    'fname'         => 'required|max:100|string',  
                    'lname'         => 'required|max:100|string',                      
                    'cemail'        => 'required|email|max:255',    
                    "mobile_no"     => "required|max:10|min:10|regex:/^([0-9\s\-\+\(\)]*)$/",                    
                    "address"       => "nullable",
                    "message"       => "required",
               ],[
                // 'captcha.captcha'=>'Invalid Captcha Try Again',
                'fname.required'=>'First name field is required',
                'lname.required'=>'Last name field is required',
                'cemail.required'=>'Email address field is required',
                'cemail.email'=> 'Check email address',
               
               ]);

        ContactUs::create($user);

        Mail::to($user['cemail'])->send(new Contact($user));
        $admins = User::whereRoleIs('admin')->get();
        $sendData = [
            'id' =>'',
            'title' => "someone contact",
            'url'   => 'contact_details',
            'message'=> $user['fname']." ".$user['fname']." want to contact you"
        ];
        foreach ($admins as $admin) {            
            $admin->notify(new Notifications($sendData));
        }
        return redirect()->back()->with(['message'=>'Thank You! For Contact Us. We Will Contact You Soon...']);
      
    }
    public function refreshCaptcha() {
      
        return captcha_img('flat');
    }
    
    public function buy_crm_dashboard(Request $request){

        $data = [
            'name' => $request->name,
            'package_id' => $request->package_id,
            'email' => $request->email,
            'mobile'=> $request->mobile,
            'message' => $request->message,
            'no_of_members' => $request->members,
            'no_of_clients' => Auth::user()->user_catg_id !='5' ? $request->clients : '0',
            'user_id' => Auth::user()->id,
            'status' => $request->user_status
        ];

        $data =  SubcriptionContact::create($data);
        $role = Role::find(Auth::user()->user_catg_id);
        $data['user_catg_name'] = $role->display_name;
        //Mail
        // Mail::to('salonij245@gmail.com')->send(new SubscriptionContact($data));
        
        //Notification
        $admins = User::whereRoleIs('admin')->get();

        $data['title'] = "Subscription Contact";
        $data['url'] = "show_subscription";
        $data['message'] = $data->user_catg_name." want to subscription";


        foreach ($admins as $admin) {            
            $admin->notify(new SubscriptionReminder($data));
        }

        return redirect()->back()->with('success','Your request send to our team. We will be contact you soon...');
    }

  

 }
