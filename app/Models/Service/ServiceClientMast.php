<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class ServiceClientMast extends Model
{
	use SoftDeletes;
	protected $table= 'service_mast_client';
	protected $guarded = [];

	public function service_mast(){
		return $this->belongsTo('App\Models\Service\ServiceMast','service_code','service_code');
	}
	public function user(){
		return $this->belongsTo('App\User','user_id')->select('id','name','user_catg_id','email','mobile','city_code','state_code','status');
	}

}
