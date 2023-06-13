<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodosComment extends Model
{
    protected $table = 'todos_comments';	
    protected $fillable = ['todo_id','user_id','comment','cmnt_dt'];

    protected $primaryKey = null;
    public $incrementing = false;

    public function user(){
    	return $this->belongsTo('App\User','user_id');
    }
}
