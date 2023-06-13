<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
   	protected $table = 'employee_attendance';
   	protected $guarded = [];

   	public function staff(){
   		return $this->belongsTo('App\User','emp_id');
   	}
}
