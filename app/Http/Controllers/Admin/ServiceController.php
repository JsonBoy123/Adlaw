<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Notification;
use App\User;
use App\Models\Service\ServiceMast;
use App\Models\Service\ServiceCatgMast;
use App\Models\Service\ServiceClientMast;
use App\Notifications\Notifications;
use App\Role;
class ServiceController extends Controller
{
    
	public function index(){

    	return view('admin.dashboard.services.approval');
    }


    public function services_approval(){
    	$services = ServiceClientMast::with(['service_mast.service_catg_mast','user.roles'])->where('approval','P')->get();
    	$roles =  Role::pluck('display_name','id');
    	
    	return view('admin.dashboard.services.approval.index',compact('services','roles'));
    }
    public function services_approved($id,$status){
    	$service = ServiceClientMast::find($id);

    	if($status == 'approve'){
    		$service->update(['approval' => 'A']);
    		$msgStatus ='approved';

    	 ServiceMast::where('service_code',$service->service_code)->update(['status' => 'A']);
    		
    	}else{
    		$service->update(['approval' => 'D']);
    		$msgStatus ='declined';
    		
    		ServiceMast::where('service_code',$service->service_code)->update(['status' => 'D']);
    	}

    	$sendData = [
    		'id' => '',
    		'title' => $service->service_desc.' '.$msgStatus.' by adlaw.',
    		'message' => 'your applied service '.$msgStatus.' by adlaw',
    		'url' => 'invoice_service'

    	];

    	$user = User::find($service->user_id);
    	$user->notify(new Notifications($sendData));

    	return back()->with('success','Service '.$msgStatus.' successfully.');


    }
}
