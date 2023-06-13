<?php

namespace App\Http\Controllers\Admin\ACL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Models\Module;
class PermissionController extends Controller
{
    public function index(){
         $modules = Module::select('id','name')->with('permissions')->has('permissions')->get();
          
    	   $permissions = Permission::whereNull('module_id')->get();

   		return view('admin.dashboard.acl.permission.index',compact('permissions','modules'));
   	}
   	public function create(){
         $modules = Module::all();
   		return view('admin.dashboard.acl.permission.create',compact('modules'));
   	}
   	public function store(Request $request){
         // return $request->all();
   		$data = $this->validation($request);
   		Permission::create($data);
   		return redirect()->route('permission.index')->with('success','Permission Created Successfully');
   		
   	}
   	public function edit($id){
   		$permission = Permission::find($id);
         $modules = Module::all();
   		return view('admin.dashboard.acl.permission.edit',compact('permission','modules'));
   	}
   	public function update(Request $request,$id){
         $data = $this->validation($request);
   		Permission::find($id)->update($data);
   		return redirect()->route('permission.index')->with('success','Permission Updated Successfully');
   	}
      public function validation($request){
         return $request->validate([
            'name'         => 'required|string|min:4|max:100',
            'display_name' => 'required|string|min:4|max:100',
            'description'  => 'required|string|min:6|max:150',
            'module_id'    => 'nullable'
         ]);
      }
}
