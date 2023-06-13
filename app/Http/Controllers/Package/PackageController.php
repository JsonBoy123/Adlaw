<?php

namespace App\Http\Controllers\Package;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Support\Facades\Crypt;   
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Helpers;
use App\User;
use DB;
use App\Models\UserPackage;
class PackageController extends Controller
{
    public function index(){
        $user =Auth::user();
    	$packages = Package::all();
    	return view('package.index',compact('packages'));
    }
    public function show($id){
    	$package = Package::with('modules.module')->where('id',$id)->first();
    	// return $package;
    	return view('package.show',compact('package'));

    }
    public function store(Request $request){	
     	$package = Package::find($request->package_id);

    	$posted = [
    		'merchant_key' => 'nnkWHEXA',
    		'salt' => 'HxWgYD3fv9',
		    'txnid' => substr(hash('sha256', mt_rand() . microtime()), 0, 20), # Transaction ID.
		    'amount' => $package->price, # Amount to be charged.
		    'productinfo' => $package->name,
		    'firstname' => "Adlaw", # Payee Name.
		    'email' => "salonij245@gmail.com", # Payee Email Address.
		    'phone' => "7828773421", # Payee Phone Number.
            'hash' => '',
            'package_id' => $request->package_id,
		];

     	return view('package.pay_form',compact('posted'));
    	 // return $package;

    }
    public function payumoney(){

    }
    public function payment_success(Request $request){

        $package = Package::find($request->productinfo);

        $data = [
            'user_id' => Auth::user()->id,
            'package_id' => $request->productinfo,
            'discount_perc' => null,
            'dicount_amount' => null,
            'net_amount' => $request->amount !='' ? $request->amount : $request->amount,
            'reference_by' => null,
            'package_start' => date('Y-m-d'),
            'package_end' => Helpers::package_end_date($package),
            'payment_mode' => 'Payumoney',
            'txnid' => $request->payuMoneyId,
        ];

        $user = Auth::user();
        $user_package = UserPackage::create($data);     

        $permission_user = User::wherePermissionIs('subscription_package')->where('id',$user->id)->first();

        if(!empty($permission_user)){
            DB::table('permission_user')->where('user_id', $permission_user->id)->where('permission_id','6')->delete();
        }
        $user->attachPermission('6');
 
        $user->update(['user_package_id' => $user_package->id , 'package_start' => $data['package_start'], 'package_end' => $data['package_end']]);

    }
    public function payment_cancel(){
        return redirect()->route('package.index');
    }
}
