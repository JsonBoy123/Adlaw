<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Model;

class InvoicePayment extends Model
{
    protected $table= 'invoice_payment';
    protected $guarded = ['reciept_no','invc_id','user_id','amount','receiving_date','payment_mode','reference_number','remark','cheque_no'];
    protected $primaryKey = null;
    public $incrementing = false;

    public function invoice(){
    	return $this->belongsTo('App\Models\Invoice\InvoiceMast1','invc_id','invc_id')->select('cust_name');
    }

}
