<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    protected $table = 'student_attendance';
	protected $guarded = [];
	
	public function student(){
		return $this->belongsTo('App\Models\StudentMast','s_id');
	}
}
