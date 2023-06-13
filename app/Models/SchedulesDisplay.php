<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class SchedulesDisplay extends Model
{
    use SoftDeletes;
    protected $table = 'pms_schedules_displays';
    protected $dates = ['deleted_at'];
    
    public function schedule(){
	  	return $this->belongsTo('App\Models\Schedule');
	  }

	  /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
}
