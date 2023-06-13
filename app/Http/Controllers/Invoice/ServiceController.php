<?php

namespace App\Http\Controllers\Invoice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Notification;
use App\User;
use App\Models\Service\ServiceMast;
use App\Models\Service\ServiceCatgMast;
use App\Models\Service\ServiceClientMast;
use App\Notifications\Notifications;
class ServiceController extends Controller
{
    public function index(){
    	$services = ServiceClientMast::with('service_mast.service_catg_mast')->where('user_id',Auth::user()->id)->get();
        // return $services;
    	return view('invoice.service.index',compact('services'));
    }

    public function create(){
    	$service_catgs = ServiceCatgMast::orderBy('service_catg_desc')->get();

		     
		            
    	return view('invoice.service.create',compact('service_catgs'));
    }

    public function store(Request $request){
       
        $request->validate([
            'service_catg_code' => 'required|not_in:""',
            'service_code' => 'required|not_in:"0"',
            'service_rate' => 'required',
            'service_discount' => 'required',
            'status' => 'required|not_in:""'

        ]);
        $approval = 'A';
        if($request->service_code == 'other'){
            $request->validate([
                'service_desc'      => 'required|min:5|max:191',
                'service_shrt_desc' => 'required|min:2|max:5',
            ]);

            $service = [
                'service_desc' => $request->service_desc,
                'service_shrt_desc' => $request->service_shrt_desc,
                'service_catg_code' => $request->service_catg_code
            ];

           $service_code =ServiceMast::create($service)->id;
           // $user = User::wherePermissionIs
            $sendData = [
                'id' => '',
                'title' => 'Invoice service add by '.Auth::user()->name,
                'message' => 'Invoice service added by client approve the service first.',
                'url' => 'services_approval'
            ];

            $approval = 'P';
            $p_users =  User::wherePermissionIs('service_approve')->get();

            Notification::send($p_users, new Notifications($sendData));
        }

        $service_client = [
            'service_rate' => $request->service_rate,
            'service_code' => $request->service_code =='other' ? $service_code : $request->service_code,
            'service_discount' => $request->service_discount,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
            'approval' => $approval
        ];

        ServiceClientMast::create($service_client);
      
        return redirect()->route('invoice_service.index')->with('success','Service added successfully');
    }
    public function edit($id){
        $service_catgs = ServiceCatgMast::orderBy('service_catg_desc')->get();

        $service = ServiceClientMast::with('service_mast')->where('id',$id)->first();
        return view('invoice.service.edit',compact('service_catgs','service'));
    }
    public function show($id){
        $service = ServiceClientMast::find($id);
        $service->update(['status' => 'A']);
        return redirect()->back()->with('success','Service active successfully');
    }
}
