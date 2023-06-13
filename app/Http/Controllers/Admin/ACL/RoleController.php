<?php

namespace App\Http\Controllers\Admin\ACL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
class RoleController extends Controller
{
      public function index(){
      	$roles = Role::all();
      	return view('admin.dashboard.acl.role.index',compact('roles'));
      }
   	public function create(){
   		return view('admin.dashboard.acl.role.create');
   	}

   	public function store(Request $request){
   		$data = $request->validate([
   			'name' 			=> 'required|string|min:4|max:100',
   			'display_name' 	=> 'required|string|min:4|max:100',
   			'description'	=> 'required|string|min:6|max:150'
   		]);
   		Role::create($data);
   		return redirect()->route('role.index')->with('success','Role Created Successfully');
   		
   	}
   	public function edit($id){
   		$role = Role::find($id);
        
   		return view('admin.dashboard.acl.role.edit',compact('role'));
   	}
   	public function update(Request $request,$id){

   		$data = $request->validate([
   			'name' 			=> 'required|string|min:4|max:100',
   			'display_name' 	=> 'required|string|min:4|max:100',
   			'description'	=> 'required|string|min:6|max:150'
   		]);
   		Role::find($id)->update($data);
   		return redirect()->route('role.index')->with('success','Role Updated Successfully');
   	}
}
