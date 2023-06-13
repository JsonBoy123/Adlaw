<?php

namespace App\Http\Controllers\PMS\Schedule;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Schedule;
use App\Models\ScheduleHistory;
use App\Models\SchedulesDisplay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth; 	
use App\Notifications\ScheduleReminder;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\Helpers\Helpers;
class ScheduleController extends Controller
{
  public function index()
	{


		$id = Auth::user()->id;
		
		if(Auth::user()->parent_id == null){
			$user = User::find($id);				
			$permission = DB::table('permission_user')->where('user_id',$id)->where('permission_id',5)->get();
			if($permission->isEmpty()){ //user permission create schedule when permission is not assign 
				$user->attachPermission(5);	 //5 = create_schedule
			} 	

			//fetch all users for stand alone schedule
			$users = Helpers::get_all_users($id)->get(); 
		 	$users[] =Auth::user();
			$schedules = SchedulesDisplay::where('creator_id' , $id)->orderBy('start')->get();
		
		}else{

			$users = User::where('parent_id', Auth::user()->parent_id)->where('user_catg_id',Auth::user()->user_catg_id)->get();
			$users[] = User::where('id',Auth::user()->parent_id)->first();
			$schedules = SchedulesDisplay::where('creator_id' , Auth::user()->parent_id)->orderBy('start')->get();
		}

		$logged_user = Auth::user();
		
		// $users_list = User::wherePermissionIs('create_schedule')->get();
		// 	return $users_list;

		$create_schedule = $logged_user->can('create_schedule') == 1 ? 'true' : 'false';

		// die;
		return view('pms.schedules.index',compact('users', 'schedules','create_schedule'));
	}

	public function compareByTimeStamp($time1, $time2) 
	{ 
	    if (strtotime($time1) > strtotime($time2)) 
	        return 1;
	    else if (strtotime($time1) < strtotime($time2))  
	        return -1;
	    else
	        return 0;
	}

	public function store(Request $request)
	{

		$startTime = $request->startDate!=null ? $request->startDate.":00" : null;
		$endTime = $request->endDate!=null ?  $request->endDate.":00" : null;
		$remind_start = $request->remind_start!=null ?  $request->remind_start.":00" : null;

		$request->merge([
		    'startTime' => $startTime,
		    'endTime' => $endTime,
		    'remind_startTime' => $remind_start
		]);



		//$asc_dates_array = array((new Carbon($endTime))->isoFormat('YYYY-MM-DD'));

		
		//$notifiers = array(); 
		//dd($request->notifiers);
		//if(!empty($request->notifiers)) {
	  	//	foreach($request->notifiers as $key=>$notifier) {
	  	//		$asc_dates_array[] = $notifier['date'];
	  	//	}
		//}


		// sort array with given user-defined function 
		
	//	$pre_asc_dates_array = $asc_dates_array;
		
		//syntax of usort('array_name','func_name'); but we are in controller we can not create function in functions we call function as $this->name; so for this syntax of usort is given below: 
			// compareByTimeStamp: this () sort array in ascending order and store in same
			//usort($asc_dates_array, array($this, 'compareByTimeStamp')); 			
			
		// return (json_encode($pre_asc_dates_array));

		// date match both dates array matched 
		//if($pre_asc_dates_array != $asc_dates_array)
		//{
		//	return $asc_dates_array;
		//	return "Notifier's end date must be after end date and also in ascending order";
		//}

		$validate = $request->validate([
			'title' => 'required',
			'assignee' => 'required',
			'startTime' => 'required',
			'endTime' => 'required|after:startTime',
			'remind_startTime' => 'required|before:startTime',
			'repeat' => 'required',
			//repeat till date (expiry date) is only required if repeat_type is 2,3,4 (1 for don't repeat)
			// 'repeatTillDate' => 'required_if:repeat.value,2,3,4,5|nullable|after:startTime'
			'repeatTillDate' => 'nullable'
		]);


		// if((new Carbon($startTime))->diffInDays(new Carbon($endTime))>90){
		// 	return "The duration of Schedule must be within 90 days.";
		// }

		if($request->repeat['value'] == 3){	
			if((new Carbon($startTime))->diffInDays(new Carbon($endTime)) % 7 !== 0 ){
				$totalDays = (new Carbon($startTime))->diffInDays(new Carbon($endTime));
				// return response()->json($totalDays,201);
				$addDays   =  7 - intval($totalDays % 7);
				return response()->json("Please add ".$addDays." day more in end date for complete your weekly schedule" , 201);
			}
		}
	
		// Disable 29 feb for repeat schedule on yearly basis
		if($request->repeat['value'] == 5 && (new Carbon($request->startTime))->isoFormat('MM-DD') == '02-29'){
			// return "You can not create repeat schedule on yearly basis with 29 Feb as start date.";
			return response()->json("You can not create repeat schedule on yearly basis with 29 Feb as start date.",201);
		}
		// If schedule are repeating then start and end must be on same day---
		if($request->repeat['value'] != 1)
		{ 
			//1 don't repeat
		
			$startDate = (new Carbon($startTime))->isoFormat('YYYY-MM-DD');
			$endDate = (new Carbon($endTime))->isoFormat('YYYY-MM-DD');
				
			if((new Carbon(date('Y-m-d')))->greaterThan(new Carbon($startDate))){		
				return response()->json("Start date should be greater than and equal to today's date",201);
			}	

			if($request->repeat['value'] != 2){
				if(strtotime($startDate) == strtotime($endDate)){							
					return "Start and end date not be same for repeating schedule";
				}
				else{
					$repeat_time_exceed = $this->check_repeat_period($request->repeat['value'],new Carbon($request->startTime),$request->repeatTillDate);//$request->repeatTillDate);
					if($repeat_time_exceed){
						return $repeat_time_exceed;
					}
				}
			}
		}

		$schedule_id = 0;

	

		DB::transaction(function () use ($validate, $request, &$schedule_id) {
			$users = array();
			if(!empty($request->users)) {
				foreach($request->users as $user) {
					$users[] = $user['id'];
				}
			}

	  		$notifiers = array();
				if(!empty($request->notifiers)) {
	    		foreach($request->notifiers as $key=>$notifier) {
	    			$notifiers[] = array(
	    				// 'date' => $notifier['date'],
	    				'user' => $notifier['user']['id']
	    			);
	    		}
	  		}

  			$schedule = new Schedule();
			$schedule->title = $validate['title'];
	  		$schedule->creator_id = auth()->user()->id;
	  		$schedule->assignee_id = $validate['assignee']['id'];
			$schedule->users = json_encode($users);
			$schedule->notifiers = json_encode($notifiers);
			$schedule->repeat = $validate['repeat']['value'];
	  		$schedule->description = $request->description;
	  		$schedule->start = $validate['startTime'];
	  		$schedule->reminder_start = $validate['remind_startTime'];
	  		$schedule->end = $validate['endTime'];
	  		$schedule->expiry_date = $validate['repeat']['value'] != 1 ? $validate['repeatTillDate'] : null;
	  		$schedule->save();

	  // 		// Update the schedule ID value if the DB transaction is completed
			$schedule_id = $schedule->id;

	  	//  $this->insert_schedules_displays($request->startTime,$request->repeat['value'],$request->repeatTillDate,$schedule,$validate['startTime'],$validate['endTime']);
	  	// });
	  	
		$this->insert_schedules_displays($request->startTime,$request->repeat['value'],$request->repeatTillDate,$schedule,$validate['startTime'],$validate['endTime'],$validate['remind_startTime'],$request->notifiers);
		});	


	  	if($schedule_id != 0){
	  		if(Auth::user()->parent_id == null){
				$schedules = SchedulesDisplay::where('creator_id' , Auth::user()->id)->orderBy('start')->get();		  
			}else{
				$schedules = SchedulesDisplay::where('creator_id' , Auth::user()->parent_id)->orderBy('start')->get();
			}
	  		return response()->json($schedules,201);
		}
	  	

	}

	public function show($id)
  {
    $schedule = SchedulesDisplay::where('id',$id)->first();
  	return response()->json($schedule, 200);
  }

	// Entries in schedules_displays based upon start end & repeat type
  // public function insert_schedules_displays($start_time, $repeat_type, $repeat_till_date, $schedule, $validate_start, $validate_end) {
    public function insert_schedules_displays($start_time, $repeat_type, $repeat_till_date, $schedule, 					$validate_start, $validate_end,$remind_start,$notifierArray) {
		$startTimeCarbon = new Carbon((new Carbon($start_time))->isoFormat('YYYY-MM-DD'));
		$remindTimeCarbon = new Carbon((new Carbon($remind_start))->isoFormat('YYYY-MM-DD'));
		$reminder_data = '';


		if($repeat_type == 2 || $repeat_type == 3 || $repeat_type == 5){
			$add_time=$add_days='';
			switch($repeat_type){
				case 2: //repeat every day
					$add_time = 'addDays';
					$add_days = 1;  
				break;
				case 3: //repeat every week
					$add_time = 'addDays';
					$add_days = 7;
				break;
				case 5: //repeat every year
					$add_time = 'addYears';
					$add_days = 1;
				break;
			}                                                                //$repeat_till_date 
			for ($i=$startTimeCarbon; strtotime($startTimeCarbon)<=strtotime($validate_end ); $i=$i->$add_time($add_days))
			{


				if($repeat_type === 3 || $repeat_type === 5){ //Increase Reminder date every week, year, month wise 
					for ($j=$remindTimeCarbon; strtotime($remindTimeCarbon)<=strtotime($validate_end); $j=$j->$add_time($add_days))
					{
						if(strtotime($startTimeCarbon) > strtotime($remindTimeCarbon)){
							$reminder_data = date('Y-m-d',strtotime($remindTimeCarbon))." ".(explode(' ',$validate_end))[1];			
						}
						else{
							break;
						}
					}	
				}
				else{
					$reminder_data = $remind_start;
				}

				$notifiers = array();				
				if($repeat_type){
					if(!empty($notifierArray)) {
						$count = 1;
						foreach($notifierArray as $key=>$notifier) {					
							$mydate =  new Carbon((new Carbon($startTimeCarbon))->isoFormat('YYYY-MM-DD'));
							$mydate = $mydate->addDay($count);
							$notifiers[] = array(
								'date' => date('Y-m-d',strtotime($mydate)).' 10:00:00',
								'user' => !empty($notifier['user']['id'])? $notifier['user']['id'] :$notifier['user'][0]['id']
							);
							$count +=1;
						}
					}
					$count = 1;
				}



				$scheduleDisplay = new SchedulesDisplay();
				$scheduleDisplay->schedule_id = $schedule->id;
				$scheduleDisplay->title = $schedule->title;
				$scheduleDisplay->start = date('Y-m-d',strtotime($startTimeCarbon)).' 10:00:00';
				//(explode(' ',$validate_start))[1];
		  		$scheduleDisplay->end = date('Y-m-d',strtotime($startTimeCarbon)).' 23:55:00';
		  		//(explode(' ',$validate_end))[1];
		  		$scheduleDisplay->notifiers = json_encode($notifiers);

				$scheduleDisplay->date = $startTimeCarbon;
				$scheduleDisplay->assignee_id = $schedule->assignee_id;
				$scheduleDisplay->users = $schedule->users;
				$scheduleDisplay->description = $schedule->description;
				// $scheduleDisplay->reminder_start = $schedule->reminder_start;
				$scheduleDisplay->reminder_start = $reminder_data;
				// $scheduleDisplay->workspace_id = $schedule->workspace_id;
				$scheduleDisplay->creator_id = $schedule->creator_id;

				$scheduleDisplay->next_notify = date('Y-m-d',strtotime($startTimeCarbon));
				$scheduleDisplay->save();
			}
		} else {
				if($repeat_type==4) { //2 for Every month Repeat
					while(strtotime($startTimeCarbon)<=strtotime($validate_end)){
							$tempDateArray = explode('-',(explode(' ',$startTimeCarbon))[0]);

							$notifiers = array();				
							if($repeat_type != 2){
								if(!empty($notifierArray)) {
									$count = 1;
									foreach($notifierArray as $key=>$notifier) {					
										$mydate =  new Carbon((new Carbon($startTimeCarbon))->isoFormat('YYYY-MM-DD'));
										$mydate = $mydate->addDay($count);
										$notifiers[] = array(
											'date' => date('Y-m-d',strtotime($mydate)).' 10:00:00',
											'user' => !empty($notifier['user']['id'])? $notifier['user']['id'] :$notifier['user'][0]['id']
										);
										$count +=1;
									}
								}
								$count = 1;
							}


							//1 - month, 0-year, 2- day
							if(checkdate($tempDateArray[1],$tempDateArray[2],$tempDateArray[0])){
								$insertDate = date('Y-m-d',strtotime(implode('-',$tempDateArray)));
								$scheduleDisplay = new SchedulesDisplay();
			  				$scheduleDisplay->schedule_id = $schedule->id;
			  				$scheduleDisplay->title = $schedule->title;
			  				$scheduleDisplay->start = $insertDate." 10:00:00";//(explode(' ',$validate_start))[1];
			  				$scheduleDisplay->end = $insertDate." 23:55:00";//.(explode(' ',$validate_end))[1];
			  				$scheduleDisplay->date = $insertDate; 

								$scheduleDisplay->notifiers = json_encode($notifiers);

								$scheduleDisplay->assignee_id = $schedule->assignee_id;							
								$scheduleDisplay->users = $schedule->users;
								$scheduleDisplay->description = $schedule->description;
			  				$scheduleDisplay->reminder_start = $schedule->reminder_start;
								// $scheduleDisplay->workspace_id = $schedule->workspace_id;
								$scheduleDisplay->creator_id = $schedule->creator_id;
								$scheduleDisplay->next_notify = $insertDate;
								$scheduleDisplay->save();
							}
							if($tempDateArray[1]==12){
								//eg inserted date is 12 dec 2018 then we have to update month to jan and year to 2019
								$tempDateArray[1]=1; //set month to jan
								$tempDateArray[0]=$tempDateArray[0]+1; //increment of year by 1
							}else{
								//other than dec no need to update year
								$tempDateArray[1]=$tempDateArray[1]+1;
							}
							//updated date-- to execute while loop
						$startTimeCarbon= implode('-',$tempDateArray);
					}
				}else if($repeat_type==1) { //1 don't repeat

						$notifiers = array();				
						if($repeat_type != 2){
							if(!empty($notifierArray)) {
								$count = 1;
								foreach($notifierArray as $key=>$notifier) {					
									$mydate =  new Carbon((new Carbon($startTimeCarbon))->isoFormat('YYYY-MM-DD'));
									$mydate = $mydate->addDay($count);
									$notifiers[] = array(
										'date' => date('Y-m-d',strtotime($mydate)).' 10:00:00',
										'user' => !empty($notifier['user']['id'])? $notifier['user']['id'] :$notifier['user'][0]['id']
									);
									$count +=1;
								}
							}
							$count = 1;
						}


						$scheduleDisplay = new SchedulesDisplay();
						$scheduleDisplay->schedule_id = $schedule->id;

						$scheduleDisplay->notifiers = json_encode($notifiers);
						$scheduleDisplay->next_notify = $validate_start;

						$scheduleDisplay->title = $schedule->title;
						$scheduleDisplay->start = $validate_start;
						$scheduleDisplay->end = $validate_end;
						$scheduleDisplay->date = $startTimeCarbon;
						$scheduleDisplay->assignee_id = $schedule->assignee_id;
						$scheduleDisplay->users = $schedule->users;
						$scheduleDisplay->description = $schedule->description;
						$scheduleDisplay->reminder_start = $schedule->reminder_start;
						// $scheduleDisplay->workspace_id = $schedule->workspace_id;
						$scheduleDisplay->creator_id = $schedule->creator_id;
						$scheduleDisplay->save();
				}
		}
  }

	// Check repeat type , start and end . end must be within particular no. of year from start depends upon repeat type
  public function check_repeat_period ($repeat_type, $start, $end) 
  {
  	switch ($repeat_type) {
	    case 2: //every Day
	   			$start = ($start->addYears(1))->isoFormat('YYYY-MM-DD HH:mm:ss');
    			if (strtotime($start)<strtotime($end)) {
						return "If you are repeating schedule on every day basis then Max Repeat must be under one year.";
    			}
	        break;
	    case 3: //every Week
	        $start = ($start->addYears(2))->isoFormat('YYYY-MM-DD HH:mm:ss');
    			if (strtotime($start)<strtotime($end)) {
						return "If you are repeating schedule on every Week basis then Max Repeat must be under Two year.";
    			}
	        break;
	    case 4: //every Month 
	        $start = ($start->addYears(5))->isoFormat('YYYY-MM-DD HH:mm:ss');
    			if (strtotime($start)<strtotime($end)) {
						return "If you are repeating schedule on every Month basis then Max Repeat must be under Five year.";
    			}
	        break;
	    case 5: //every Year
	        $start = ($start->addYears(10))->isoFormat('YYYY-MM-DD HH:mm:ss');
    			if (strtotime($start)<strtotime($end)) {
						return "If you are repeating schedule on every Year basis then Max Repeat must be under Ten year.";
    			}
	        break;
		}
  	
  }

  public function takeAction(Request $request, $id)
  {
  	$request->validate([
  		'action' => 'required | in:complete,discard'
  	]);

  	$display = SchedulesDisplay::find($id);

  	$display->action_type = $request->action;
  	$display->action_time = date('Y-m-d H:i:s');

  	if($display->update()){
  		if(Auth::user()->parent_id == null){
			$schedules = SchedulesDisplay::where('creator_id' , Auth::user()->id)->orderBy('start')->get();		  
		}else{
			$schedules = SchedulesDisplay::where('creator_id' , Auth::user()->parent_id)->orderBy('start')->get();
		}
  		return response()->json($schedules,201);
  	}
	}
	
	public function getSchdule(Request $request){
		$data = Schedule::find($request->id);
		return response()->json($data, 200);
	}

	public function updateSchedule(Request $request,$ids){


		$startTime = $request->startDate!=null ? $request->startDate.":00" : null;
		$endTime = $request->endDate!=null ?  $request->endDate.":00" : null;
		$remind_start = $request->remind_start!=null ?  $request->remind_start.":00" : null;

		$request->merge([
		    'startTime' => $startTime,
		    'endTime' => $endTime,
		    'remind_startTime' => $remind_start
		]);


		//$asc_dates_array = array((new Carbon($endTime))->isoFormat('YYYY-MM-DD'));

		
		//$notifiers = array(); 
		//dd($request->notifiers);
		//if(!empty($request->notifiers)) {
	  //		foreach($request->notifiers as $key=>$notifier) {
	  	//		$asc_dates_array[] = $notifier['date'];
	  	//	}
		//}


		// sort array with given user-defined function 
		
		//$pre_asc_dates_array = $asc_dates_array;
		
		//syntax of usort('array_name','func_name'); but we are in controller we can not create function in functions we call function as $this->name; so for this syntax of usort is given below: 
			// compareByTimeStamp: this () sort array in ascending order and store in same
			//usort($asc_dates_array, array($this, 'compareByTimeStamp')); 			
			
		// return (json_encode($pre_asc_dates_array));

		// date match both dates array matched 
	//	if($pre_asc_dates_array != $asc_dates_array)
	//	{
		//	return $asc_dates_array;
	//		return "Notifier's end date must be after end date and also in ascending order";
	//	}

		$validate = $request->validate([
			'title' => 'required',
			'assignee' => 'required',
			'startTime' => 'required',
			'endTime' => 'required|after:startTime',
			'remind_startTime' => 'required|before:startTime',
			'repeat' => 'required',
			//repeat till date (expiry date) is only required if repeat_type is 2,3,4 (1 for don't repeat)
			// 'repeatTillDate' => 'required_if:repeat.value,2,3,4,5|nullable|after:startTime'
			'repeatTillDate' => 'nullable'
		]);


		// if((new Carbon($startTime))->diffInDays(new Carbon($endTime))>90){
		// 	return "The duration of Schedule must be within 90 days.";
		// }
	
		// Disable 29 feb for repeat schedule on yearly basis
		$repeatValue = !empty($request->repeat[0]['value']) ? $request->repeat[0]['value'] : $request->repeat['value'];


		if($repeatValue == 5 && (new Carbon($request->startTime))->isoFormat('MM-DD') == '02-29'){
			return "You can not create repeat schedule on yearly basis with 29 Feb as start date.";
		}
		// If schedule are repeating then start and end must be on same day---
		if($repeatValue != 1)
		{ 
			//1 don't repeat
		
			$startDate = (new Carbon($startTime))->isoFormat('YYYY-MM-DD');
			$endDate = (new Carbon($endTime))->isoFormat('YYYY-MM-DD');
			
			if(strtotime($startDate) == strtotime($endDate)){							
				return "Start and end date not be same for repeating schedule";
			}else{
				$repeat_time_exceed = $this->check_repeat_period($request->repeat['value'],new Carbon($request->startTime),$request->repeatTillDate);//$request->repeatTillDate);
				if($repeat_time_exceed){
					return $repeat_time_exceed;
				}
			}
		}

		$schedule_id = 0;
		$validate['ids'] = $ids;
		$validate['repeatValue'] = $request->repeat['value'];

				// return $request->all();
  	DB::transaction(function () use ($validate, $request, & $schedule_id) {
  		$users = array();
  		if(!empty($request->users)) {
    		foreach($request->users as $user) {
    			$users[] = $user['id'];
    		}
  		}
  		$notifiers = array();
			if(!empty($request->notifiers)) {
	    		foreach($request->notifiers as $key=>$notifier) {
						$userId = !empty($notifier['user'][0]['id']) ? $notifier['user'][0]['id']:$notifier['user']['id'];
	    			$notifiers[] = array(
	    				// 'date' => $notifier['date'],
	    				'user' => $userId
	    			);
	    		}
			}
			
  		$schedule = Schedule::find($validate['ids']);
	
		$schedule->title = $validate['title'];
  		$schedule->creator_id = auth()->user()->id;
  		$schedule->assignee_id = $validate['assignee'][0]['id'];
		$schedule->users = json_encode($users);
		$schedule->notifiers = json_encode($notifiers);
		$schedule->repeat = $validate['repeatValue'];
  		$schedule->description = $request->description;
  		$schedule->start = $validate['startTime'];
  		$schedule->reminder_start = $validate['remind_startTime'];
  		$schedule->end = $validate['endTime'];
  		// $schedule->workspace_id = auth()->user()->workspace_id;
  		$schedule->expiry_date = $validate['endTime']; $validate['repeatValue'] != 1 ? $validate['repeatTillDate'] : null;
  		$schedule->save();

  		// Update the schedule ID value if the DB transaction is completed
  		$schedule_id = $schedule->id;

		SchedulesDisplay::where('schedule_id',$schedule_id)->delete();

  		// $this->insert_schedules_displays($request->startTime,$validate['repeatValue'],$request->repeatTillDate,$schedule,$validate['startTime'],$validate['endTime']);

		$this->insert_schedules_displays($request->startTime,$validate['repeatValue'],$request->repeatTillDate,$schedule,$validate['startTime'],$validate['endTime'],$validate['remind_startTime'],$request->notifiers);
				
	  	});
  		if($schedule_id != 0){
	  		if(Auth::user()->parent_id == null){
				$schedules = SchedulesDisplay::where('creator_id' , Auth::user()->id)->orderBy('start')->get();		  
			}else{
				$schedules = SchedulesDisplay::where('creator_id' , Auth::user()->parent_id)->orderBy('start')->get();
			}
	  		return response()->json($schedules,201);
		}
	  	

  	// if($schedule_id != 0){
  	// 	$schedule = Schedule::where('id',$schedule_id)->first();
  	// 	return response()->json($schedule,201);
  	// }
	}
	// public function display_reminder(){
	// //	$users = User::find(Auth::user()->id);

	// 	$schedules = Schedule::all();
	// 	return $schedules;

	// 	// return $users;
	// 	$data['link'] = 'www.google.com';
	// 	$data['message'] = 'testing';
	// 	$data['class'] = 'alert-warning';
	// 	// Notification::send($users, new ScheduleReminder($data));

	// //	$users->notify(new ScheduleReminder($data));
	// }

	public function display_reminder(){
		
		$scheduleData      = SchedulesDisplay::where('reminder_start',date('Y-m-d'))->get();
		$scheduleStartData = SchedulesDisplay::where('start',date('Y-m-d'))->get();
	  $date              = new Carbon(date('Y-m-d'));
		$newDate           = date('Y-m-d',strtotime($date->addDay(1)));	 
		$subDay            = date('Y-m-d',strtotime($date->subDays(2)));
		$scheduleNotifie   = SchedulesDisplay::where('next_notify',$subDay.' 10:00:00')->get();	

		// return $scheduleNotifie;
	// this loop for reminder day notification
		foreach($scheduleData as $schedule){			
			if(strtotime(date('Y-m-d')) < strtotime($schedule->start)){
				  $users = User::whereIn('id', json_decode($schedule->users))->get();
					$data['link'] = url('/').'/pms/schedule/';
					$data['message'] = 'Your Upcoming Event on '.$schedule->start;
					$data['class'] = 'alert-warning';
					Notification::send($users, new ScheduleReminder($data));
					SchedulesDisplay::where('id',$schedule->id)->update(['reminder_start'=>$newDate]);
			}
		}
// this loop for schedule day notification
		foreach($scheduleStartData as $startDate){
			if(strtotime(date('Y-m-d')) == strtotime($startSate->start)){
				$users = User::whereIn('id', json_decode($startSate->users))->get();
				$data['link'] = url('/').'/pms/schedule/';
				$data['message'] = 'Your Upcoming Event id Today';
				$data['class'] = 'alert-warning';
				Notification::send($users, new ScheduleReminder($data));
			}
		}			

		foreach($scheduleNotifie as $notifie){
			$datas[] =  json_decode($notifie->notifiers);			
			$ids   = [];
			$dates = [];
			$user  = json_decode($notifie->users);
			$allUsers = '';
			
			// foreach($user as $users){
			// 	$singleUser = User::find($users);
			//   $allUsers .=$singleUser->name.',' ;	
			// }		
			foreach($datas as $Data){
				foreach($Data as $allData){
				if(date('Y-m-d').' 10:00:00' == $allData->date){
						$ids[]= $allData->user;
						$dates[] = $allData->date;
					}
				}				
			}
			// return $dates;
			if(in_array(date('Y-m-d').' 10:00:00',$dates) && $notifie->action_type !='complete'){			
				// return $notifie;
				$data['info'] = $notifie;
				$data['message'] = "Schedule '".$notifie->title."' missed of date ".$subDay." please check." ;
				$data['link'] = url('/').'/pms/schedule/';
				$data['class'] =  'fe fe-calendar';
				$data['creator'] = User::find($notifie->creator_id);				
				$userData = User::whereIn('id',$ids)->get();			
				Notification::send($userData, new ScheduleReminder($data));
				Mail::to($userData)->send(new ScheduleReminderMail($data));
				SchedulesDisplay::where('id',$notifie->id)->update(['next_notify'=>$newDate.' 10:00:00']);
				$datas = [];
			
			}
			
		}
	}


	public function destroy($id){

		$Schedules = SchedulesDisplay::find($id);
		$schedule_id = $Schedules->schedule_id;
		$scheduleCount = SchedulesDisplay::where('schedule_id',$schedule_id)->where('deleted_at',NULL)->get()->count();
		
		// return $scheduleCount;
		SchedulesDisplay::where('id',$id)->delete();
		if($scheduleCount == 1){
			Schedule::where('id',$schedule_id)->delete();
		};

		if(Auth::user()->parent_id == null){
			$schedules = SchedulesDisplay::where('creator_id' , Auth::user()->id)->orderBy('start')->get();		  
		}else{
			$schedules = SchedulesDisplay::where('creator_id' , Auth::user()->parent_id)->orderBy('start')->get();
		}
	  	return response()->json($schedules,201);

	// 	$schedulesc = SchedulesDisplay::where('deleted_at',NULL)->orderBy('start')->get();
	// 	return response()->json($schedulesc, 201);
	 }
	public function allSchedule(){
		$schedulesc = SchedulesDisplay::where('deleted_at',NULL)->orderBy('start')->get();
			return response()->json($schedulesc, 200);
	}

}
