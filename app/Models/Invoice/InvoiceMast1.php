<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class InvoiceMast1 extends Model
{
    use SoftDeletes;
    protected $table= 'invoice_mast1';
    protected $guarded = [];
    protected $primaryKey = 'invc_id';

    public function invoice_details()
    {
    	return $this->hasMany('App\Models\Invoice\InvoiceDetails1','invc_id','invc_id');
    }
    public function customer()
    {
    	return $this->belongsTo('App\Models\Customer','cust_id');
    }
    public function user(){
    	return $this->belongsTo('App\User','user_id')->select('id','name','address','mobile','email');
    }

    public function invoice_payments(){
        return $this->hasMany('App\Models\Invoice\InvoicePayment','invc_id','invc_id');
    }
}
