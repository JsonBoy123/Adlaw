{{-- @extends('lawfirm.main') --}}
@extends('partials.main')
@section('content')
<section class="content">
<div class="row">
    <div class="col-md-7">
        <div class="box box-primary ">
          <div class="box-header with-border"> 
          <h3 class="box-title">
            {{-- Select which practicing courts you have work --}}
            Select Working Courts
          </h3>
          </div>
          <div class="box-body">
            <div class="row form-group" style="margin-top: 10px;">
              <div class="col-md-6">
                <label>State Name</label>
                <select class="form-control" name="state_code" id="state">
                    <option value="0">Select State</option>
                    @foreach($states as $state)
                      <option value="{{$state->state_code}}" {{$state->state_code == 10 ? 'selected' : ''}}>{{$state->state_name}}</option>
                    @endforeach
                  
                </select>
              </div>
            <div class="col-md-6" style="margin-top: 10px;">
                <label>Court Type Name</label>
                <select class="form-control" name="court_type" id="courtType">
                    <option value="0">Select Court Type</option>
                    
                </select>
              </div>
            </div>


              <div class="parts-selector" id="parts-selector-1">
                  <div class="parts list h-40vh">
                    <h3 class="list-heading top-fixed">All Practicing Courts</h3>
                    <ul id="practice_court">
                    
                      <li>
                          <input type="hidden" name="valuCourt[]" value="" id="valuCourt">Select working Courts
                      </li>
                    
                    </ul>
                  </div>
                  <div class="controls">
                      <a class="moveto selected"><span class="icon"></span><span class="text">Add</span></a>
                      <a class="moveto parts"><span class="icon"></span><span class="text">Remove</span></a>
                      </div>
                      <div class="selected list">
                        <h3 class="list-heading">Your Practicing Court</h3>
                      
                        <ul id="lcourt">
                          @foreach($lawyerCourt as $courts)
                            <li ><input type="hidden" name="valuCourt[]" value="{{$courts->court_catg->court_code}}" id="valuCourt">{{$courts->court_catg->court_name}} at {{$courts->court_catg->city_name}}
                            </li>
                          @endforeach
                        </ul>
                      </div>
              </div>
              <button class="btn btn-sm btn-primary" id="submit">Submit</button>

            </div>  
        </div>
    </div>
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border ">
              <h3 class=" box-title">Working Courts</h3>
            </div>
            <div class="box-body" style="height: 450px; overflow-y: scroll;">
              @foreach($lawyerCourt as $courts)
              <p class="m-1"><i class="fa fa-gavel" aria-hidden="true"></i>&nbsp; {{$courts->court_catg->court_name}} at {{$courts->court_catg->city_name}}                
              </p>
              @endforeach
            </div>
        </div>
    </div>
</div>
</section>


<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
         $(function() {
        $( "#parts-selector-1" ).partsSelector();

      });
      
      var city_code = '';
      var court_id = '#courtType';
      var state_code = $('#state').val();
      var court_type = '1';
      state_city_court(city_code,state_code,court_id,court_type);
      court_fetch(court_type);

      $('#state').on('change',function(){
          var state_code = $(this).val();
          state_city_court(city_code,state_code,court_id);
      });

       $('#courtType').on('change',function(){
          var court_type = $(this).val();
          court_fetch(court_type);

       })

      function court_fetch(court_type){
        var state_code = $('#state').val();
          
            $.ajax({
              type:'GET',
              url:"/user_court_list?court_type="+court_type+'&state_code='+state_code,
              success:function(res){
                if(res){
                  $('#practice_court').empty();
                  $.each(res, function(i,v){
                    // console.log(v)
                    $('#practice_court').append('<li><input type="hidden" name="valuCourt[]" value="'+v.court_code+'" id="valuCourt">'+v.court_name+' at '+v.city_name+'</li>');
                  });

                }else{
                  $('#practice_court').empty();
                }
              }
            });
      }






       $('#submit').on('click',function(e){
          e.preventDefault();
          var courts = $("#lcourt input[name='valuCourt[]']")
                .map(function(){return $(this).val();}).get();
          
          if(courts != ''){
            $.ajax({
              type:'POST',
              url:"{{route('practicing_court.store')}}",
              data: {court:courts},
              success:function(data){
                swal({
                    text: data,
                    icon : 'success',
                  });
                  setTimeout(function(){// wait for 5 secs(2)
                     location.reload(); // then reload the page.(3)
                  }, 3000); 
              }
            });
          }
          else{
            swal({
                text: 'Add Practicing Court',
                icon : 'warning',
              });
              setTimeout(function(){// wait for 5 secs(2)
                 location.reload(); // then reload the page.(3)
              }, 3000); 
            
          }
        });


    });
</script>
@endsection