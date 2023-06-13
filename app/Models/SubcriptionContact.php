<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SubcriptionContact extends Model
{
   	use SoftDeletes;
   	protected $table = "subscription_contacts";
	protected $guarded = [] ;

	public function user(){
		return $this->belongsTo('App\User','user_id');
	}
	public function package(){
		return $this->belongsTo('App\Models\Package','package_id');
	}
}
