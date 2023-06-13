<?php

namespace App\Http\Controllers\Teams;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Team;
use App\Models\UserTeam;
use App\Helpers\Helpers;
class TeamController extends Controller
{
    public function index(){
    	$id = Auth::user()->id;
    	$teams = Team::with('members.users')->where('user_id', $id)->get();

    	return view('teams.index',compact('teams'));
    }
    public function create(){
        $users = Helpers::get_all_users(Auth::user()->id)->get();
        return view('teams.create',compact('users'));
    }
    public function store(Request $request){
    	$id = Auth::user()->id;
    	$validate = $request->validate([
    		'name'  => 'required|max:50|min:3',
            'users' => 'required|array|max:10|min:1',
    	]);
    	$teams = Team::where('user_id', $id)->get();
    	if(!empty($teams)){
	    	foreach ($teams as $team) {
	    		if($team->name == $validate['name']){
	    			return redirect()->back()->with('error','Team name already inserted');
	    		}
	    	}
    	}
    	$data = [
    		'name' => $request->name,
    		'user_id' => $id,
    	];
    	$team = Team::create($data);

        $user = Team::find($team->id);
        $user->members_assign()->sync($validate['users']);

        return redirect()->route('teams.index')->with('success','Team name inserted successfully');

    }

    public function show($id){
    	$teams = Team::with('members.users')->where('user_id', $id)->get();
    	return view('teams.show',compact('teams'));
    }

    public function edit($id){
    	$team = Team::with('members.users')->find($id);
        // return $team;
        $users = Helpers::get_all_users(Auth::user()->id)->get();
    	return view('teams.edit',compact('team','users'));
    }

    public function update(Request $request,$id){
    	$validate = $request->validate([
    		'name' => 'required|max:50|min:3',
            'users' => 'required|array|max:10|min:1',
    	]);
    	$team = Team::find($id);
    	$teams = Team::where('user_id', Auth::user()->id)->get();
    	if($team['name'] != $validate['name']){
			foreach ($teams as $value) {
				if($value->name == $validate['name']){
					return redirect()->back()->with('error','Team name already inserted');
				}
			}
		}
        $data = [
            'name' => $request->name,
        ];
		$team->update($data);

        $user =Team::find($id);
        $user->members_assign()->sync($validate['users']);

		return redirect()->route('teams.index')->with('success','Team name updated successfully');
    }
    public function destroy($id){
    	$team = Team::find($id)->delete();
    	return redirect()->back()->with('success','Team name deleted successfully');
    }
    public function team_users(){
        $team_id = request()->team_id;
        if($team_id == 0){
            $members = Helpers::get_all_users(Auth::user()->id)->get();
        }
        else{
            $members = UserTeam::with('users')->where('team_id',$team_id)->get();
        }
        return $members;
    }
}
