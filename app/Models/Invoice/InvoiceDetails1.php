<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails1 extends Model
{
    protected $table= 'invoice_details1';
    protected $fillable = ['invc_id','title','description','tax_type','tax_per','invc_rate','rate'];
    protected $primaryKey = null;
    public $incrementing = false;

}
