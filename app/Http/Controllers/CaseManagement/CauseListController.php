<?php

namespace App\Http\Controllers\CaseManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CauseList;
use Auth;
use App\User;
class CauseListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index(){
    	
    	$hearing_date = date('Y-m-d');
        $cause_lists =  $this->cause_list_fetch($hearing_date); 
   	 	return view('case_management.causelist.index',compact('cause_lists','hearing_date'));
    }
    public function filter(Request $request){
        $hearing_date = $request->date;
        $cause_lists =  $this->cause_list_fetch($hearing_date);    
        return view('case_management.causelist.show',compact('cause_lists','hearing_date'));

    }
    public function show(){
        $hearing_date = date('Y-m-d');
        $cause_lists =  $this->cause_list_fetch($hearing_date); 
   	 	return view('case_management.causelist.show',compact('cause_lists','hearing_date'));
    }

    public function cause_list_fetch($date){
        $licence_no = Auth::user()->licence_no;
        $cause_lists = array();        
        if($licence_no !=null){
            $cause_lists =  CauseList::where('licence_no',$licence_no)->whereDate('hearing_date',$date)->get();
        }
        return $cause_lists;
    }

    
}
