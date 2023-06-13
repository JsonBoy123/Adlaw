<?php 
namespace App\Helpers;

use Auth;
use App\Models\Customer;
use App\User;
use App\Models\CaseMast;
use App\Models\CourtMastHeader;
use App\Models\Todo;
use Carbon\Carbon;
use App\Models\AcademicCalendarMast;
use App\Models\PackageModule;
use App\Models\UserPackage;
class Helpers 
{
	public static function deletedClients(){
		$id = Auth::user()->id;
		$client_datas  = Customer::onlyTrashed()->where('user_id',$id)->get();
		$client_ids = array();

		foreach($client_datas as $client_data){
			$client_ids[] = $client_data->cust_id;
		}
		return $client_ids;
	}
	public static function bytesToHuman($bytes)
	{
	    $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

	    for ($i = 0; $bytes > 1024; $i++) {
	        $bytes /= 1024;
	    }

	    return round($bytes, 2) ;
	}
	public static function lawyerDetails($court_id , $speciality_code, $city_code = null){
		$query = User::with(['reviews'=>function ($query) {
			           $query->where('review_status','A');
			        }])->with('city', 'state','slots')			        
			        ->whereIn('status',['A','D'])
			        ->where('user_catg_id',2)
			        ->whereNull('parent_id');

		if($court_id !=null){
			$courts_code = CourtMastHeader::select('court_code')->where('court_type',$court_id)->where('city_code',$city_code)->get();
		}
			        
		if($court_id != 0 && $speciality_code !=0){
			
			$result = $query->with(['specialities'=>function($query) use($speciality_code){
                          $query->with('specialization_catgs')->where('user_specialization.catg_code',$speciality_code);
                        }])->with(['user_courts'=>function($query) use($courts_code){
                          $query->with('court_catg')->whereIn('user_courts.court_code',$courts_code->toArray());
                        }]);
		}
		else if ($court_id !=0) {
			$result = $query->with(['specialities'=>function($query){
			          		$query->with('specialization_catgs');
			       		}])->with(['user_courts'=>function($query) use($courts_code){
                          $query->with('court_catg')->whereIn('user_courts.court_code',$courts_code->toArray());
                        }]);
		}
		else if($speciality_code !=0){
			$result = $query->with(['specialities'=>function($query) use($speciality_code){
                          	$query->with('specialization_catgs')->where('user_specialization.catg_code',$speciality_code);
                        }])->with('user_courts.court_catg');
		}
		else{
			$result = $query->with(['specialities'=>function($query){
			          	$query->with('specialization_catgs');
			           }])->with(['user_courts'=>function($query){
			          			$query->with('court_catg');
			        }]);
		}
			
			        
        return $result;
	}
	
	public static function lawcompanyDetails($court_id = null,$city_code = null){
		return $query = User::with(['reviews'=>function ($query) {
			           $query->where('review_status','A');
			        }])
					->with('city', 'state')			        
			        ->where('status','A')
			        ->where('user_catg_id',3);

		if($court_id !=null){
			$courts_code = CourtMastHeader::select('court_code')->where('court_type',$court_id)->where('city_code',$city_code)->get();
		}	        

		if($court_id == null){
			$result = $query->with(['user_courts'=>function($query){
			          	 $query->with('court_catg');
			        }]);
		}else{
			$result = $query->with(['user_courts'=>function($query) use($courts_code){
                          $query->with('court_catg')->whereIn('user_courts.court_code',$courts_code->toArray());
                        }]);
		}
			      
		return $result;
	}
	public static function lawschools(){
		$query = User::with(['reviews'=>function ($query) {
		            $query->where('review_status','A');
		    }])->with('city', 'state')
		    ->where('user_catg_id',4)
		    ->where('status','A');
		return $query;
	}


	public static function valid_email($email) {
         return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
    }
	
	public static function isIfscCodeValid($ifsc_code){
	     return (!preg_match("/^[A-Za-z]{4}0[A-Z0-9]{6}$/", $ifsc_code)) ? FALSE : TRUE;
	}
	public static function cases($del_client){
		$query = CaseMast::with('casetype','client')                 
                        ->whereNotIn('cust_id',$del_client);
      
        return $query;
	}	
	public static function user_all_todos(){
		  $query = Todo::with(['created_user' => function($query){
                 $query->select('id','name');
            },'todos_comments'])->with(['assigned_user' => function($query){
                 $query->select('id','name');
            }])->with(['relate_to_case'=>function($query){
            	$query->select('case_id','case_title');
            }]);
            return $query;
	}

	public static function filter_student($students, $status){
    	return collect($students)->filter(function($e) use($status){
    			return $e['status'] == $status;
    	});
    }
    public static function get_all_users($id){ //parent_id_null
    	$user = User::find($id);
		$users = User::where('parent_id',$id)->orderBy('name', 'asc');
		if($user->user_catg_id == '4'){
			$users = $users->where('user_catg_id','6');
		}
        else if($user->user_catg_id == '3' || $user->user_catg_id == '2'){
			$users = $users->where('user_catg_id','2');
     
        }else{
			$users = $users->where('user_catg_id','5');
        }
        return $users;
    } 

    public static function user_package_check(){
    	$moduleShow = false;
		$package_id = Auth::user()->user_package_id;
		$beforeDate = '';
		$packageModules = array();
		if($package_id != '' ){
	        $today = date('Y-m-d');
	    	$package_end = Auth::user()->package_end;
	 		$beforeDate = date('Y-m-d', strtotime(Auth::user()->package_end.'-16 days'));
	        $end_date = date('Y-m-d',strtotime(Auth::user()->package_end));
	        $pak_id = UserPackage::where('id',$package_id)->pluck('package_id');
	        $packageModules = PackageModule::whereIn('package_id',$pak_id)->pluck('module_id')->toArray();
	        if(strtotime($today) <= strtotime($end_date)){
	           $moduleShow = true;
	        }
	    }

	    return ['moduleShow' => $moduleShow, 'beforeDate' => $beforeDate, 'packageModules' => $packageModules];
    }

    public static function date_diff($package_end){

    	$package_end = new Carbon($package_end);
		$now = Carbon::now();

		$difference = ($package_end->diff($now)->days <= 0)
			    ? 'Today'
			    : $package_end->diffForHumans($now);

			$str_arr =array();
		if($difference != 'Today'){
		   $str_arr = explode(" ",$difference);
		}   

		return ['difference' => $difference, 'str_arr' => $str_arr];

    }
    public static function package_end_date($package){
    	$start_date = Carbon::now();
        if($package->duration_type == 'day'){
            $end_date = $start_date->addDays($package->duration);
        }elseif($package->duration_type == 'month'){
            $end_date = $start_date->addMonths($package->duration);

        }elseif($package->duration_type == 'year'){
            $end_date = $start_date->addYears($package->duration);
        }
        return $end_date->format('Y-m-d');
    }
    public static function student_fetch(){

    }
    public static function academic_dates($month,$year,$weekendDays = ['Sunday']){

    	 $calendarData = AcademicCalendarMast::whereYear('date_from',$year)
                        ->whereMonth('date_from',$month)
                        ->whereYear('date_upto',$year)
                        ->whereMonth('date_upto',$month)
                        ->where('user_id', Auth::user()->id)
                        ->get();

        $academic_dates = array();
        foreach ($calendarData as $key => $value) {
           for($date = $value->date_from->copy() ; $date->lte($value->date_upto); $date->addDay()){
                if(!in_array($date->dayName, $weekendDays)){
                    $symbol = 'H';
                    if($value->is_exam == '1'){
                        $symbol = 'E';
                    }
                    $academic_dates[$date->format('Y-m-d')]= $symbol;
                }
           }
        }
        return $academic_dates;
    }

    public static function month_dates($monthStart,$monthEnd,$weekendDays = ['Sunday']){
    	$monthDates = array();
    	  for($date =$monthStart; $date->lte($monthEnd) ; $date->addDay() ){
            $weekend = 0;
            if(in_array($date->dayName, $weekendDays)){
                $weekend = 1;
            }
            $monthDates[$date->format('Y-m-d')] = [
                'day' =>  intval($date->format('d')),
                'weekend' => $weekend
            ];
        }	
        return $monthDates;
    }

    public static function date_convert($date){
    	$year = date('Y',strtotime($date));
    }
}
