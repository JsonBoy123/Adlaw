<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class TempUsers extends Model
{
	use SoftDeletes;
   	protected $table = 'temp_users';
   	protected $guarded = [] ;
}
