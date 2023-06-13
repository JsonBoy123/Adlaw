<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicCalendarMast extends Model
{
    protected $table = 'academic_calendar';
    protected $guarded = [];
    protected  $dates = ['date_from', 'date_upto'];
}
