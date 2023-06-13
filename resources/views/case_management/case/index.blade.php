{{-- @extends('lawfirm.main') --}}
@extends('partials.main')
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12 m-auto"  >
      <div class="box box-primary " >
        <div class="box-header with-border"> 	
          <div class="row">
            <div class="col-md-4">
               <h4 id="case_status_label"></h4>
            </div>
          
           <div class="col-md-8">
             @if(Auth::user()->parent_id == null)
              <a href="{{route('case_mast.create', ['cust_id'=>",case_diary"])}}" class="btn btn-md btn-primary pull-right ">Add New Case</a>
              @endif
            </div>
          </div> 
     
          <div class="row">        
              <div class="col-md-3 form-group">
                  <label>Select Client</label>
                    <select class="form-control" name="client">
                      <option value="0">--All--</option>
                     @foreach($clients as $client)
                        <option value="{{$client->cust_id}}">{{$client->cust_name}}</option>
                     @endforeach 
                    </select>
              </div>

                <div class="col-md-3 form-group">
                  <label>Select Court</label>
                    <select class="form-control" name="court">
                     <option value="0">--All--</option>  
                     @foreach($courts as $court)
                        <option value="{{$court->court_type}}">{{$court->court_type_desc}}</option>
                     @endforeach 
                  </select>
                </div>
                 <div class="col-md-3 form-group">
                  <label>Select Case Type</label>                    
                    <select class="form-control" name="case_type_id">
                      <option value="0">--All--</option>
                      @foreach($case_types as $case_type)

                      <option value="{{$case_type->case_type_id}}" >{{$case_type->shrt_desc}} ({{$case_type->case_type_desc}})</option>                      
                      @endforeach
                    </select>
                  </div>
                <div class="col-md-2 form-group">
                  <label>Select status</label>
                    <select class="form-control" name="case_status">
                      <option value="0">--All--</option>
                        @foreach($case_status as $case_statu)
                      <option value="{{$case_statu->case_status_id}}" {{$case_statu->case_status_id == 'cr' ? 'selected' : ''}}>{{$case_statu->case_status_desc}}</option>
                   @endforeach 
                    
                    </select>
                </div>
                <div class="col-md-1 form-group " style="padding-top:25px ">
                      <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="filterBtn">Filter</a>
                </div>
            <div class="col-md-12">

                @if($message = Session::get('success'))
                  <div class="alert bg-success">
                      {{$message}}
                  </div>
                @endif  
            </div>
          </div>
            
        </div>
        <div class="box-body table-responsive" id="table_div">
   
        </div>
        </div>
      </div>
    </div>

  </section>
<script>
	$(document).ready(function (){
      var case_status =  $('select[name="case_status"] option:selected').val();
      var case_status_text =  $('select[name="case_status"] option:selected').text();
      


      $(document).on('click','#filterBtn',function(e){
         e.preventDefault();
         var client_id = $('select[name="client"] option:selected').val();
         var court = $('select[name="court"] option:selected').val();
         var case_type_id = $('select[name="case_type_id"] option:selected').val();
         var case_status = $('select[name="case_status"] option:selected').val();
         $.ajax({
            type:"POST",
            url: "{{route('case_filter')}}",
            data:{client_id:client_id,court:court,case_type_id:case_type_id,case_status:case_status},
            success:function(res){
              var case_text = case_status_text + ' Cases';
      $('#case_status_label').empty().html(case_text);
      $('#table_div').empty().html(res);
              
               // console.log(res);
            }
         });

      });

      if(case_status !=''){
        var cust_id ='';
        case_table(case_status,case_status_text,cust_id);
        // $('select[name="case_status"]').on('change',function(){
        //   var case_status = $(this).val();
        //   var case_status_text = $('select[name="case_status"] option:selected').text();

        //   case_table(case_status,case_status_text,cust_id);
        // });
      }
   
});
</script>
@endsection