<?php

namespace App\Http\Controllers\Docs;

use App\Http\Controllers\Controller;
use App\Team;
use App\User;
use App\Models\Filestack;
use Illuminate\Http\Request;
use Auth;
use App\Helpers\Helpers;
class MainController extends Controller
{
	public function __construct()
	{
  		$this->middleware('auth');
	}

	public function index() {

		$users =  Helpers::get_all_users(auth()->user()->id)->get();  
		$filestack_id = get_user_filestack_id();

		if(Auth::user()->parent_id ==null){
			$general_stacks = Filestack::where('type', 2)->where('user_id',Auth::user()->id)->get();
		}else{
			$general_stacks = Filestack::where('type', 2)->where('user_id',Auth::user()->parent_id)->get();
		}

		$filestacks = Filestack::with('user_owns')->where('type', 1)->whereIn('id',$filestack_id)->get();
		return view('docs.index', [
			'users' => $users,
			'general_stacks' => $general_stacks,
			'filestacks' => $filestacks
		]);
	}

}