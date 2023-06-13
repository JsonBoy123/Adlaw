<?php

namespace App\Http\Controllers\CRM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Helpers\Helpers;
use Auth;
use App\User;
use Mail;
use DB;
use Carbon\Carbon;
use App\Models\UserPackage;
use App\Models\Package;
use App\Notifications\SubscriptionReminder;
use App\Mail\SubscriptionReminderMail;
class CRMController extends Controller
{
    public function index(){

    	$modules = Module::orderBy('line')->where('module_type','1')->get();
    	$package_id = Auth::user()->user_package_id;

	    $packageCheck =  Helpers::user_package_check();
		$moduleShow = $packageCheck['moduleShow'];
		$beforeDate = $packageCheck['beforeDate'];
		$packageModules = $packageCheck['packageModules'];

	    $user_package = UserPackage::with('package')->where('user_id',Auth::user()->id)->where('status','1')->first();
	    $oldpackages = UserPackage::with('package')->where('user_id',Auth::user()->id)->where('status','0')->first();

	    $package_premium = '';
	    if(!empty($user_package)){
	    	if($user_package->package_id == '4'){
		    	$package_premium = Package::find('1');
		    }
	    }
	    
	    $packages =  Package::all();
	
    	return view('CRM.index',compact('modules','moduleShow','user_package','beforeDate','oldpackages','packageModules','package_premium','packages'));
    }

    public function old_subscription_package(){

	    $oldpackages = UserPackage::with('package')->where('user_id',request()->id)->where('status','0')->get();
	    return $oldpackages;
    }

	public function expired_subscription(){ 
		$from = date("Y-m-d");
		$to = date("Y-m-d",strtotime("+16 days"));
		
		$users = User::where('package_end', '<=', $to)->whereNull('parent_id')->get();

		foreach ($users as $user) {
			$date_diff =  Helpers::date_diff($user->package_end);

			$data = [
				'id' => $user->id,
	            'title' => 'Subscription Package Expire',
	            'url' => 'crm_dashboard' ,
	            'message' => $date_diff['difference']. " your subscription package ". ($date_diff['difference'] != 'Today' ? ($date_diff['str_arr'][2] == 'after' ? 'expire' : 'expired' )  : 'expire'),
			];

			$user->notify(new SubscriptionReminder($data));
			
			$status = false;
			if($date_diff['difference'] != 'Today'){
				print_r($date_diff['str_arr']);

				if($date_diff['str_arr'][2] == 'after'){
					if(date('d',strtotime($user->package_end)) - date('d') == 15){
						$status = true;
					}elseif(date('d',strtotime($user->package_end)) - date('d') == 7){
						$status = true;
					}	
				}
			}else{
				$status = true;
			}

			if($status){
				Mail::to('riteshpanchal845@gmail.com')->send(new SubscriptionReminderMail($data));
			}

		}
	}
	public function expired_package(){
		$to = date("Y-m-d",strtotime("+15 days"));
		$users = User::where('package_end', '<=', $to)->whereNull('parent_id')->get();
		foreach ($users as $user) {
			if(strtotime(date('Y-m-d')) === strtotime(date('Y-m-d'),strtotime($user->package_end)))
			{
				$permission_user = User::wherePermissionIs('subscription_package')->where('id',$user->id)->first();
				if(!empty($permission_user)){
					DB::table('permission_user')->where('user_id', $permission_user->id)->where('permission_id','6')->delete();
				}

			}
		}

	}



}
