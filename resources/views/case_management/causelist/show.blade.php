@if(count($cause_lists) !='0')
<div align="left" style="font-size:12px;"><font color=#bb0000 face="Verdana, Arial, Helvetica, sans-serif"><b>Causelist for Lawyer Name like <u>{{Auth::user()->name}}</u> dated <u>{{date('d-m-Y',strtotime($hearing_date))}}</u></b></font></div>
<br>
   <table  width="100%" border="0" cellpadding="0" cellspacing="0" ></table>
   @php $count = 1; @endphp
   @foreach($cause_lists as $cause_list)
   <table  width="100%" border="1" cellpadding="0" cellspacing="0" class="mytable">
      <thead>
         <tr  align="left">
            <th colspan="5" height="25px"><br>              
               <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CAUSE LIST FOR <font color="red">{{Arr::get(weekDay,date('D')).', '.date('d-m-Y',strtotime($cause_list->hearing_date))}}</font></b>
               {{-- <a href="" class="pull-right btn btn-sm btn-success">Edit</a> --}}
            </th>
         </tr>
         <tr  align="left">
            <th colspan="4" height="25px"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {{$cause_list->judge_name}}</b></th>
            <th height="25px" align="right"><b>{{strtoupper($cause_list->bench)}} BENCH&nbsp;&nbsp;&nbsp;<br><span style='color: red'>{{$cause_list->hearing_place}}</span></b></th>
         </tr>
         <tr align="center">
            <th colspan="5" align="center">
               <hr class="myhr">
            </th>
         </tr>
         <tr  height="20px" style="font-weight:bold">
            <th align="center" width="5%">S.No.</th>
            <th width="5%">C.L.No.</th>
            <th width="20%">Case No.</th>
            <th width="30%">Petitioner Vs. Respondent</th>
            <th width="35%">Advocates for Pet./Res.</th>
         </tr>
         <tr align="center">
            <th colspan="5" align="center">
               <hr class="myhr">
            </th>
         </tr>
      </thead>
      <tr valign="top">
         <td colspan="5" align="center"><b><u>{{$cause_list->type}} HEARING</b></u></td>
      </tr>
      <tr valign="top">
         <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$cause_list->case_status}}</td>
      </tr>
      <tr valign="top">
         <td align="center">{{$count++}}</td>
         <td align="center">{{$cause_list->causelist_no}}</td>
         <td>
            {{-- <a style="cursor:pointer;"  rel="lightbox" href="https://mphc.gov.in/php/hc/casestatus/casestatus_pro.php?id=IND&opt=1&lst_case=13&txtno=509&txtyear=2019&f=0.2222&csrf_token=8b6f3916bd72544a11b903ac8a5ab09e6d6b7777"> --}}
            {{$cause_list->case_no}}
         {{-- </a> --}}
       </td>
         <td><span style="background-color:#F0E9F9;"> {{$cause_list->petitioner}}</span></td>
         <td><span style="background-color:#F0E9F9;">@php
          echo str_replace(',','<br>', $cause_list->advocate_pet);
         @endphp </br></span></td>
      </tr>
      <tr valign="top">
         <td align="center"></td>
         <td></td>
         <td align="right">Vs.&nbsp;&nbsp;</td>
         <td><span style="background-color:#F9EBEB;">{{$cause_list->respondent}}</span></td>
         <td><span style="background-color:#F9EBEB;"> @php
          echo str_replace(',','<br>', $cause_list->advocate_res);
         @endphp </span></td>
      </tr>
      <tr valign="top">
         <td align="center"></td>
         <td></td>
         <td></td>
         <td colspan="2">{{$cause_list->case_info}}
         </td>
      </tr>
      <tr align="center">
         <td colspan="5">
            <hr class="myhr">
         </td>
      </tr>
      <tfoot class="myclass">
         <tr  align="left">
            <th colspan="5"><b></b></th>
         </tr>
      </tfoot>
   </table>
   @endforeach
</div>
@else
   <h4 class="text-muted"><b>Not Found</b></h4>
@endif