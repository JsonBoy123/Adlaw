<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';
   	protected $guarded = [];

   	public function permissions(){
   		return $this->hasMany('App\Permission','module_id');
   	}
}
