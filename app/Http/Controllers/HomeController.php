<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Customer;
use App\Models\City;
use App\Models\State;
use App\Models\Blog;
use App\Models\CourtType;
use App\Models\CourtMast;
use App\Models\CourtMastHeader;
use App\Models\SubCatgMast;

use App\SendCode1;
use Illuminate\Support\Facades\Hash;
use Crypt;
use App\Models\CauseList;
use Mail;
use App\Mail\CauseListMail;
use App\Models\Service\ServiceMast;
use App\Models\Service\ServiceClientMast;
use DB;
class HomeController extends Search\SearchController 
{
    
    public function index(){
      // return Crypt::decrypt('eyJpdiI6ImMzV2tjXC9Qb2k1cXhkU0VkMkRjbW1BPT0iLCJ2YWx1ZSI6IlVOUG43cldHWW95OVc0eVFIQW5aZU8wZkNDYkQ5ZXBJbFdRRkgzUmxwaDQ9IiwibWFjIjoiODhhMDRkMjc2MzQ2NmZhMzI4MjkwNjRiYTQ1OWFhOTJlYWNiN2ZjZWE5YzMyYjE0ZGE1ZTcwMGMxYTM2MjA1YyJ9');
        // $blogs = Blog::where('status','A')->limit(5)->get();
        // $blog_id =array();
        // foreach($blogs as $blog){
        // $blog_id[] = $blog->id;
        // }

        // $blogs1 = Blog::whereNotIn('id',$blog_id)->where('status','A')->limit(5)->get();
        // $blog_id1 =array();
        // foreach($blogs1 as $blog1){
        // $blog_id1[] = $blog1->id;
        // }
        // $blog_id2 = array_merge($blog_id,$blog_id1);

        return view('layouts.home');
    }
    // public function home(){
    //     return view('home');
    // }
    public function getStateList(Request $request)
    {
        $states = State::where("country_code",$request->country_id)->orderBy('state_name','ASC')
                    ->get();
        return response()->json($states);
    }
        
    public function getCityList()
    {
      
      $cities = City::where("state_code",request()->state_code)->orderBy('city_name','ASC')->get();
      return response()->json($cities);
    } 

    public function getCityCount($id)
    {
      
      $cities = DB::table('users')
         ->select(DB::raw('count(users.id) as city_count, city_mast.city_name,city_mast.city_code'))
         ->where('users.user_catg_id', '=', 2)
         ->where('users.state_code','=',$id)
         ->join('city_mast','users.city_code', '=','city_mast.city_code')
         ->groupBy('users.city_code')     
         ->orderBy('city_count','desc')
         ->limit(15)
         ->get();
   
      return response()->json($cities);
    }

    public function getCityListDropDown(Request $request)
    {        
      $data['cities'] = City::where("state_code",$request->state_code)->orderBy('city_name','ASC')->get();

      $data['cityCode'] = auth()->user()->city_code;

         // return  $data['cityCode'];
      return response()->json($data);

    }
    public function getCityListClientDropDown(Request $request){
      $data['cities'] = City::where("state_code",$request->state_code)->get();
      $city = Customer::select('city_code')->where('cust_id',$request->cust_id)->first();

       $data['cityCode'] = $city->city_code;
       return response()->json($data);

    }
    public function courtTypeFilter(Request $request){
       $courts = CourtType::where('court_group_code',$request->court_group_code)->get();
       return response()->json($courts); 
    }
    public function court_category($court_type){
      $courts = CourtMast::select('court_code','court_name')->where('court_type',$court_type)->orderBy('court_name','ASC')->get();
      return response()->json($courts); 
    }

    public function case_subcategory(){
      $subcategories = SubCatgMast::where('catg_code',request()->catg_code)->get(); 
      return response()->json($subcategories);
    }

    public function all_notifications(){
      return view('notifications.all_notifications');
    }
    public function get_all_users(){
      $user = User::where('email', request('email'))->first();
      if($user){
        echo 'duplicate';
      }
    }

    public function notification_read($id,$id1 = null){
      // return $id1;
      $notification = auth()->user()->unreadNotifications->where('id',$id)->first();
       $notification->markAsRead();
       if($id1 !=null){
        return 'success';
       }

       return redirect($notification->data['url']);
    }
    public function state_city_court(){

      if(request()->state_code ==''){
        $courts = CourtMastHeader::where('city_code',request()->city_code)->get();
      }else{
        $courts = CourtMastHeader::where('state_code',request()->state_code)->get();        
      }
      $court_type = array();
      foreach ($courts as $court) {
        $court_type [] = $court->court_type;

      }
      $court_types = array();

      if(!empty($court_type)){
        $court_types =   CourtType::whereIn('court_type',$court_type)->get();
      }

      return response()->json($court_types);
    }


   public function connectLogin(){

      //return redirect('http://127.0.0.1:8002/custom-login?email='.Auth::user()->email.'&password='.Auth::user()->password);
         // return Redirect("http://connect-adlaw.laxyo.org");

      return redirect('http://chat.adlaw.in/custom-login?email='.Auth::user()->email.'&password='.Auth::user()->password);
        // return Redirect("http://chat.adlaw.in/custom-login");

   } 

   public function connectcj(){

      return redirect('https://courtsjudgments.com/site/signup');
   } 

  public function password_change(){
    return view('auth.passwords.change_password');
  }
  public function changePassword(Request $request)
  {
    $request->validate([
      'new_password' => 'min:8|required_with:confirm_password|same:confirm_password',
      'confirm_password' => 'min:8'
    ]);

    $user = User::find(auth()->user()->id);

    if(Hash::check($request->old_password, $user->password)) {
      $user->password = bcrypt($request->new_password);
      $user->pwd = Crypt::encrypt($request->new_password);
      $user->save();

      $status = 'Password Updated!';
      return redirect()->back()->with('success',$status);
    } else {
      $class = 'alert alert-danger';
      $status = 'Old password incorrect!';
      return redirect()->back()->with('warning',$status);
    }

  }

  public function refreshCaptcha()
  {
      return response()->json(['captcha'=> captcha_img('flat')]);
  }


  public function verified_account(){
    $user = User::find(Auth::user()->id);
    if($user->on_database == '1'){

    }else{
      
    }
  }

  public function message_sent(){
    return view('admin.dashboard.message');
  }

  public function message_sent_store(Request $request){

     $users =  User::where('user_catg_id','2')->where('state_code','21')->where('mobile','!=','')->get();
     return $users;
     // return count($users);
      foreach ($users as $key => $value) {
        $sendData = [
            'message' =>'ADLAW, bridging gap to connect the clients in legal profession for Law professional by featured CRM and huge Judgments data (3 Million in SC HC) and other modules. Avail promotional offer of profile worth Rs. 4000/- is free for first 200 numbers. Click https://adlaw.in/register or Call 91-8815218307/08/09',
            'mobile' => $value->mobile 
        ]; 

        SendCode1::sendCode($sendData);  
        User::find($value->id)->update(['message_sent' => '1']);
          
      }
    // return $request->message;
      $sendData = [
          'message' => 'ADLAW, bridging gap to connect the clients in legal profession for Law professional by featured CRM and huge Judgments data (3 Million in SC HC) and other modules. Avail promotional offer of profile worth Rs. 4000/- is free for first 200 numbers. Click https://adlaw.in/register or Call 91-8815218307/08/09',
          'mobile' => '7828773421,8815218308,8815218307' 
      ]; 
       
        SendCode1::sendCode($sendData);     

  // die;

// return redirect()->back()->with('success','Message Sent Successfully');

    return "success";
  }



  public function cause_list_reminder(){
        $date = date('Y-m-d');
        $cause_lists =  CauseList::whereDate('hearing_date',$date)->get();

        // $users = User::whereIn('licence_no',$licence_no)->get();

        foreach ($cause_lists as $cause_list) {
            $user = User::where('licence_no',$cause_list->licence_no)->first();
            if(!empty($user)){
              $sendData['message'] = 'ADLAW - Daily Causelist Agenda: Following cases(s) are going to appear before the court today:- '.$cause_list->case_no;

              if($user->can('message_sent')){
                $sendData['mobile']  = $user->mobile;

                if(SendCode1::sendCode($sendData) == 'success'){
                  $user->increment('no_msg_sent',1);
                } 
              } 

              $sendData['title'] = 'Daily Causelist Agenda';
              $sendData['subject'] = 'Daily Causelist Agenda';


              Mail::to($user->email)->send(new CauseListMail($sendData));
                          
            }
        }


        // dd($users);
    }


  public function testphone(){

        // $username="ritesh845";
        // $password ="ritesh@100";
        // $number = '7828773421';
        // $sender = "TESTID";
        // $message = rand(1111,9999);
     
        // $url="login.bulksmsgateway.in/sendmessage.php?user=".urlencode($username)."&password=".urlencode($password)."&mobile=".urlencode($number)."&sender=".urlencode($sender)."&message=".urlencode($message)."&type=".urlencode('3'); 



    //   $url =  "http://login.yourbulksms.com/api/sendhttp.php?authkey=11456AxEiTIeN5ca87c66&mobiles=7828773421&message=test & new&mobile&sender=ADLAWR&route=4";
    // // $url = "http://login.yourbulksms.com/api/balance.php?authkey=11456AxEiTIeN5ca87c66&type=1";

    //     $ch = curl_init($url);

    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //     echo $curl_scraped_page = curl_exec($ch);

    //     curl_close($ch); 
    //   return $url;
    //     return rand(1111,9999);
  }
  public function service_mast_fetch($service_catg_code){
    return ServiceMast::where('status','A')->where('service_catg_code',$service_catg_code)->get();
  }
  
  public function service_client_mast_fetch($service_catg_code){
    
   return ServiceClientMast::with(['service_mast' => function($q) use($service_catg_code){
      $q->where('service_catg_code',$service_catg_code);

   }])->has('service_mast')->where(['status' => 'A','user_id' => Auth::user()->id, 'approval' => 'A'])->get();
        
  }
}
