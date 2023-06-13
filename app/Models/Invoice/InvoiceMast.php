<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class InvoiceMast extends Model
{
	use SoftDeletes;
    protected $table= 'invoice_mast';
    protected $guarded = [];
    protected $primaryKey = 'invc_numb';


    public function invoice_details()
    {
    	return $this->hasMany('App\Models\Invoice\InvoiceDetails','invc_numb','invc_numb');
    }
    public function customer()
    {
    	return $this->belongsTo('App\Models\Customer','cust_id');
    }
    public function user(){
    	return $this->belongsTo('App\User','user_id')->select('id','name','address','mobile','email');
    }
}
