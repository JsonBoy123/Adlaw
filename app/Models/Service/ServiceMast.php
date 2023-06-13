<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;

class ServiceMast extends Model
{
    protected $table= 'service_mast';
    protected $guarded = [];
    public $timestamps = false;

    public function service_catg_mast(){
		return $this->belongsTo('App\Models\Service\ServiceCatgMast','service_catg_code','service_catg_code');
	}
}
