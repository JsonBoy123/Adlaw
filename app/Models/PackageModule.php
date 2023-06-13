<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageModule extends Model
{
    protected $table = 'package_modules';
    protected $guarded = [];

    public function module(){
    	return $this->belongsTo('App\Models\Module','module_id');
    }
 	
}
