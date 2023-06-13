<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Model;


class InvoiceDetails extends Model
{
	
    protected $table= 'invoice_details';
    protected $fillable = ['invc_numb','service_code','service_rate','service_discount','quantity','unit_code','service_amnt'];
    protected $primaryKey = null;
    public $incrementing = false;


    public function service(){
    	return $this->belongsTo('App\Models\Service\ServiceMast','service_code','service_code');
    }

}
