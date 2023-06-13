<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Print</title>
    <link rel="stylesheet" hr/ef="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" hr/ef="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        @page { size: auto;  margin: 0mm; }
    .invoice-box {
        max-width: 900px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    .invoice-box table{
        width: 100%;
    }
    .invoice-box table tr td {
        line-height: 25px;
    }
    .billed-info{
        width:50%;
        text-align: left;
    }
    .invoice-details{
        width: 50%;

        text-align:  right;
    }
    .invoice-title{
        width: 50%;
        text-align: right;
        font-weight: bold;
    }
    .invoice-logo img{
        width: 80px;

    }
    .invoice-logo{
        width: 100%;
        
    }
    .row{
        width: 100%;
        margin-bottom: 10px;
    }
    .col{
        width: 50%;
    }
    .invoice-table{
        width: 100%;
        margin-top: 10px;
        border:1px solid gray;
    }
    .invc-table-desc{
        width: 50%;
    }
    .invc-net-amnt{
        width: 40%

    }
    .table td{
        padding: 3px !important;
    }
    medium ,b{
        font-size: 14px;
    }
   .table th{
    font-size: 14px;
   }
   .text-r{
   		text-align: right;
   }

   #invoice_dtl_table {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
      margin-top: 5px;
    }

    #invoice_dtl_table td, #invoice_dtl_table th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    #invoice_dtl_table th:first {
      text-align: left;
    }
    .text-capitalize{
        text-transform: capitalize;
        font-weight: 700;
    }
    .invoice-heading{
        text-align: center;
    }
    .invoice-heading h2{
        margin-bottom: 0px;
    }


    hr{
        margin-top:3px !important;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table >
            <tr >
                <td colspan="2" class="invoice-heading"><h2>Invoice</h2></td>
            </tr>
            <tr class="row">
                <td class="pl-2 invoice-logo col">
                    <img src="{{asset('images/invoice-logo.jpeg')}}">

                </td>
                <td class="col text-r pt-3">
                    <h5 class='font-weight-bold'>{{auth()->user()->name}}
                        <br>
                    {{ Auth::user()->email}}                   
                    </h5>
                   
                    
                </td>
            </tr>
            <tr class="row">
                <td class="billed-info col">
                   {!! "<b>Billed To:</b> <br/>
                    Name    : $invoice->cust_name <br/>
                    Email   : $invoice->cust_email<br/>
                    Mobile  : $invoice->cust_mobile<br/>
                    Address : $invoice->cust_addr<br/>" !!}
                </td>
                
                <td class="invoice-details col">
                    <br/>
                    Invoice Number : INV-{{$invoice->invc_numb}}<br/>
                    Invoice Date: {{date('d-M-Y',strtotime($invoice->invc_dt))}}<br/>
                    Invoice Due Date: {{date('d-M-Y',strtotime($invoice->invc_due_dt))}}<br/>                    
                </td>
            </tr>            
        </table> 
        <table class="table" id="invoice_dtl_table">
            <thead>
                <tr>
                    <th class="invc-table-desc">Description</th>
                    @if($invoice->tax_type !='') 
                        <th>Rate</th>
                        <th>Tax Type</th>
                        <th>Tax (%)</th>
                        <th>Tax Rate</th>
                    @endif
                    <th class="{{$invoice->tax_type =='' ? 'invc-net-amnt text-r' : ''}}">Net Amount (INR)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->invoice_details as $invoice_detail)
                    <tr>
                        <td>
                            {{$invoice_detail->title}}<br/>
                            {{$invoice_detail->description}}
                        </td>
                        @if($invoice->tax_type !='') 
	                        <td class="text-center">{{$invoice_detail->rate}}</td>
	                        <td class="text-center">{{$invoice->tax_type}}</td>
	                        <td class="text-center">{{$invoice_detail->tax_per}}</td>
	                        <td class="text-center">{{$invoice_detail->tax_rate}}</td>

                        @endif
                        <td class="{{$invoice->tax_type =='' ? 'invc-net-amnt text-r' : 'text-center'}}">{{$invoice->tax_type !='' ? ($invoice_detail->rate + $invoice_detail->tax_rate) : $invoice_detail->rate}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>  
        <table class="table no-header no-footer p-0">            
            <tbody>
                <tr>
                    <td class="text-left text-capitalize font-weight-bold">
                        <medium>{{displaywords($invoice->invc_amnt)}}</medium>
                    </td>
                    <td class="text-r">
                        <b>Sub Total (INR) :</b><hr/>
                        @if($invoice->tax_type !='') <b>Total Tax (INR) :</b> <hr/>@endif
                        <b>Total (INR) :</b>
                    </td>
                    <td class="text-center" >
                        {{$invoice->invc_subtotal}}<hr/>
                        @if($invoice->tax_type !='') {{$invoice->tax_rate}}
                        <hr/>@endif
                        {{$invoice->invc_amnt}}
                    </td>
                   
                </tr>               
            </tbody>
        </table>
        <table class="table no-header no-footer pt-2">            
            <tbody>
                <tr>
                    <td class="invc-table-desc">
                        @if($invoice->invc_rem)
                            <b>Terms & Conditions :</b>
                            {!! $invoice->rem !!}
                        @endif
                    </td>
                    <td class="">
                        <p class="mb-4">Signature</p>
                           ________________
                    </td>
                    <td class="text-r">
                        <p class="mb-4">Customer Signature</p>
                          ________________
                    </td>

                </tr>             
            </tbody>
        </table>
    </div>
</body>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</html>
