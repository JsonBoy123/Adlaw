<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{

    protected $table = 'package_mast';
    protected $guarded = [];

    public function package_modules(){
    	return $this->belongsToMany('App\Models\PackageModule','package_modules','package_id','module_id');
    }
  	
  	public function modules(){
  		return $this->hasMany('App\Models\PackageModule','package_id');
  	}
}
