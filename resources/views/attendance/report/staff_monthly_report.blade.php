<!DOCTYPE html>
<html>
<head>
    <title>Staff Monthly Attendance</title>
      <link rel="stylesheet" href="{{asset('adlaw_files/css/bootstrap.min.css')}}">
    <style type="text/css">
 
.red,
.weekend {
 color:red
}
.green {
 color:green
}
.holiday {
 color:#983d8b
}
.blue {
 color:#00f
}
.text-bold {
 font-weight:700
}
@media print {
 body {
  margin:0;
  padding:0
 }
 .no-print {
  display:none!important
/* }
 @page {
  size:A4 portrait;
  margin:2mm;
  margin-bottom:20px
 }*/
 * {
  -webkit-print-color-adjust:exact!important;
  color-adjust:exact!important
 }
}

  </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
            <div class="col-md-12">
               <h4>
 <p class="pull-right">Print Date: {{date('d-m-Y')}}</p></h4>
            </div>
        <div class="col-md-12 text-center">

            <h3>{{Auth::user()->name}}</h3>
            <h4>Monthly Attendance</h4>
            <h4>Month: {{$headerData['monthYear']}}</h4>
        </div>
        <div class="col-md-12">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="classic table table-striped table-bordered">
                <thead >
                <tr>
                    <th width="5%" rowspan="2" >SL</th>
                    <th width="10%" rowspan="2">Name</th>
                    <th width="55%" colspan="{{count($monthDates)}}">Day of Month</th>
                    <th width="5%" rowspan="2">P</th>
                    <th width="5%" rowspan="2">L.P</th>
                    <th width="5%" rowspan="2">A</th>
                    <th width="5%" rowspan="2">T.P</th>
                </tr>
                <tr>
                    @foreach($monthDates as $date => $value)
                    <th @if($value['weekend']) class="weekend" @endif>{{$value['day']}}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td></td>
                            <td >{{$user->name}}</td>
                            @php
                                $tPresent = 0;
                                $tlPresent = 0;
                                $tabsent = 0;

                            @endphp
                            @foreach($monthDates as $date => $value)
                                @php
                                    $status = '';
                                    $color = '';

                                    foreach ($user->attendances as $attendance) {
                                        if($date == $attendance->attendance_date && $attendance->present == 'P'){
                                            
                                                $status = 'P';
                                                $tPresent++;
                                                $color = 'green';
                                            
                                        }
                                        elseif($date == $attendance->attendance_date && $attendance->present == 'A' && !$value['weekend']){
                                            $status = 'A';
                                            $tabsent++;
                                            $color = 'red';
                                        }

                                    }
                                      

                                         if(isset($academic_dates[$date])) {
                                            //if staff has present in exam
                                            if($academic_dates[$date] == 'E' && ($status == 'P' || $status == 'A')){
                                                if($status == 'P'){
                                                    $status .= $academic_dates[$date];
                                                }

                                                if($status == 'A'){
                                                     $tabsent--;
                                                    $status = $academic_dates[$date];
                                                    $color = 'holiday';
                                                }

                                            }
                                            elseif($value['weekend'] != '1'){
                                                $status = $academic_dates[$date];
                                                $color = 'holiday';
                                            }

                                         }



                                    if($value['weekend'] ){
                                            $status .= 'W';
                                            $color = 'weekend';
                                    }
                                @endphp
                                <td class="{{$color}}">{{$status}}</td>
                            @endforeach
                           <td>
                                {{($tPresent-$tlPresent)}}
                            </td>
                            <td>
                               {{$tlPresent}}
                            </td>
                            <td>
                                {{$tabsent}}
                            </td>
                            <td>
                                {{$tPresent}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <h5>{{__('Printed By:') .' '. Auth::user()->name}}</h5>
        </div>
    </div> 
   {{--  <div class="row">
        <div class="col-md-12">
            <a href="{{route('attendance.download')}}" class="btn btn-sm btn-primary">Generate pdf</a>
        </div>
    </div> --}}
</div>
</body>
</html>
