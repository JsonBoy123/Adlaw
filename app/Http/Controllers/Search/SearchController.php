<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Askedio\Laravel5ProfanityFilter\ProfanityFilter;
use Auth;
use App\User;
use App\Models\CatgMast;
use App\Models\Court;
use App\Models\State;
use App\Models\City;
use App\Models\CourtMast;
use App\Models\CourtMastHeader;
use App\Helpers\Helpers;
use App\Models\Slots;
use App\Models\Specialization;
use App\Models\Review;
use App\Models\Status;
use Carbon\Carbon;
class SearchController extends Controller
{
  public function __construct(){
      $court_id = 0;
      $speciality_code = 0;
      $this->query  = Helpers::lawyerDetails($court_id,$speciality_code);
  }
    public function lawfirms(){
       // User::find('')

      $searchfield = 'lawyer';
      $specialities = CatgMast::all();
      $courts = CourtMast::all();
      $states = State::all();
      $slots = Slots::all();



      // start 7 days date fetch
    $curr_date = date("m/d/Y");
    $ts = strtotime($curr_date);
    $year = date('o', $ts);
    $week = date('W', $ts);
    $date = array();

    for($i = 1; $i <= 7; $i++) {
      $ts = strtotime($year.'W'.$week.$i);
      $date[] =  date("Y-m-d",$ts);
    }
    //end

    $day = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];

    $days = array_combine($day, $date); //date to days wise indexing 
    if(request()->all() != null){
        $name = request()->search;
        $lawyers =  $this->query->where('name', 'like', '%' . request()->search . '%')->paginate(6);
    }else{
      $name = request()->search;
      $lawyers =  $this->query->where('name',' ')->paginate(6);
    }
    

    // return collect($lawyers)->filter(function($e) {
    //  return $e['state_code'] == '20';
    // });

      return  view('pages.subpages.guest_features',
        compact('searchfield','specialities','courts','states','lawyers','days','slots','name')
      );
    }

    public function lawfirmsSearch(Request $request){
        
      $speciality_code = $request->speciality;
      $state_code = $request->state_code;
      $city_code = $request->city_code;
      $searchfield =  $request->searchfield;
      $gender = $request->gender;
      $court_id = $request->court_id;
      $user_name = $request->user_name;

  
      $courts_types = CourtMastHeader::select('court_code')->where('court_type',$court_id)->where('city_code', $city_code)->get();
      $courts_details = Court::whereIn('court_code',$courts_types->toArray())->get();
      $user_ids1 =array();
      foreach($courts_details as $courts_detail){
         $user_ids1[]=$courts_detail->user_id;  
      }
   
  if($searchfield == 'lawyer'){
    $lawyers = $this->query;
      

    if($speciality_code !=0){
      if($court_id !=0){
        $lawyers = Helpers::lawyerDetails($court_id, $speciality_code,$city_code)->whereIn('id',$user_ids1)
                        ->whereIn('id',$user_ids);
      }else{
        $lawyers = Helpers::lawyerDetails($court_id=0, $speciality_code)->whereIn('id',$user_ids);

      }
    }
    else{
      if($court_id !=0){
          $lawyers = Helpers::lawyerDetails($court_id, $speciality_code=0,$city_code)->whereIn('id',$user_ids1);
      }
    }

    if($user_name !=''){
        $lawyers = $lawyers->where('name', 'LIKE', '%' .$user_name. '%');
    }
    if($gender != 'all'){
      $lawyers = $lawyers->where('users.gender',$gender);
    }
























  //   if($speciality_code == 0){ 
  //      if($court_id == '0'){     
  //         if($gender == 'all'){
  //           if($city_code == 0){
  //             if($state_code == 0 ){

  //                $lawyers = $this->query;
                          
  //             }
  //             else if($state_code !=0){

  //               $lawyers = $this->query->where('users.state_code',$state_code);

  //             }
  //           }
  //           else if($city_code !=0){
  //             $lawyers = $this->query->where('users.state_code',$state_code)
  //                                   ->where('users.city_code',$city_code);
  //           }
            
  //         }
  //         else if($gender != 'all'){
  //           if($city_code ==0){
  //             if($state_code == 0 ){
  //              $lawyers = $this->query->where('users.gender',$gender);
                          

  //             }
  //             else if($state_code !=0){
  //               $lawyers = $this->query->where('users.state_code',$state_code)
  //                         ->where('users.gender',$gender);
  //             }
  //           }
  //           else if($city_code !=0){
  //             $lawyers = $this->query->where('users.state_code',$state_code)
  //                         ->where('users.city_code',$city_code)
  //                         ->where('users.gender',$gender);
  //           }
  //         }         
  //       }
  //       else if($court_id != '0'){
  //         $this->query  = Helpers::lawyerDetails($court_id, $speciality_code=0);
  //       if($gender == 'all'){
  //         if($city_code ==0){
  //           if($state_code == 0 ){

              
  //            $lawyers = $this->query->whereIn('id',$user_ids1);
                    
                        
  //           }
  //           else if($state_code !=0){
              
  //             $lawyers =  $this->query->where('users.state_code',$state_code)
  //                       ->whereIn('id',$user_ids1);
                       

  //           }
  //         }
  //         else if($city_code !=0){
  //           $lawyers = $this->query->where('users.state_code',$state_code)
  //                       ->where('users.city_code',$city_code)
  //                       ->whereIn('id',$user_ids1);
  //         }
          
  //       }
  //       else if($gender != 'all'){
  //         if($city_code ==0){
  //           if($state_code == 0 ){
  //            $lawyers = $this->query->where('users.gender',$gender)
  //                       ->whereIn('id',$user_ids1);

  //           }
  //           else if($state_code !=0){

  //             $lawyers = $this->query->where('users.state_code',$state_code)
  //                       ->where('users.gender',$gender)
  //                       ->whereIn('id',$user_ids1);
  //           }
  //         }
  //         else if($city_code !=0){
  //           $lawyers =$this->query->where('users.state_code',$state_code)
  //                       ->where('users.city_code',$city_code)
  //                       ->where('users.gender',$gender)
  //                       ->whereIn('id',$user_ids1);
  //         }
  //       }

  //     }
  //   }
  //   else if($speciality_code != 0){
  //     if($court_id == 0){
  //       $this->query  = Helpers::lawyerDetails($court_id=0, $speciality_code);
  //       if($gender=='all'){
  //         if($city_code == 0){
  //            if($state_code == 0 ){           

  //              $lawyers = $this->query->whereIn('id',$user_ids);

  //           }
  //           else if($state_code !=0){

  //             $lawyers = $this->query->where('users.state_code',$state_code)
  //                       ->whereIn('id',$user_ids);

  //           }

  //         }
  //         else if($city_code !=0){
  //           $lawyers = $this->query->where('users.state_code',$state_code)
  //                       ->where('users.city_code',$city_code)
  //                       ->whereIn('id',$user_ids);
  //         }
  //       }
  //       else if($gender !='all'){
  //         if($city_code ==0){
  //           if($state_code == 0 ){
  //                $lawyers = $this->query->where('users.gender',$gender)
  //                       ->whereIn('id',$user_ids);

  //           }
  //           else if($state_code !=0){

  //             $lawyers = $this->query->where('users.state_code',$state_code)
  //                       ->where('users.gender',$gender)
  //                       ->whereIn('id',$user_ids);

  //           }
  //         }
  //         else if($city_code !=0){
  //           $lawyers = $this->query->where('users.state_code',$state_code)
  //                       ->where('users.city_code',$city_code)
  //                       ->where('users.gender',$gender)
  //                       ->whereIn('id',$user_ids);
  //         }
  //       }
  //     }
  //     else if($court_id !=0 ){
  //       $this->query  = Helpers::lawyerDetails($court_id, $speciality_code);
  //         if($gender=='all'){
  //         if($city_code == 0){
  //            if($state_code == 0 ){           

  //              $lawyers = $this->query->whereIn('id',$user_ids1)
  //                       ->whereIn('id',$user_ids);

  //           }
  //           else if($state_code !=0){

  //             $lawyers = $this->query->where('users.state_code',$state_code)
  //                       ->whereIn('id',$user_ids1)
  //                       ->whereIn('id',$user_ids);

  //           }

  //         }
  //         else if($city_code !=0){
  //           $lawyers = $this->query->where('users.state_code',$state_code)
  //                       ->where('users.city_code',$city_code)
  //                       ->whereIn('id',$user_ids1)
  //                       ->whereIn('id',$user_ids);
  //         }
  //       }
  //       else if($gender !='all'){
  //         if($city_code ==0){
  //           if($state_code == 0 ){
  //                $lawyers = $this->query->where('users.gender',$gender)
  //                       ->whereIn('id',$user_ids1)
  //                       ->whereIn('id',$user_ids);

  //           }
  //           else if($state_code !=0){

  //             $lawyers = $this->query->where('users.state_code',$state_code)
  //                       ->where('users.gender',$gender)
  //                       ->whereIn('id',$user_ids1)
  //                       ->whereIn('id',$user_ids);

  //           }
  //         }
  //         else if($city_code !=0){
  //           $lawyers = $this->query->where('users.state_code',$state_code)
  //                       ->where('users.city_code',$city_code)
  //                       ->where('users.gender',$gender)
  //                       ->whereIn('id',$user_ids1)
  //                       ->whereIn('id',$user_ids);
  //         }
  //       }
  //     }      
  //   }

     $lawyers = $lawyers->orderBy('verified_account','DESC')->paginate(5);
   }
  else if($searchfield == 'lawcompany'){
    $lawyers = Helpers::lawcompanyDetails();

    if($court_id != '0'){     

      // if($state_code == '0'){
      //  $lawyers = Helpers::lawcompanyDetails($court_id)->whereIn('id',$user_ids1);
      // }else{
        //$lawyers = Helpers::lawcompanyDetails($court_id)
            //    ->where('users.state_code',$request->state_code)
              // ->where('users.city_code',$request->city_code)
            //  ->whereIn('id',$user_ids1); 
      // }
        $lawyers = Helpers::lawcompanyDetails($court_id,$city_code)->whereIn('id',$user_ids1); 
    }
    if($user_name != ''){
        $lawyers = $lawyers->where('name', 'LIKE', '%' .$user_name. '%');
    }
    $lawyers = $lawyers->paginate(5);
  }

  $slots = Slots::all();
  $curr_date = date("m/d/Y");
  $ts = strtotime($curr_date);
  $year = date('o', $ts);
  $week = date('W', $ts);
  $date = array();

  for($i = 1; $i <= 7; $i++) {
    $ts = strtotime($year.'W'.$week.$i);
    $date[] =  date("Y-m-d",$ts);
  }
  // $specialities = CatgMast::all();
  // $courts = CourtMast::all();
  // $states = State::all();
  

  $day = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
  $days = array_combine($day, $date);

  return view('pages.subpages.search.lawfirms_table', compact('lawyers','speciality_code','state_code','searchfield','days','slots'));

  }

  public function lawfirmsprofileShow($id){

    $reviews = Review::with('customers')->where('user_id',$id)->where('review_status','A')->paginate(4);
    $slots =Slots::all();
    $user = User::find($id);
    if(!empty($user)){

      if($user->user_catg_id == '2'){
          $userData = $this->query->where('id',$id)
                  ->first();  
      }   
      else{
        $userData = Helpers::lawcompanyDetails()->where('id',$id)->first();
      }

      return view('profiles.lawfirmsProfile', compact('userData','slots','reviews'));
    }else{
       return view('error_pages.404page');
    }
    
  }
  public function lawschoolsprofileShow($id){
    $reviews = Review::with('customers')->where('user_id',$id)->where('review_status','A')->paginate(4);
    $slots =Slots::all();
    $user = User::find($id);

    $userData = Helpers::lawschools()->where('id',$id)->first(); 
    return view('profiles.lawschoolsProfile', compact('userData','slots','reviews'));
  }


  public function writeReview(Request $request){
      // return $request;
      $status = Status::all();
      $status_id = $status[2]->status_id;
      
      $user_id = $request->user_id;
      $guest_id = $request->guest_id;

      $review_text = app('profanityFilter')->replaceWith('#@&*')->replaceFullWords(false)->filter($request->review_text);
      
      $review_status = $status_id;
      $review_date = date('Y-m-d');
      $review_rate = $request->review_rate;

      $reviewData = array('user_id'=>$user_id, 'guest_id'=>$guest_id,'review_text'=>$review_text,'review_status'=>$review_status,'review_date'=>$review_date,'review_rate'=>$review_rate);

      Review::insert($reviewData);
       return "Your review is submitted for moderation";
      
  }
  public function lawSchools(){
    $states = State::all();
    $lawschools = Helpers::lawschools()->paginate(2);

    return view('pages.subpages.lawschools_features',compact('states','lawschools'));
  }

  public function lawschoolsSearch(Request $request){

    $lawschools = Helpers::lawschools();

    if($request->user_name != ''){
      $lawschools =  $lawschools->where('name','LIKE','%'.$request->user_name.'%');
    }

    if($request->state_code != 0){
      if($request->city_code !=0){
        $lawschools =  $lawschools->where('state_code',$request->state_code)
                            ->where('city_code',$request->city_code);
      }  
      else{
        $lawschools =  $lawschools->where('state_code',$request->state_code);
      }

    }

    $lawschools = $lawschools->paginate(2);

    return view('pages.subpages.search.lawschools_table',compact('lawschools'));
  }


  public function search($id =null,$id1=null){
     
    $searchfield = 'lawyer';
     $specialities = CatgMast::orderBy('catg_desc','ASC')->get();
     $courts = CourtMast::all();
     $states = State::all();
     $slots = Slots::all();
     $gender = null;
     $name = '';
     $catg_code = null;
     $city_code = '0';
     $state_code = '0';
     $court_code = '0';
     $content = search_content();

      $date = array();
      $curr_date = Carbon::now()->addDays('-1');
      $day = array();
      $toDate = Carbon::now()->addDays('-1');

      for($i=0 ; $i<=6;$i++){
       $day[] = $toDate->addDays('+1')->format('D');
       $date[] = $curr_date->addDays('+1')->format('d-m-Y');
      }

      $days = array_combine($day, $date); //date to days wise indexing 
      // return $days;

      if(request()->all() != null){
        $searchfield = request()->searchfield !=null ? request()->searchfield : 'lawyer';
        $name = request()->user_name;
        $gender = request()->gender !='all' ? request()->gender : null;
        $court_code = request()->court_id;
      }

    if($searchfield =='lawyer'){
      if($id !=null){
          if($id !=null && $id1 !=null) {
            $catg_code = catg_by_name($id);
            $city = city_by_name($id1);
            if($catg_code ==null || empty($city)){
              return view('error_pages.404page');
            }
            $city_code = !empty($city) ? $city->city_code : '0';
            $state_code = !empty($city) ? $city->state_code : '0';
            $city_name = !empty($city) ? $city->city_name : '';
            $content = search_content('specialization',$city_name,'',$catg_code);
          
            $lawyers = Helpers::lawyerDetails($court_id=0, $catg_code)->whereIn('id',spec_users_ids($catg_code))->where('users.city_code',$city_code);

          }else{

            $catg_code = catg_by_name($id);  

            if($catg_code !=null){  
              $content = search_content('specialization','','',$catg_code);
              $lawyers = Helpers::lawyerDetails($court_id=0, $catg_code)->whereIn('id',spec_users_ids($catg_code)); 

            }else{
               $city = city_by_name($id);
               $city_code = !empty($city) ? $city->city_code : '0';
               $state_code = !empty($city) ? $city->state_code : '0';
               $city_name = !empty($city) ? $city->city_name : '';
                
               $content = search_content('city',$city_name,court_name_by_city($city_code));

               $lawyers = $this->query->where('users.city_code',$city_code);
                            if(empty($city)){
                return view('error_pages.404page');
              }              
            }


        }
      }else{
        $lawyers = $this->query;
      }
            
   
      if(request()->all() != null){

        if($name !=null){
          $lawyers =  $lawyers->where('name', 'like', '%' . request()->user_name . '%');
        }
        if($court_code !='0' && $court_code !=''){
            $lawyers = $lawyers->whereIn('id',court_users_ids($city_code,$court_code));
        }
        if($gender !=null){
          $lawyers = $lawyers->where('gender',$gender);
        }     
      }
    }else{
        $lawyers = Helpers::lawcompanyDetails();
        $city = city_by_name($id);
        $city_code = !empty($city) ? $city->city_code : '0';
        $state_code = !empty($city) ? $city->state_code : '0';
        if($court_code !='0' && $court_code !=''){  
           $lawyers = Helpers::lawcompanyDetails($court_code,$city_code)->whereIn('id',court_users_ids($city_code,$court_code));
        }


        if($name != ''){
            $lawyers = $lawyers->where('name', 'LIKE', '%' .$name. '%');
        }
    } 

    
        $lawyers =  $lawyers->orderBy('verified_account','DESC')->orderBy('status','ASC')->paginate(10);
      return view('search.index',
        compact('searchfield','specialities','courts','states','lawyers','days','slots','name','catg_code','city_code','state_code','court_code','gender','content'));

  }

}
