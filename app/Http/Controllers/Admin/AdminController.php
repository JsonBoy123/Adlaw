<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\User;
use Carbon\Carbon;
use App\Permission;
use App\Models\Review;
use App\Models\Status;
use App\Models\ContactUs;
use App\Models\SubcriptionContact;
use App\Models\CourtMastHeader;
use App\Models\Court;
use App\Models\Package;
use App\Models\UserPackage;
use App\Models\TempUsers;
use App\Models\State;
use App\Models\City;
use App\Models\CauseList;
use App\Imports\ExcelImport;
use App\Imports\CauseListImport;
use App\Exports\ExcelUploadErrors;
use App\Exports\CauseListErrorExport;  
use Illuminate\Support\Str;
// use App\Exports\StudentErrorExport;
// use App\Exports\StudentDetailExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\Notifications;
use Crypt;
use App\Role;
use App\Models\CourtType;
use App\Models\CourtMast;

use App\Models\CatgMast;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\Hash;
use App\Models\Referral;

class AdminController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){

		// $users = User::whereNull('parent_id')->get();
        // $collect = collect($users)->where('user_catg_id','2')->where('on_database','1')->where('status','A')->count();
         // return Crypt::decrypt('eyJpdiI6IlwvUHFuYjVtRzB4ZWNXU1hwSkNndlVnPT0iLCJ2YWx1ZSI6IkYwc3JlUUlSYVwvamxDZDl3dHQ2SmJDR1FcL1psU2MrUE5BcTFMTWR1dHFcLzg9IiwibWFjIjoiZDEyZTZjMmYxMjhlNzkxMGZkZmU4NGRkZGZiNTEzYTU1MmFkYzNmODY5MjI3ZTI4MzExNGZlMzAxMDIzZTg0ZSJ9');
		return view('admin.dashboard.dashboard');      
	}
    public function user_data_fetch(){
        $users = User::whereNull('parent_id')->get();

        // return collect($users)->where('user_catg_id','2')->count();
        // return [

        //     // 'user_total'       =>  collect($users)->count(),
        //     // 'user_subscription' => collect($users)->where('user_package_id','!==', null)->where('package_end','>',date('Y-m-d'))->count(),
        //     // 'user_unsubscription'=> collect($users)->where('user_package_id', null)->count(),
        //     // 'user_delete'       =>User::onlyTrashed()->whereNull('parent_id')->count(),
        //     // 'user_renewal'      => collect($users)->where('user_package_id','!==', null)->where('package_end','<',date('Y-m-d'))->count(),
        //     // 'lawyer_total'  => collect($users)->where('user_catg_id','2')->count()
        //     // 'lawyer_registered'      => collect($users)->where('user_catg_id','2')->where('on_database','0')->count(),
        //     // 'lawyer_import'      => collect($users)->where('user_catg_id','2')->where('on_database','1')->where('status','D')->count(),
        //     // 'lawyer_import_reg'      => collect($users)->where('user_catg_id','2')->where('on_database','1')->where('status','!==','D')->count(),
        //     // 'lawyer_subscirption'      => collect($users)->where('user_catg_id','2')->where('user_package_id','!==',null)->where('package_end','>',date('Y-m-d'))->count(),
        //     // 'lawyer_unsubscirption'      => collect($users)->where('user_catg_id','2')->where('user_package_id',null)->count(),
        //     // 'lawyer_renewal'      => collect($users)->where('user_catg_id','2')->where('user_package_id','!==', null)->where('package_end','<',date('Y-m-d'))->count(),
        //     // 'lawfirm_total'      => collect($users)->where('user_catg_id','3')->count(),
        //     // 'lawfirm_registered'      => collect($users)->where('user_catg_id','3')->where('on_database','0')->count(),
        //     // 'lawfirm_import'      => collect($users)->where('user_catg_id','3')->where('on_database','1')->where('status','D')->count(),
        //     // 'lawfirm_import_reg'      => collect($users)->where('user_catg_id','3')->where('on_database','1')->where('status','!==','D')->count(),
        //     // 'lawfirm_subscirption'      => collect($users)->where('user_catg_id','3')->where('user_package_id','!==',null)->where('package_end','>',date('Y-m-d'))->count(),
        //     // 'lawfirm_unsubscirption'      => collect($users)->where('user_catg_id','3')->where('user_package_id',null)->count(),
        //     // 'lawfirm_renewal'      => collect($users)->where('user_catg_id','3')->where('user_package_id','!==', null)->where('package_end','<',date('Y-m-d'))->count(), 
        //     // 'lawschools_total'      => collect($users)->where('user_catg_id','4')->count(),
        //     // 'lawschools_registered'      => collect($users)->where('user_catg_id','4')->where('on_database','0')->count(),
        //     // 'lawschools_import'      => collect($users)->where('user_catg_id','4')->where('on_database','1')->where('status','D')->count(),
        //     // 'lawschools_import_reg'      => collect($users)->where('user_catg_id','4')->where('on_database','1')->where('status','!==','D')->count(),
        //     // 'lawschools_subscirption'      => collect($users)->where('user_catg_id','4')->where('user_package_id','!==',null)->where('package_end','>',date('Y-m-d'))->count(),
        //     // 'lawschools_unsubscirption'      => collect($users)->where('user_catg_id','4')->where('user_package_id',null)->count(),
        //     // 'lawschools_renewal'      => collect($users)->where('user_catg_id','4')->where('user_package_id','!==', null)->where('package_end','<',date('Y-m-d'))->count(),
        // ];
    }
    public function connectLogin(){
      return redirect('http://chat.adlaw.in/custom-login?email='.Auth::user()->email.'&password='.Auth::user()->password);
    } 


	//show all pending reviews 
	public function pending_reviews(){

		$pending_reviews = DB::table('users')->join('user_reviews', 'user_reviews.user_id','=','users.id')->where('review_status', 'C')->get();

		$active_reviews =Review::join('users','user_reviews.user_id','=','users.id')->where('review_status', 'A')->get();

		return view('admin.dashboard.review', compact('pending_reviews','active_reviews'));
	}
		//approved pending reviews
	public function active_pending_reviews($review_id){

		Review::where('review_id',$review_id)->update(['review_status'=>'A']);

		return redirect()->back();
	}
	//decline one reviews
	public function decline_pending_reviews($review_id){

		Review::where('review_id',$review_id)->update(['review_status'=>'B']);
		return redirect()->back();
	}

	//Approved selected pending reviews

	public function active_all_reviews(Request $request){

		Review::whereIn('review_id',$request->review_ids)->update(['review_status'=>'A']);
		return "Selected reviews approved successfully";
	}
	//Decline selected pending reviews

	public function decline_all_reviews(Request $request){
		Review::whereIn('review_id',$request->review_ids)->update(['review_status'=>'B']);
		return "Selected reviews declined successfully";
	}

	public function bloguser(){
		$bloguser = User::with('role')->get();
		$permission = DB::select('select * from permissions');
		$gotpermision=DB::select('select * from permission_user');
		return view('admin.dashboard.blog.blog_users',compact('bloguser','permission','gotpermision'));
	}
	public function blogpremission(Request $request){
		$userid=$request->user_id;
		$user= User::find($userid);
		$data=$request->hiddenValue;
		foreach($data as $permis){
			$user->attachPermission($permis);
		}  

	}
	public function contact_details(){
		$contacts =  ContactUs::all();
		return view('admin.dashboard.contact.index',compact('contacts'));
	} 

	public function show_subscription(){
		$subscriptions =  SubcriptionContact::with(['user.role','package'])->where('active','0')->get();
        // return $subscriptions;
		$packages = Package::all();
        return view('admin.dashboard.contact.show_subsription',compact('subscriptions','packages'));
    }
    public function find_subscriptions(){
    	$all_subsc =  SubcriptionContact::with('user.role')->where('active','0')->get();
    	if(request()->btnId == 'btnNew'){
			$subscriptions = collect($all_subsc)->filter(function($e){
				return $e->status == 'new';
			});
    	}
    	else if(request()->btnId == 'bntRenew'){
    		$subscriptions = collect($all_subsc)->filter(function($e){
				return $e->status == 'renew';
			});
    	}else{
    		$subscriptions = $all_subsc;
    	}
    	return view('admin.dashboard.contact.table_subscription',compact('subscriptions'));
    }


    public function package_fetch(){
		$package = Package::find(request()->id);
    	return response()->json($package);
    }

 
    public function subscription_package_active(Request $request){
        return $request->all();
        
    	if($request->btn_id =='renew'){
    		$subscription =  SubcriptionContact::find($request->subscription_id);
            if(!empty($subscription)){
                $user = User::find($subscription->user_id);
                $subscription_status = $subscription->status;
            }else{
                $user = User::find($request->subscription_id);
                $subscription_status = 'renew';
            }    		

    	}else{
            // return "asdas";
    		$user = User::find($request->subscription_id);
    		$subscription_status = $request->btn_id;
    	}

    	$data = [
    		'user_id' => $user->id,
    		'package_id' => $request->package_id,
    		'discount_perc' => $request->discount_perc,
    		'dicount_amount' => $request->dicount_amount ,
    		'net_amount' => $request->net_amount,
    		'reference_by' => $request->reference_by,
    		'package_start' => $request->start_date,
    		'package_end' => $request->end_date,
    	];


        // return $subscription_status;
    	if($subscription_status == 'renew' || $subscription_status == 'upgrade'){
    		$old_user_package = UserPackage::find($user->user_package_id);

    		$old_user_package->update(['status' => '0']);
    		$old_pack_end = date('Y-m-d',strtotime($old_user_package->package_end));  

    		//This code is used for old package date and now date diff. 

    		$created = new Carbon($old_pack_end);
			$now = Carbon::now();
			$difference = ($now->diff($created)->days < 1)
			    ? 'today'
			    : $now->diffForHumans($created);

		    if($difference != 'today'){
		   		$str_arr = explode(" ",$difference);
		   		$day = $str_arr[0] + 1;
		   		if($str_arr[2] == 'after'){
					$data['package_end'] = date('Y-m-d', strtotime($data['package_end']. ' + '.$day. ' days'));
		   		}
		    }

    	}

    	$user_package = UserPackage::create($data);	  	
	  	$permission_user = User::wherePermissionIs('subscription_package')->where('id',$user->id)->first();

		if(!empty($permission_user)){
			DB::table('permission_user')->where('user_id', $permission_user->id)->where('permission_id','6')->delete();
		}


		$user->attachPermission('6');
		if($request->btn_id =='renew'){
    		$subscription->update(['active' => '1']);
    	}
    	$user->update(['user_package_id' => $user_package->id , 'package_start' => $data['package_start'], 'package_end' => $data['package_end']]);
    	// Mail::to($subscription->email)->send(new )
    	return "success";
    }
    public function uploadData(){
    	return view('admin.dashboard.upload.index');
    }

    public function importData(Request $request){
    	$request->validate([
    		'type' => 'required|not_in:""',
    		// 'file' => 'required'
    	]);
    	// return Str::random(40);
        $test = [];
        $test1 = [];
    	$status = true;
    	$duplicate = false;
    	$errors = array();
        $datas = Excel::toCollection(new ExcelImport,$request->file('file'));
        // return "hello";
        //  return $datas;
    	foreach($datas as $value){
    		foreach ($value as $data) {
    			$user = array();
    			if($data['name'] !=''){
    				$user['name'] = $data['name'];
    				if($data['contact_no'] !='' || $data['email'] !=''){
    					if($data['contact_no'] !=''){
    						if(is_numeric($data['contact_no'])){
    							if(strlen($data['contact_no']) == '10' || strlen($data['contact_no']) == '11'  ){
    								$oldUser = User::where('mobile',$data['contact_no'])->first();

    								if(!empty($oldUser)){
										$duplicate = true;
									}
    								$user['mobile'] = $data['contact_no'];
								}else{
    								$status = false;
    							}
    						}else{
								$status = false;
							}
    					}
    					if($data['email'] !=''){
    						if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
    							$oldUser = User::where('email',$data['email'])->first();
    							if(!empty($oldUser)){
									$duplicate = true;
								}
								$user['email'] = $data['email'];
								 
    						}else{
								$status = false;
							}
    					}
    				}else{
    					$status = false;
    				}
    				if($status){
    					if($data['state'] !=''){
    						$state = State::where('state_name',$data['state'])->first();
    						if(!empty($state)){
    							if($data['city'] !=''){
    								$city = City::where('city_name',$data['city'])->first();
    								if(!empty($city)){
    									$user['state_code'] = $city->state_code; 
    									$user['city_code'] = $city->city_code; 
    								}else{
    									$status = false;
    								}
    							}else{
    								$status = false;
    							}
    						}else{
    							$status = false;
    						}
    					}else{
    						$status = false;
    					}
    				}
    			}else{
    				$status = false;
    			}
				if($status == true){
					$user['user_catg_id'] = $request->type;
					$user['on_database']  = '1';
					$user['status']  = 'D';
					if($duplicate){

                        // $test1[] = [
                        //     's_no'          => $data['sno'],
                        //     'name'          => $data['name'],
                        //     'contact_no'    => $data['contact_no'],
                        //     'email'         => $data['email'],
                        //     'city'          => $data['city'],
                        //     'state'         => $data['state'],
                        // ];  
                        if(empty($oldUser)){
                         //User::find($oldUser['id'])->update($user);

                        }

				  		
					}else{
                        // $test[] = [
                        //     's_no'          => $data['sno'],
                        //     'name'          => $data['name'],
                        //     'contact_no'    => $data['contact_no'],
                        //     'email'         => $data['email'],
                        //     'city'          => $data['city'],
                        //     'state'         => $data['state'],
                        // ];  

				  		$newuser = User::create($user);
				  	    $court = CourtMastHeader::where('city_code',$user['city_code'])->where('court_type','3')->first();
				  		if(!empty($court)){
				  			Court::insert(['user_id' => $newuser->id,'court_code' => $court->court_code]);
				  		}
				  		
					}
				}else{
					$errors[] = [
						's_no' 		    => $data['sno'],
						'name' 			=> $data['name'],
						'contact_no' 	=> $data['contact_no'],
						'email' 		=> $data['email'],
						'city' 			=> $data['city'],
						'state' 		=> $data['state'],
					];
				}
				$status = true;
				$duplicate = false;
    		}
    	}

    	if(count($errors) !=0){
            return Excel::download(new ExcelUploadErrors($errors), 'error_sheet.xlsx');
        }
        return back()->with('success',"Successfully");

    }
    public function user_appointment(){
        
        return view('admin.dashboard.appointment.index');
    }


    public function reports(){
         $roles =Role::whereNotIn('id',['1','6','7','8'])->get();;
        $users = User::with(['city','state'])->where('user_catg_id','2')->whereIn('status',['A','C'])->whereNull('parent_id')->orderBy('registration_date','DESC')->get();
        // return $users;
        return view('admin.dashboard.reports.index',compact('users','roles'));
    }
    public function users_reports_filter(Request $request){

        $users = User::with(['city','state'])->where('user_catg_id',$request->user_catg_id)->whereIn('status',['A','C'])->whereNull('parent_id')->orderBy('registration_date','DESC')->get();

        return view('admin.dashboard.reports.table',compact('users'));
    
    }

    public function cause_list(){
        $cause_lists =  CauseList::with(['lawyer_name' => function($query){
            $query->select('name','licence_no');
        }])->whereDate('hearing_date',date('Y-m-d'))->get();
        // return $cause_lists;
        return view('admin.dashboard.cause-list.index',compact('cause_lists'));

    }
    public function cause_list_filter(Request $request){
        // return $request->all();
        $to = $request->start_date;
        $from = $request->end_date;
        $licence_no = $request->licence_no;

        $cause_lists =  CauseList::with(['lawyer_name' => function($query){
            $query->select('name','licence_no');
        }])->whereBetween('hearing_date',[$to,$from])->orderBy('hearing_date','ASC')->get();
        return view('admin.dashboard.cause-list.table',compact('cause_lists'));
    }
    public function importCauseList(Request $request){
        // return $request->all();
        $status = true;
        $errors = array();
        $datas = Excel::toCollection(new CauseListImport,$request->file('file'));
        foreach ($datas as $value) {
            foreach ($value as $data) {
               
                if($data['enroll_no'] !='' && $data['causelist_no'] !='' && $data['case_no'] !='' && $data['case_status'] !='' && $data['petitioner'] !='' && $data['respondent'] !='' && $data['case_info'] !='' && $data['advocate_pet'] != '' && $data['advocate_res'] !='' && $data['hearing_date'] !='' && $data['judge_name'] !='' && $data['type']  !='' && $data['hearing_place'] !=''  && $data['bench'] !=''){
                    
                    $licence_no = User::where('licence_no',$data['enroll_no'])->first();
                    // if(!empty($licence_no)){
                    //     $status = true;
                    // }else{
                    //     $status = false;
                    // }

                    $hearing_date = date('Y-m-d',strtotime($data['hearing_date']));

                    $status = true;
                    
                }else{
                    $status =false;
                }

                if($status == true){
                    $store = [
                        'licence_no'    => $data['enroll_no'],
                        'causelist_no'  => $data['causelist_no'],
                        'case_no'       => $data['case_no'],
                        'cause_status'  => $data['case_status'],
                        'petitioner'    => $data['petitioner'],
                        'respondent'    => $data['respondent'],
                        'case_info'     => $data['case_info'],
                        'advocate_pet'  => $data['advocate_pet'],
                        'advocate_res'  => $data['advocate_res'],
                        'hearing_date'  => $hearing_date,
                        'judge_name'    => $data['judge_name'],
                        'type'          => $data['type'],
                        'hearing_place' => $data['hearing_place'],
                        'bench'         => $data['bench']
                    ];
                   $cause_list =  CauseList::create($store);
                    // $law = User::find($licence_no->id);
                    // $sendData = [
                    //     'id' => $cause_list->id,
                    //     'title' => $data['case_no'].' case next hearing date is '. $hearing_date,
                    //     'url' => 'cause-list',
                    //     'message' => 'case next hearing date.'

                    // ];
                    // $law->notify(new Notifications($sendData));

                    // return $store;
                }else{
                    $errors[] = [
                        'enroll_no'    => $data['enroll_no'],
                        'causelist_no' => $data['causelist_no'],
                        'case_no'      => $data['case_no'],
                        'case_status'  => $data['case_status'],
                        'petitioner'   => $data['petitioner'],
                        'respondent'    => $data['respondent'],
                        'case_info'     => $data['case_info'],
                        'advocate_pet'  => $data['advocate_pet'],
                        'advocate_res'  => $data['advocate_res'],
                        'hearing_date'  => $data['hearing_date'],
                        'judge_name'    => $data['judge_name'],
                        'type'          => $data['type'],
                        'hearing_place' => $data['hearing_place'],
                        'bench'         => $data['bench']
                    ];
                }
                $status = true;
            }            
        }

        if(count($errors) !=0){
            return Excel::download(new CauseListErrorExport($errors), 'cause_list_errors.csv');
        }
        return "success";
    }   

    public function registration(){
    	$users =  User::where('referral_code' ,'!=','')->where(['user_catg_id' => '2','status' => 'A'])->orderBy('updated_at','desc')->get();
    	return view('admin.dashboard.user_registration.index',compact('users'));
    }
    public function registration_create(){
    	$states = State::select('state_code','state_name')->orderBy('state_name')->get();
    	$specs = CatgMast::select('catg_code','catg_desc')->orderBy('catg_desc')->get();

    	$court_types = CourtType::orderBy('court_type')->get();

    	return view('admin.dashboard.user_registration.create',compact('states','court_types','specs'));
    }
    public function registration_store(Request $request){
        if($request->email !=''){
    	   $email = User::where('email',$request->email)->where('status','D')->where('on_database','1')->first();
        }else{
            $email = null;
        }

        if($request->mobile !=''){
            $mobile = User::where('mobile',$request->mobile)->where('status','D')->where('on_database','1')->first();
        }else{
            $mobile = null;
        }
        $id = null;

        if(!empty($email) || !empty($mobile)){
            if(!empty($email)){
                $id = $email->id;
            }else{
                $id = $mobile->id;

            }
        }
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['nullable', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'mobile'        => ['required','string','max:11','min:10', 'unique:users,mobile,'.$id],
            'referral_code' => 'nullable|exists:referrals',
            'gender'        => 'required|not_in:0',
            'licence_no'    => 'required',
            'estd_year'     => 'nullable',
            'address'       => 'required',
            'state_code'    => 'required',
            'city_code'     => 'required',
            'zip_code'      => 'required',
            'about'         => 'nullable|min:40|max:500',
        ]);

        $data  = [
            'name'          => $request->name,
            'email'         => $request->email,
            'mobile'        => $request->mobile,
            'gender'        => $request->gender,
            'licence_no'    => $request->licence_no,
            'referral_code' => $request->referral_code,
            'address'       => $request->address,
            'state_code'    => $request->state_code,
            'city_code'     => $request->city_code,
            'zip_code'      => $request->zip_code,
            'estd_year'     => $request->estd_year,
            'detl_profile'  => $request->about,
            'user_catg_id'  => 2,
            'password'      => Hash::make('password'),
            'email_verified_at'  => date('Y-m-d H:i:s'),
            'mobile_verified_at' => date('Y-m-d H:i:s'),
            'pwd'           => Crypt::encrypt('password'),
            'status'        => 'A'
        ];


        if($request->hasFile('photo')){
            $verify = $request->validate([
                'photo' =>'nullable|image|mimes:jpeg,png,jpg|max:2048' 
            ]);
            $filename = Auth::user()->id.'_profilephoto'.time().'.'.$request->photo->getClientOriginalExtension();
            $image = $request->photo->storeAs('public/profile_photo/', $filename);
            $data['photo'] = $filename;         
        }
        if($id ==null){
            $user =  User::create($data);
        }else{
            $user = User::find($id);
            $user->update($data);
        }
        if($user){
            if(!$user->hasRole('lawyer')){
                $user->attachRole('2');
            }
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
                // if(!$user->hasPermission('lawyer')){
                    $user->attachPermission('6');
                // }

                $user->user_package_id = $user_package->id;
                $user->package_start = $user_package->package_start;
                $user->package_end = $user_package->package_end;
                $user->save();
            }
            Referral::where('referral_code',$data['referral_code'])->increment('summary_count','1');

        }

        if(isset($request->court_code)){
            if(count($request->court_code) !='0'){
                $user->courts()->sync($request->court_code);    
            }
        }

        if(isset($request->specialization)){
            if(count($request->specialization) !='0'){
                $user->specializations()->sync($request->specialization);
            }
        }
        return redirect()->route('registration')->with('success','User Registered Successfully.');
    }
}
