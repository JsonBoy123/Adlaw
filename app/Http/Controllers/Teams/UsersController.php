<?php

namespace App\Http\Controllers\Teams;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Mail;
use Auth;
use DB;
use App\User;
use App\Role;
use App\Permission;
use App\VerifyUser;
use App\Mail\UserMail;
use App\Models\Status;
use App\Models\RoleUser;
use App\Models\CaseLawyer;
use App\Models\Package;
use App\Helpers\Helpers;
use Crypt;
use App\Models\Module;
class UsersController extends Controller
{
	public function index(){
		$users = User::with(['state','city','country','role'])->whereNull('parent_id')->paginate(10);
		$roles = Role::whereNotIn('id',['6','7','8'])->get();
		$packages = Package::with('modules.module')->get();
		
        return view('users.index',compact('users','roles','packages'));	
	}
	public function create(){
		$roles = Role::whereNotIn('id',['6','7','8'])->get();
		return view('users.create',compact('roles'));
	}
	public function store(Request $request){

		//return $request->all();
		if(Auth::user()->user_catg_id == '1'){
			$data =  $request->validate([
	            'name'          => 'required|string|max:255|min:3',
	            'email'         => 'required|email|max:255|unique:users',
	            'mobile'        => 'required|min:10|max:11|regex:/^[0-9]+$/',
	            'user_catg_id'  => 'required|not_in:0',
	        ]);			
	        $data['parent_id'] = null;

		}
		else{
			$data =  $request->validate([
	            'name'          => 'required|string|max:255|min:3',
	            'email'         => 'required|email|max:255|unique:users',
	            'mobile'        => 'required|min:10|max:11|regex:/^[0-9]+$/',
	        ]);	

	        if(Auth::user()->user_catg_id == '4'){
	            $data['user_catg_id'] =  '6';
	        }
	        else if(Auth::user()->user_catg_id == '3' || Auth::user()->user_catg_id == '2'){
	            $data['user_catg_id'] = '2';   
	        }else{
	        	$data['user_catg_id'] = '5';   
	        }



	        $data['parent_id'] = Auth::user()->id;
	        $data['user_package_id'] = Auth::user()->user_package_id;
	        $data['package_start'] = Auth::user()->package_start;
	        $data['package_end'] = Auth::user()->package_end;
	        $data['parent_id'] = Auth::user()->id;

		}

        $this->create_user($data);

		if(Auth::user()->user_catg_id == '1'){
			return redirect()->route('users.index')->with('success','User created successfully');
		}
		else{
			return redirect()->route('teams.index')->with('success','User created successfully');
		}
       
	}

    public function show($id){
    	$users = Helpers::get_all_users($id)->get();    		
    	return view('users.show',compact('users'));
    }
    public function edit($id){
    	$user = User::find($id);
    	$roles = Role::where('id','>', 1)->get();
        return view('users.edit',compact('user','roles'));
    }
    public function update(Request $request, $id){
    	$olduser = User::find($id);

    	if(Auth::user()->user_catg_id == '1'){
			$data =  $request->validate([
	            'name'          => 'required|string|max:255|min:3',
	            'email'         => 'required|email|max:255|unique:users,email,'.$id,
	            'mobile'        => 'required|min:10|max:11|regex:/^[0-9]+$/',
	            'user_catg_id'  => 'required|not_in:0',
	        ]);			
	        $data['parent_id'] = null;

		}
		else{
			$data =  $request->validate([
	            'name'          => 'required|string|max:255|min:3',
	            'email'         => 'required|email|max:255|unique:users,email,'.$id,
	            'mobile'        => 'required|min:10|max:11|regex:/^[0-9]+$/',
	        ]);	

	        if(Auth::user()->user_catg_id == '4'){
	            $data['user_catg_id'] =  '6';
	        }
	        else if(Auth::user()->user_catg_id == '3' || Auth::user()->user_catg_id == '2'){
	            $data['user_catg_id'] = '2';   
	        }else{
	        	$data['user_catg_id'] = '5';   
	        }
	        $data['parent_id'] = Auth::user()->id;
	        $data['user_package_id'] = Auth::user()->id;
	        $data['parent_id'] = Auth::user()->id;
		}

		if($olduser->email != $data['email']){         
            $this->create_user($data,$olduser->email);
        }
        else{
            $olduser->update($data);
        }

        if(Auth::user()->user_catg_id == '1'){
			return redirect()->route('users.index')->with('success','User updated successfully');
		}
		else{
			return redirect()->route('teams.index')->with('success','User updated successfully');
		}

    }
    public function destroy($id){
		User::where('id',$id)->update(['deleted_at'=>date('Y-m-d H:i:s')]);
		return redirect()->back()->with('success','User deleted successfully');
    }
    public function create_user($data,$oldEmail =null){
        $status = Status::all();
        $status_id = $status[2]->status_id;
        $rand_no = rand(1111,9999);

        $password  = str_limit($data['name'],3,'@'.$rand_no);
        
        $data['password'] = Hash::Make($password);
        $data['pwd'] = Crypt::encrypt($password);
        
        $data['status']    = $status_id;
        if($oldEmail !=null){
		  $user = User::where('email',$oldEmail)->first();
          $user->update($data); 
        }else{
        	$user = User::create($data);
        	$user->attachRole($user->user_catg_id);
        }
        
       	$user->remember_token = str_random(40);
        $user->save();	
        if($oldEmail ==null){
       	 	$user->attachPermission('6');
       	}
        $user['password'] = $password;
        Mail::to($user->email)->send(new UserMail($user));
    }

    public function login_history(){
		$id =  request()->id;
		$user =  User::find($id);
		return response()->json($user);
    }
    public function member_cases(){
       $id =  request()->id;
       $user =  User::find($id);
       // return $member;
      $case = CaseLawyer::with(['case.client','case.court','case.casetype'])->where('user_id1',$id)->where('deallocate_date',null)->get();

    //   CaseLawyer::with(['member','case' => function($query){
				// $query->with(['client','court','casetype']);
				// }])

       return response()->json($case);
    }

	public function assign_role($id){
		$user = User::with('roles')->where('id',$id)->first();
		// return $user;
		$roles = Role::all();
		return view('users.assign_role',compact('user','roles'));
	}

	public function user_role_assign(Request $request){

		$user = User::find($request->user_id);
		$user->syncRoles([$request->role_id]);
		$user->update(['user_catg_id' => $request->role_id]);

		return redirect()->back()->with('success');

	}
	public function user_permission_assign(Request $request){
		// return $request->all();
		$user = User::find($request->user_id);
		$user->syncPermissions($request->permission_id);
		return 'success';

	}
	public function assign_permission($id){
		$user = $user = User::with('permissions')->where('id',$id)->first();
		$modules = Module::select('id','name')->with('permissions')->has('permissions')->get();
		$permissions = Permission::whereNull('module_id')->get();

		
		return view('users.assign_permission',compact('user','permissions','modules'));
	
	}
	public function old_package(){

		return view('users.old_package_table');
	}

	public function filterUser(Request $request){
		if(is_numeric($request->name)){
			$users = User::with(['state','city','country','role'])->whereNull('parent_id')->where('id',$request->name)->paginate(10);
		}else{
			$users = User::with(['state','city','country','role'])->whereNull('parent_id')->where('name','LIKE','%'.$request->name.'%')->paginate(10);
		}
		
		return view('users.table',compact('users'));
	}
}
