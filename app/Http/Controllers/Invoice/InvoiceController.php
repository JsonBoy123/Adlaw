<?php

namespace App\Http\Controllers\Invoice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Notification;
use App\User;
use App\Models\Service\ServiceMast;
use App\Models\Service\ServiceCatgMast;
use App\Models\Service\ServiceClientMast;
use App\Notifications\Notifications;
use App\Models\Customer;
use App\Models\Invoice\InvoiceMast;
use App\Models\Invoice\InvoiceMast1;
use App\Models\Invoice\InvoiceDetails;
use App\Models\Invoice\InvoiceDetails1;
use App\Models\Invoice\InvoicePayment;
use PDF;
use Input;
class InvoiceController extends Controller
{
    public function index(){
      $invoices =  InvoiceMast1::where(['user_id' => Auth::user()->id,'invc_type' => 'Service'])->orderBy('invc_numb','desc')->get();  
    	return view('invoice.index',compact('invoices'));
    }
    public function case_related_index(){

      $invoices =  InvoiceMast::where(['user_id' => Auth::user()->id,'invc_type' => 'Case'])->orderBy('invc_dt','desc')->get();  
      return view('invoice.case_related_index',compact('invoices'));
    }
    public function create(){
       
       $invoice = InvoiceMast1::where(['user_id'=>Auth::user()->id,'year' => date('Y'), 'month' => date('m')])->latest()->first();

          if(!empty($invoice)){
              $last_invc_no = $invoice->invc_numb + 1;
          }else{
              $last_invc_no = date('Y').date('m').str_pad((1), '4', '0', STR_PAD_LEFT);
          }
          
      //  $this->invoice_session_delete();
        
    	 // $service_catgs = ServiceCatgMast::orderBy('service_catg_desc')->get();
    	 // $clients = user_clients()->get();  
    	// return view('invoice.create',compact('service_catgs','clients'));
    	
      $clients = user_clients()->select('cust_id','cust_name')->get();  
      return view('invoice.invoice.create',compact('clients','last_invc_no'));

    }
    public function invoice_create(){
      $clients = user_clients()->select('cust_id','cust_name')->get();  
      return view('invoice.invoice.create',compact('clients'));
    }
    public function invoice_store(Request $request){
        $invc_numb = $request->invc_num;
        $invc_mast = [
            'invc_numb'    => $invc_numb,
            'user_id'      => Auth::user()->id,
            'invc_type'    => 'Service',
            'cust_id'      => $request->cust_id, 
            'cust_name'    => $request->cust_name, 
            'cust_email'   => $request->cust_email, 
            'cust_mobile'  => $request->cust_mobile, 
            'cust_addr'    => $request->cust_addr, 
            'invc_dt'      => $request->invc_date,
            'invc_due_dt'  => $request->invc_due_date,
            'tax_type'     => $request->tax_type,           
            'invc_rem'     => $request->invc_rem,
            'tax_rate'     => $request->tax_amount,
            'invc_subtotal'=> $request->subtotal,
            'invc_amnt'    => $request->total,
            'invc_due_amnt'=> $request->total,
            'year'         => date('Y'),
            'month'        => date('m')
        ];

        $invc_id = InvoiceMast1::create($invc_mast)->invc_id;

        foreach ($request->desc_title as $key => $desc_title) {
            $invc_details = [
                'invc_id'     => $invc_id,
                'title'       => $desc_title,
                'description' => $request->description[$key],
                'tax_type'    => $request->tax_t[$key],
                'tax_per'     => $request->tax_per[$key],
                'tax_rate'    => $request->tax_rate[$key],
                'rate'        => $request->desc_amount[$key],
            ];

            InvoiceDetails1::insert($invc_details);
        }


       return redirect()->route('invoice.index')->with('success','Invoice Created Successfully.');

    }

    public function store(Request $request){

      // return $request->all();
    	    $request->validate([
                'cust_id' => 'required|not_in:""',
                'payment_mode' => 'nullable|not_in:"0"'
          ]);

          $invoice_services = session('invoice_services') !=null ? session('invoice_services') : [];
          if(count($invoice_services) == 0){
            return back()->with('error','Please add services.');
          }
          
          if($request->cust_id !='0'){
            $cust_name = Customer::select('cust_id','cust_name')->where('cust_id',$request->cust_id)->first()->cust_name;
          }else{
              $cust_name = $request->cust_name;
          }  


          $invoice = InvoiceMast::latest()->first();
          if(!empty($invoice)){
              $last_id = (string)(int)substr((string)$invoice->invc_numb,'8','16') + 1;
          }else{
                $last_id = '1';

          } 
          $invc_numb = date('Y').str_pad(date('m'), '4','0',STR_PAD_LEFT).str_pad($last_id, '8', '0', STR_PAD_LEFT);
           // return $invc_numb;
          ;
          $payment_mode = $request->payment_mode;
          $cash_amnt = $payment_mode == '1' ? $request->cash_amnt : ($payment_mode == '4' ? $request->cash_amnt : '0');
          if($payment_mode == '2' || $payment_mode == '4'){
              $cash_chq_amount = (float)$request->cheque_amnt + (float)$cash_amnt ;
              if($cash_chq_amount != session('invc_amnt')){
                return back()->with('error','cash & cheque amount is not equal to total_amount.');
              }
              $request->validate([
                  'cheque_no' => 'required',
                  'bank_name' => 'required',
                  'cheque_amnt' => 'required|not_in:"0"',
                  'cheque_date' => 'required',
              ]);

              $bank_name   = $request->bank_name;
              $cheque_no   = $request->cheque_no;
              $cheque_date = $request->cheque_date;
              $cheque_amnt = $request->cheque_amnt;

          }else{
              $bank_name   = null;
              $cheque_no   = null;
              $cheque_date = null;
              $cheque_amnt = '0';
          }

          if($payment_mode == '3' || $payment_mode =='5'){
              $transcation_id = $request->transcation_id;
          }else{
              $transcation_id = null;
          }

          $invoiceMastdata = [
                'invc_numb'     => $invc_numb,
                'invc_dt'       => date('Y-m-d'),
                'user_id'       => Auth::user()->id,
                'cust_id'       => $request->cust_id,
                'cust_name'     => $cust_name,

                'service_amnt'  => (float)session('service_amnt'),
                'discount'      => (float)session('discount'),
                'gst'           => (float)session('gst'),
                'gst_rate'      => (float)session('gst_rate'),
                'invc_amnt'     => (float)session('invc_amnt'),
                'invc_rem'      => $request->invc_rem,
                'payment_mode'  => $payment_mode,
                'cash_amnt'     => $cash_amnt,
                'cheque_amnt'     => $cheque_amnt,
                'cheque_no'       => $cheque_no,
                'bank_name'       => $bank_name,
                'cheque_date'     => $cheque_date,
                'transcation_id'  => $transcation_id,
                'payee_name'      => $request->payee_name

          ];
          // return $invoiceMastdata;
          InvoiceMast::create($invoiceMastdata);

          foreach ($invoice_services as $invoice_service) {

               $invoiceDetails = [
                    'invc_numb'         => $invc_numb,
                    'client_service_id' => $invoice_service['client_service_id'],
                    'service_code'      => $invoice_service['service_code'],
                    'service_rate'      => $invoice_service['service_rate'],
                    'service_discount'  => $invoice_service['service_discount'],
                    'quantity'          => $invoice_service['quantity'],
                    'unit_code'         => '1',
                    'service_amnt'      => $invoice_service['service_total']
               ];

                InvoiceDetails::insert($invoiceDetails);
          }

            // SESSION DESROY
          $this->invoice_session_delete();


          return redirect()->route('invoice.show',$invc_numb);
    }
    public function show($invc_numb){
        $print = 'no';
        if(Input::get('print')){
          if(Input::get('print') == 'yes'){
              $print = 'yes';
          }
        }

        $invoice =  InvoiceMast1::with(['invoice_details'])->where(['invc_numb' => $invc_numb,'user_id'=>Auth::user()->id])->first();  
        // return $invoice->invoice_details;      
        if(!empty($invoice)){
        return view('invoice.invoice_page',compact('invoice','print'));

        }else{
          return view('error_pages.404page');
        }

        // $invoice =  InvoiceMast::with(['invoice_details.service','customer','user'])->where('invc_numb',$invc_numb)->first();  
        // // return $invoice;      
        // return view('invoice.invoice_generate',compact('invoice'));

    }
    public function invoice_test($invc_numb){

        $invoice =  InvoiceMast1::with(['invoice_details'])->where(['invc_numb' => $invc_numb,'user_id'=>Auth::user()->id])->first();  
        // return $invoice->invoice_details;      
        if(!empty($invoice)){
        return view('invoice.invoice_page',compact('invoice'));

        }else{
          return view('error_pages.404page');
        }

    }
    public function payment_receive(Request $request){      

      $data = [
        'invc_id'         => $request->invc_id,
        'user_id'         => auth()->user()->id,
        'amount'          => $request->amount,
        'receiving_date'  => $request->rece_date,
        'payment_mode'    => $request->payment_mode,
        'reference_number'=> $request->ref_number,
        'remark'          => $request->remark,
        'cheque_no'       => $request->cheque_no
      ];
      $invoice =  InvoiceMast1::find($request->invc_id);

      if($invoice->invoice_payments !=null){
        $receipt = collect($invoice->invoice_payments)->max('receipt_no') + 1; 
      }else{
        $receipt = 1;
      }

      $data['receipt_no'] = str_pad($receipt, '2', '0', STR_PAD_LEFT); 
      $data['invc_numb'] = $invoice->invc_numb; 
      InvoicePayment::insert($data);

      $invoice->decrement('invc_due_amnt',$request->amount);
      $invc_data = [
        'invc_paid_amnt' => $request->amount,
      ];
      if($invoice->invc_due_amnt == '0'){
          $invc_data['status'] = '1';
      }else{
          $invc_data['status'] = '2';
      }
      $invoice->update($invc_data);
      return redirect('/invoice/receipt/'.$invoice->invc_numb.'/'.$data['receipt_no']);

    }

    public function payment_receipt($invc_numb,$receipt_no){
        $print = 'no';
        if(Input::get('print')){
          if(Input::get('print') == 'yes'){
              $print = 'yes';
          }
        }
        // return $invc_numb;
        $invoice_pay = InvoicePayment::where(['invc_numb' => $invc_numb,'receipt_no' => $receipt_no, 'user_id' => auth()->user()->id])->first();

        return view('invoice.payment_receipt',compact('invoice_pay','print'));
    }

    public function payment_history(Request $request){
        // return $invc_numb;
      $invoice_paids =  InvoicePayment::where('invc_id',$request->invc_id)->get();
      return view('invoice.payment_history_table',compact('invoice_paids'));
    }


    public function download($invc_numb){

        $invoice =  InvoiceMast1::with(['invoice_details'])->where(['invc_numb' => $invc_numb,'user_id'=>Auth::user()->id])->first();
        
        // return $invoice;
        $pdf = PDF::loadView('invoice.invoice.invoice_download', [ 'invoice' => $invoice]);
        $file_name = 'invoice-'.$invc_numb.'.pdf';
        return $pdf->download($file_name);     
      
    } 
    public function invoice_payment_receipt_download($invc_numb,$receipt_no){

        $invoice_pay = InvoicePayment::where(['invc_numb' => $invc_numb,'receipt_no' => $receipt_no, 'user_id' => auth()->user()->id])->first();
        // return $invoice;
        $pdf = PDF::loadView('invoice.payment_receipt', [ 'invoice_pay' => $invoice_pay,'print' => 'no']);
        $file_name = 'invoice-'.$invoice_pay->invc_numb.'-'.$invoice_pay->receipt_no.'.pdf';
        return $pdf->download($file_name);     
      
    }
    public function edit($id){

    }
    // public function invoice_service_add(Request $request){  
    //   $service_amnt = 0;
    //   $gst = '18';
    //   $discount = '0';
    //   $quantity = 1;
    //   //session()->put('service_code',$request->service_code);

    //   $clientService =  ServiceClientMast::with('service_mast')->where('id',$request->service_code)->first();
    //   $invoice_services =  session('invoice_services') !=null ? session('invoice_services') : [];
    //   $quantity = 1;

    //   //create service session

    //   if(isset($invoice_services[$clientService->id])){
    //     $quantity = $invoice_services[$clientService->id]['quantity'] +1;

    //   }

    //   $service_rate = $clientService->service_rate * $quantity;
    //   $service_discount = $clientService->service_discount * $quantity;

    //   $invoice_services[$clientService->id] = [
    //     'client_service_id' => $clientService->id,
    //     'service_code'      => $clientService->service_code,
    //     'service_name'      => $clientService->service_mast->service_desc,
    //     'service_rate'      => $clientService->service_rate,
    //     'service_discount'  => $service_discount,
    //     'service_total'     => (float)$service_rate - (float)$service_discount,
    //     'quantity'          => $quantity,
    //   ];
    //   session()->put('invoice_services',$invoice_services);

    //   $service_amnt = collect($invoice_services)->sum('service_total');
    //   $service_discount = collect($invoice_services)->sum('service_discount');

    //   $this->service_total($service_amnt,$gst,$discount);

    //   return view('invoice.service_add_table');
        	
    // }

    // public function invoice_service_update(Request $request){
    //    $client_service_id = $request->client_service_id;

    //    if($request->flag == 'quantity'){

    //         $clientService =  ServiceClientMast::with('service_mast')->find($client_service_id);

    //         $invoice_services = session('invoice_services');
    //         session()->put('service_amnt',session('service_amnt') - $invoice_services[$client_service_id]['service_total']);

    //         $invoice_services[$client_service_id]['service_rate'] = $clientService->service_rate ;
    //         $invoice_services[$client_service_id]['service_discount'] = $clientService->service_discount * $request->quantity ;
    //         $invoice_services[$client_service_id]['quantity'] = $request->quantity;


    //         $invoice_services[$client_service_id]['service_total'] = ((float)$invoice_services[$client_service_id]['service_rate'] * $request->quantity) - ((float)$invoice_services[$client_service_id]['service_discount']  );

    //         $service_amnt = session('service_amnt') + $invoice_services[$client_service_id]['service_total'];

    //         $this->service_total($service_amnt,session('gst'),session('discount'));

    //         session()->put('invoice_services',$invoice_services);

    //    }elseif($request->flag == 'gst'){
    //         $this->service_total(session('service_amnt'),$request->gst,session('discount'));

    //    }elseif($request->flag =='discount'){
    //         $this->service_total(session('service_amnt'),session('gst'),$request->discount);
    //    }
    //    return view('invoice.service_add_table');

    // }


    // public function service_add_update($request,$service_amnt=0,$gst =18,$discount = 0,$quantity = 1){

    //     if($request->service_code !=''){
    //         $clientServices =  ServiceClientMast::with('service_mast')->whereIn('id',$request->service_code)->where(['status' => 'A'])->get();
           
    //         $invoice_services =  [];
           
    //             foreach ($clientServices as $clientService) {
                   
    //                 $service_rate = $clientService->service_rate * $quantity;
    //                 $service_discount = $clientService->service_discount * $quantity;

    //                 $invoice_services[$clientService->service_code] = [

    //                     'service_code' => $clientService->service_code,
    //                     'service_name' => $clientService->service_mast->service_desc,
    //                     'service_rate' => $clientService->service_rate,
    //                     'service_discount' => $clientService->service_discount,
    //                     'service_total' => (float)$service_rate - (float)$service_discount,
    //                     'quantity' => '1',
    //                 ];

                  

    //                 $service_amnt = (float)$service_amnt + ((float)$service_rate - (float)$service_discount);
                   
    //             }
                
    //          session()->put('invoice_services',$invoice_services);
           
    //         $this->service_total($service_amnt,$gst,$discount);


    //     }else{
    //         session()->forget('invoice_services'); 
    //     }
        
    // }  


    // function service_total($service_amnt,$gst,$discount){

    //     session()->put('service_amnt',$service_amnt);
    //     session()->put('gst',$gst);
    //     $gst_rate = (float)$service_amnt * $gst / 100;

    //     session()->put('gst_rate',$gst_rate);
    //     session()->put('discount',$discount);

    //     $invc_amnt = ((float)$service_amnt +  (float)$gst_rate) - $discount;
    //     session()->put('invc_amnt',$invc_amnt); 
    // }  
 
    // function invoice_session_delete(){
    //   session()->forget('invoice_services');
    //   session()->forget('invc_amnt');
    //   session()->forget('service_amnt');
    //   session()->forget('gst');
    //   session()->forget('gst_rate');
    //   session()->forget('service_discount');
    // }

    // public function invoice_service_delete($client_service_id){
    //     session()->forget('invoice_services.'.$client_service_id);

    //      $invoice_services =  session('invoice_services') !=null ? session('invoice_services') : [];

    //      if(count($invoice_services) !='0'){
    //         $service_amnt = collect($invoice_services)->sum('service_total');
    //         $service_discount = collect($invoice_services)->sum('service_discount');

    //         $this->service_total($service_amnt,session('gst'),session('discount'));
    //      }else{
    //         $this->invoice_session_delete();
    //      }
    //     return view('invoice.service_add_table');
    //     //$this->service_total($service_amnt,session('gst'),session('discount'));
    //     //session()->put('invoice_services',$invoice_services);
    // }
}
