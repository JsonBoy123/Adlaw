<?php

use App\Team;
use App\Models\City;
use App\Models\State;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Helpers\Helpers;
use App\Models\CatgMast;
use App\Models\Specialization;
use App\Models\CourtMast;
use App\Models\CourtMastHeader;
use App\Models\Court;
use Carbon\Carbon;
use App\Models\CauseList;
use App\Models\Customer;
const MODULETYPE = [
      1 => 'CRM',
      2 => 'PROFILE'
];
const SHOWMEMBR = [
      1 => 'Yes',
      0 => 'No'
];
const weekDay = [
    'Mon' => 'Monday',
    'Tue' => 'Tuesday',
    'Wed' => 'Wednesday',
    'Thu' => 'Thursday',
    'Fri' => 'Friday',
    'Sat' => 'Saturday',
    'Sun' => 'Sunday'
];
const SERVICE_STATUS = [
    'A'       => 'Active',
    'P'       => 'Pending',
    'D'       => 'Decline'
];
const INVOICE_STATUS = [
    '0'       => 'Due',
    '1'       => 'Paid',
    '2'       => 'Partially Paid'
];
const GENDER = [
    'm'       => 'Male',
    'f'       => 'Female',
    't'       => 'Other'
];

const PAYMENTMODE = [
  1 => 'Cash',
  2 => 'Cheque',
  3 => 'UPI Payment',
  4 => 'NEFT/Bank Transfered'
];

if (!function_exists('list_global_tags')) {
  function list_global_tags($tag)
  {
    return DB::table('global_tags')->where('tag', $tag)->get();
  }
}

if (!function_exists('get_global_tag_id')) {
  function get_global_tag_id($name, $tag)
  {
    return DB::table('global_tags')->where(['name' => $name, 'tag' => $tag])->pluck('id')->first();
  }
}

if (!function_exists('get_global_tag_name')) {
  function get_global_tag_name($id, $tag)
  {
    return DB::table('global_tags')->where(['id' => $id, 'tag' => $tag])->pluck('name')->first();
  }
}

if (!function_exists('notify_team_users')) {
  function notify_team_users($team_id, $notification, $msg)
  {
    $team = Team::with('users_in_team')->where('id',$team_id)->first();
    Notification::send($team->users_in_team, new $notification ($msg));
  }
}

if (!function_exists('get_user_objects')) {
  function get_user_objects($ids) // Array of IDS
  {
    $users = User::whereIn('id',$ids)->get();
    return response()->json($users,200);
  }
}

if (!function_exists('get_notify_users')) {
  function get_notify_users($ids) // Array of IDS
  {
   return  User::whereIn('id',$ids)->get();
  }
}

if(!function_exists('get_user_filestack_id')){
  function get_user_filestack_id(){
    $users =  Helpers::get_all_users(auth()->user()->id)->get(); 

    $filestack_id =  collect($users)->map(function($e) {
      return $e['filestack_id'];
    });
    $filestack_id[] = Auth::user()->filestack_id;

    return $filestack_id;
  }
}  // User filestack id get 

if (!function_exists('city_fetch')) {
  function city_fetch($city_code)
  {
    return City::find($city_code);
  }
}

if (!function_exists('city_by_name')) {
  function city_by_name($id)
  {

    $name = str_replace('-','',$id);
    $city = City::all()->filter(function($city) use($name){
                          return strtolower(str_replace(' ','',trim($city->city_name))) == $name;
                        })->first();
    return $city;
  }
}

if (!function_exists('catg_by_name')) {
  function catg_by_name($id)
  {
    $name = str_replace('-','',$id);
    $catg =  CatgMast::all()->filter(function($catg) use($name){
                          return strtolower(str_replace('&','',str_replace(' ','',trim($catg->catg_desc)))) == $name;
                        })->first();
    return !empty($catg) ? $catg->catg_code : null;

  }
}
if (!function_exists('court_name_by_city')) {
  function court_name_by_city($city_code)
  {
     $courts_types = CourtMastHeader::select('court_name')->where('city_code', $city_code)->orderBy('court_name')->get();
     $court_name = '';
     foreach ($courts_types as $key => $value) {
       $court_name .= $value->court_name.', ';
     }
    return substr($court_name,0,strlen($court_name)-2);
    

  }
}

if(!function_exists('spec_users_ids')){
  function spec_users_ids($catg_code){
      $spe_details = Specialization::where('catg_code',$catg_code)->get();
      $user_ids =array();
      foreach ($spe_details as $spe_detail) {
        $user_ids[] =  $spe_detail->user_id;
      }
      return $user_ids;
  }
}
if(!function_exists('court_users_ids')){
  function court_users_ids($city_code,$court_id){      
      $courts_types = CourtMastHeader::select('court_code')->where('court_type',$court_id)->where('city_code', $city_code)->get();
      $courts_details = Court::whereIn('court_code',$courts_types->toArray())->get();
      $user_ids =array();
      foreach($courts_details as $courts_detail){
         $user_ids[]=$courts_detail->user_id;  
      }
      return $user_ids;
  }
}

if(!function_exists('search_content')){
  function search_content($condition = 'main',$city_name=null,$court_name=null,$catg_code = null){  
  if($condition =='main'){
    $content['title'] = 'Best Lawyers for Consulting | Top 10 Criminal Lawyers | Lawyers Association India';
    $content['description'] = 'Get best lawyers for consulting, whether you are finding criminal lawyers, family lawyers, corporate lawyers for free law advice, legal answer or any Law Association in India.';
    $content['keywords'] = 'lawyers association India, top 100 lawyers in India, top 10 criminal lawyers in India, top 50 lawyers in India, best lawyers for consulting, free Legal advice, legal advice, consult with best lawyer, legal help, legal issues, law questions, law advice, ask a lawyer, legal question, law answers, free law advice, legal answers, law advisers, free legal help';

    $content['content'] = '<h1 class="text-captialize mb-3">Consult Best Lawyer / Law Firms in India</h1>
      <p class="p-text">
          Seeing the demand of various Legal problems we allow you to hire the professional experts having good experience in Civil Law, Corporate Law, Start-up Solutions, Criminal Law, Consumer Law, Family Law and much more in all over India.
      <br><br>
      We help you to consult with the well experienced team of lawyers, researchers & experts carry daily research on all latest current & new law, judgments & Court decisions and allows to hire the best lawyers in India for District Courts, High Court & Supreme Court matters. Our services includes to provide the best legal advisor for legal consultancy services, taxation services, corporate legal services, recovery solutions, financial legal services, bad debt recovery solutions, back office operation services, data entry service, documentation services, passport related services, fiscal documentation etc.</p>';

    }elseif($condition == 'specialization'){

      $catg =  CatgMast::where('catg_code',$catg_code)->first();

      if(!empty($catg)){
        $catg_name = ucwords(str_replace('Law','',$catg->catg_desc));
        $description =  $city_name !=null ? str_replace('$city_name', 'in '.$city_name, $catg->description) : str_replace('$city_name','in India', $catg->description);
      }else{
        $catg_name = '';
        $description = '';
      }
     
      $city = $city_name !=null ? $city_name : 'India';
      $content['title'] = "".$catg_name."Lawyers/Advocate, Attorneys in ".$city." | Top 10 ".$catg_name."Lawyers in ".$city." | ".$catg_name."Legal Advisor - Adlaw";
      $content['description'] = "Find best ".$catg_name."Lawyers/Advocate, Attorneys in ".$city.". Get Legal consultation by top rated district court ".$catg_name."lawyers for your all type of legal matters.";
      $content['keywords'] = "".$catg_name."lawyers, ".$catg_name."lawyers in ".$city.", best ".$catg_name."lawyers in ".$city.", top ".$catg_name."lawyers, Indian".$catg_name."advocate, ".$catg_name."advocates in ".$city.", list of ".$catg_name."lawyers in ".$city.", list of ".$catg_name."advocate in ".$city.", district court ".$catg_name."lawyer, district court ".$catg_name."advocate, ".$catg_name."Legal Advisor in ".$city.", high court ".$catg_name."lawyer, high court ".$catg_name."advocate, female ".$catg_name."lawyer in ".$city."";

      $content['content'] = $description ; 


    }elseif($condition == 'city'){

      $content['title'] = "Lawyers/Advocate, Attorneys in ".$city_name." | Top 10 Lawyers in ".$city_name." |  ".$city_name." High Court Lawyer";
      $content['description'] = "Find best lawyers/ advocates, Attorneys in ".$city_name .". Get Legal consultation by ".$city_name ." top rated high court lawyers for your all type of legal matters";
      $content['keywords'] = "Lawyers in ".$city_name .", Advocate in ".$city_name .", Top 10 Lawyers in ".$city_name .", Top 100 Lawyers in ".$city_name .", Best Lawyers in ".$city_name .", ".$city_name ." lawyers for Consulting, Find best lawyers in ".$city_name .", ".$city_name ." lawyers, district court ".$city_name ." advocate, ".$city_name ." advocate number, ".$city_name ." high court lawyers, free legal advice ".$city_name ."";


      $content['content'] = "<h1 class='text-captialize mb-3'>Consult with Best Lawyers in ".$city_name ."</h1>

      <p class='p-text'>Adlaw helps you to consult with the best lawyers in ".$city_name ." for ".$court_name." matters. Our portal is based upon well read and well connected lawyers, who are there to cater your all legal needs. You can use filters to narrow your search and find the best lawyer or advocate in ".$city_name ." for your legal matter. Our aim is to deliver complete legal solutions to all legal requirements of our clients. We have a highly qualified and responsive team of attorneys involving of young as well as senior legal professionals who have attained specific expertise in their specific area of laws. Get top lawyers in ".$city_name ." for family dispute or divorce matters, property matter, employment or labor court matter, criminal matter, recovery or cheque bounce matters, taxation or corporate matters, or then again an attorney master in some other field of law.<br><br></p>

      <h2 class='text-captialize mb-3'>How to Hire Advocate in ".$city_name ."</h2>

      <p class='p-text'>It's critical to comprehend that a decent attorney doesn't guarantee that you'll win your case. Regardless, having a respectable attorney will give you the best opportunities for an ideal outcome and the comfort of realizing that you had the best representation. The initial stage in enrolling an Advocate is picking one in the practice zone that is related to your legal issue since this will ensure that the legal counselor is knowledgeable about dealing with cases like yours. There are several overall qualities that you should look for while picking an attorney in ".$city_name .". A better than average Advocate will have a sensible charge structure, which will empower you to understand in case you can bear the expense of the attorney's administrations and let you appreciate what you'll be getting for your money. Another significant factor to pass judgment on a decent Advocate is incredible correspondence since it's crucial that the attorney keeps awake with the most recent information about your case.<br><br></p>

      <p class='p-text'>Finally, it's basic to investigate the Advocate before getting that individual. You can often find online studies from past clients, and you can check whether the legal counselor has ever had tragic conduct with any of his past customers. Best Lawyers is dedicated to discovering how the people get legal Assist in India.</p>";
    }
      return $content;
  }

}

if(!function_exists('cause_list_fetch')){
  function cause_list_fetch(){      
      $licence_no = Auth::user()->licence_no;
        $cause_lists = array();        
        $date = Carbon::now();
        $to = $date->format('Y-m-d');
        $from = $date->addDays('+3')->format('Y-m-d');

        if($licence_no !=null){
            $cause_lists =  CauseList::where('licence_no',$licence_no)->whereBetween('hearing_date',[$to,$from])->get();
        }
        return $cause_lists;
  }
}

if(!function_exists('user_clients')){
  function user_clients($status = 'A'){
      $client_ids = Helpers::deletedClients();       
      $clients = Customer::where('user_id',Auth::user()->id)
                          ->whereNotIn('cust_id',$client_ids)
                          ->where('status_id', $status);             
      return $clients;
  }
}

if(!function_exists('displaywords')){
     function displaywords($number){
         $no = (int)floor($number);
         $point = (int)round(($number - $no) * 100);
         $hundred = null;
         $digits_1 = strlen($no);
         $i = 0;
         $str = array();
         $words = array('0' => '', '1' => 'one', '2' => 'two',
          '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
          '7' => 'seven', '8' => 'eight', '9' => 'nine',
          '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
          '13' => 'thirteen', '14' => 'fourteen',
          '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
          '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
          '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
          '60' => 'sixty', '70' => 'seventy',
          '80' => 'eighty', '90' => 'ninety');
         $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
         while ($i < $digits_1) {
           $divider = ($i == 2) ? 10 : 100;
           $number = floor($no % $divider);
           $no = floor($no / $divider);
           $i += ($divider == 10) ? 1 : 2;


           if ($number) {
              $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
              $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
              $str [] = ($number < 21) ? $words[$number] .
                  " " . $digits[$counter] . $plural . " " . $hundred
                  :
                  $words[floor($number / 10) * 10]
                  . " " . $words[$number % 10] . " "
                  . $digits[$counter] . $plural . " " . $hundred;
           } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);


        if ($point > 20) {
          $points = ($point) ?
            "" . $words[floor($point / 10) * 10] . " " . 
                $words[$point = $point % 10] : ''; 
        } else {
            $points = $words[$point];
        }
        if($points != ''){        
            echo $result . "Rupees  " . $points . " Paise Only";
        } else {

            echo $result . "Rupees Only";
        }

      }
}
