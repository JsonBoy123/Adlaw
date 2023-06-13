<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CauseList extends Model
{
	use SoftDeletes;
    protected $table='temp_cause_list';
    protected $guarded = [];

    public function lawyer_name(){
    	return $this->belongsTo('App\User','licence_no','licence_no');
    }

}
