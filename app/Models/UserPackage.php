<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPackage extends Model
{
    protected $table = 'user_package';
    protected $guarded = [];
    public function package(){
    	return $this->belongsTo('App\Models\Package','package_id');
    }
}
