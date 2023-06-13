
<table class="classic table table-striped table-bordered">
    <thead >
    <tr><th colspan="38" style="text-align: center"><b>{{Auth::user()->name}}</b></th></tr>
    <tr><th colspan="38" style="text-align: center"><b>Monthly Attendance</b></th></tr>
    <tr><th colspan="38" style="text-align: center"><b>Month: {{$headerData['monthYear']}}</b></th></tr>
    <tr><th colspan="38" >Filter: Qualification Name : {{$filter['qual']}} || Qualification Catgegory : {{$filter['qual_catg']}} || Batch : {{$filter['batch']}} || Year : {{$filter['semester']}} || Semester : {{$filter['year']}}</th></tr>
     <tr>
            <th colspan="38"></th>
        </tr>
    <tr>
        <th rowspan="2"  style="width: 5% ; color:red">SL</th>
        <th rowspan="2" style="width: 20%">Name</th>
        <th rowspan="2" style="width: 20%">Roll</th>
        <th colspan="{{count($monthDates)}}" style="text-align: center; width:55%" >Day of Month</th>
        <th rowspan="2" style="width: 5%">P</th>
        <th rowspan="2" style="width: 5%">L.P</th>
        <th rowspan="2" style="width: 5%">A</th>
        <th rowspan="2" style="width: 5%">T.P</th>
    </tr>
    <tr>
        @foreach($monthDates as $date => $value)
        <th @if($value['weekend']) class="weekend" @endif style="width: 5%">{{$value['day']}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @php $count =1 ;@endphp
        @foreach($students as $student)
            <tr>
                <td>{{$count++}}</td>
                <td >{{$student->f_name .' '. $student->l_name }}</td>
                <td></td>
                @php
                    $tPresent = 0;
                    $tlPresent = 0;
                    $tabsent = 0;

                @endphp
                @foreach($monthDates as $date => $value)
                    @php
                        $status = '';
                        $color = '';

                        foreach ($student->attendances as $attendance) {
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
                                //if student has present in exam
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
                    <td class="{{$color}}" style="color:red">{{$status}}</td>
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
    <tfoot>
        <tr>
            <td colspan="38"></td>
        </tr>
        <tr>
            <td colspan="38">{{__('Printed By:') .' '. Auth::user()->name}}</td>
        </tr>
    </tfoot>
</table>
