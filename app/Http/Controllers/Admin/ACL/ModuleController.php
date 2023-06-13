<?php

namespace App\Http\Controllers\Admin\ACL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Role;
class ModuleController extends Controller
{
   public function index(){
   		$modules = Module::orderBy('line')->get();
   		$roles = Role::whereNotIn('id',['1'])->get();

   		return view('admin.dashboard.acl.module.index',compact('modules','roles'));
   }

   public function create(){
      $roles = Role::whereNotIn('id',['1'])->get();
   	return view('admin.dashboard.acl.module.create',compact('roles'));
   }
   public function store(Request $request){
         $data =  $this->validation($request);
         $permissions = array('can_view' => $request->permissions);  
         $data['permissions'] = json_encode($permissions);
   		   Module::create($data);
   		return redirect()->route('acl_module.index')->with('success','Module Created Successfully');
    }
    public function edit($id){
      $roles = Role::whereNotIn('id',['1'])->get();
      $module = Module::find($id);

      
      return view('admin.dashboard.acl.module.edit',compact('roles','module'));
    }
    public function update(Request $request, $id){
      $data =  $this->validation($request,$id);
      $permissions = array('can_view' => $request->permissions);  
      $data['permissions'] = json_encode($permissions);
      Module::find($id)->update($data);
      return redirect()->route('acl_module.index')->with('success','Module Updated Successfully');
    }
    public function validation($request,$id=null){

         if($request->is_active == '1'){
            $data = $request->validate([
               'name' => 'required',
               'is_active' => 'required',
               'from' => 'nullable',
               'to' => 'nullable',
               'icon' => 'required',
               'link' => 'required',
               'line' => 'required|unique:modules,line,'.$id,
               'show_team' => 'required',
               'module_type' => 'required|not_in:""'
            ]);
            
         }else{
            $data = $request->validate([
               'name' => 'required',
               'is_active' => 'required',
               'from' => 'required',
               'to' => 'required',
               'icon' => 'required',
               'link' => 'required',
               'line' => 'required|unique:modules,line,'.$id,
               'show_team' => 'required',               
               'module_type' => 'required|not_in:""'
            ]);
         }   
         return $data;  
    }
    public function show($id){
         $module =  Module::find($id);
         $roles = Role::whereNotIn('id',['1'])->get();
         return view('admin.dashboard.acl.module.show',compact('roles','module'));
    }
}
