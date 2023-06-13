
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Reciept</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        @page { size: auto;  margin: 0mm; }
    .invoice-box {
        max-width: 600px;
        margin: auto;
        margin-top: 10px;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 32px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    .invoice-box table{
        width: 100%;
    }
     .row{
        width: 100%;
        margin-bottom: 10px;
    }
    .col{
        width: 100%;
    }
    .col-30{
        padding: 20px;
        width: 30%;
        text-align: left;

    }
    .col-70{
        /*padding: 20px;*/
        width: 70%;
        text-align: right;

    }
    .text-r{
        text-align: right;
    }
    .date, .payment_mode{
        text-align: right;
    }
     @media only screen and (max-width: 600px) {        
        .col-30{
            width: 100%;
        }
        .col-70{
            width: 100%;
            text-align: left;
        }
        .date, .payment_mode{
            text-align: left;
        }
       
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table >           
            <tbody>
                <tr >
                    <td class="col-30">
                        <h2 class="text-success">RECEIPT</h2>
                    </td>
                    <td class="col-70 text-r">
                        <b>Receipt Number :</b> {{$invoice_pay->invc_numb.'-'.$invoice_pay->receipt_no}}
                                      
                    </td> 
                </tr>
                <tr >
                    <td class="col date" colspan="2">
                        <b>Date : </b>{{date('d-m-Y',strtotime($invoice_pay->receiving_date))}} 
                    </td> 
                </tr>
                <tr >
                    <td class="col text-left" colspan="2">
                        <b>From :</b> {{$invoice_pay->invoice->cust_name}} 
                    </td>
                </tr>
                <tr >
                    <td class="col-md-6 text-left">
                        <b>Amount : <i class="fa fa-rupee"></i></b> {{$invoice_pay->amount}}
                    </td>
                    <td class="col-md-6 payment_mode">
                        <b>Payment Mode  :</b> {{Arr::get(PAYMENTMODE,$invoice_pay->payment_mode)}} 
                    </td>
                </tr>
                @if($invoice_pay->reference_number)
                    <tr >
                        <td class="col text-left" colspan="2">
                            <b>Reference Number :</b> {{$invoice_pay->reference_number}}
                        </td>
                    </tr> 
                @endif
                @if($invoice_pay->cheque_no)
                    <tr >
                        <td class="col text-left" colspan="2">
                            <b>Cheque Number :</b> {{$invoice_pay->cheque_no}}
                        </td>
                    </tr> 
                @endif
                <tr >
                    <td class="col text-left" colspan="2">
                        <b>For Invoice :</b> {{$invoice_pay->invc_numb}}
                    </td>
                </tr> 
                <tr >
                    <td class="col text-left" colspan="2">
                        <b>Remark :</b> {{$invoice_pay->remark}}
                    </td>
                </tr>
                <tr >
                    <td class="col text-right text-r" colspan="2">
                        <b>Singature </b>
                        <br/>
                        _________________
                    </td>
                </tr>
            </tbody>
        </table> 
    </div>
</body>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@if($print == 'yes')
  <script>
        window.print();
  </script>
@endif
</html>
