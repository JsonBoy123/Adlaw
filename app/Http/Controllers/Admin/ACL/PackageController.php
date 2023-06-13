<?php

namespace App\Http\Controllers\Admin\ACL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Package;
class PackageController extends Controller
{
    public function index(){
    	$packages = Package::with('modules.module')->get();
  		// return $packages;
    	return view('admin.dashboard.acl.package.index',compact('packages'));
    }
    public function create(){
    	$modules = Module::all();

    	return view('admin.dashboard.acl.package.create',compact('modules'));
    }
    public function store(Request $request){
    
    	$this->validation($request);

    	$data = [
    		'name' => $request->name,
    		'price' => $request->price,
    		'duration_type' => $request->duration_type,
    		'duration' => $request->duration,
    		'description' => $request->description,
    	];


    	$package = Package::create($data);

    	$package->package_modules()->sync($request->module_id);
    	return redirect()->route('acl_package.index')->with('success','Package Created Successfully');
    }

    public function edit($id){
    	$modules = Module::all();
    	$package = Package::with('modules')->where('id',$id)->first();
    	// return $package;
    	return view('admin.dashboard.acl.package.edit',compact('modules','package'));
    }


   public function update(Request $request, $id){

    	$this->validation($request);
    	$data = [
    		'name' => $request->name,
    		'price' => $request->price,
    		'duration_type' => $request->duration_type,
    		'duration' => $request->duration,
    		'description' => $request->description,
    	];

    	$package = Package::find($id);
    	$package->update($data);
    	$package->package_modules()->sync($request->module_id);
    	return redirect()->route('acl_package.index')->with('success','Package Updated Successfully');

   }
   public function validation($request){
   		$request->validate([
    		'name' => 'required',
    		'price' => 'required',
    		'duration_type' => 'required',
    		'duration' => 'required',
    		'module_id' => 'required',
    		'description' => 'nullable'
    	]);
   }


}
