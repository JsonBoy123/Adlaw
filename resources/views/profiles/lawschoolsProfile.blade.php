@extends('layouts.default')
@section('content')
<style >
  .profile-img{
  width:100%;
  height:100%;
  border: 2px solid;
  padding: 7px;
  border-radius: 6%;
}
.animated {
-webkit-transition: height 0.2s;
-moz-transition: height 0.2s;
transition: height 0.2s;
}

p.stars  i
{
   
    color: chocolate;
}
</style>
@include('layouts.hero_section')
<div class="container container-div">
   <div class="row ">
      <div class="col-sm-12 col-md-12 col-xl-12 text-center mb-2 h2-text">
            <h2 class="font-weight-bold text-center text-uppercase text-white">Law Schools Profile</h2>   
                
        </div>
      </div>
 <div class="row mt-4">
      <div class="col-sm-12 col-xs-12 col-md-3 col-xl-3 col-lg-3"> 
          @if($userData->photo !='')<img  title="{{$userData->name}}" src="{{asset('storage/profile_photo/'.$userData->photo)}}" alt="image" class="img-responsive w-100 h-100 profile-img"> 
          @else
          <img title="{{$userData->name}}" src="{{asset('storage/profile_photo/default.png')}}" alt="image" class="img-responsive profile-img"> 
          @endif
      </div>

      <div class="col-sm-12 col-md-8 col-xs-12">
          <h2 class="font-weight-bold" style="margin-top: 12px !important ">{{$userData->name}} </h2>
                {{--   <span class="chat_icon text-primary " style="font-size:18px;float:right;">
                    @if(Auth::user())

                      @if(Auth::user()->user_catg_id ==3 || Auth::user()->user_catg_id ==4)

                      @else
                        <a onclick="loginChecked('{{ $userData->id }}')" style="text-decoration: none" ><i class="fa fa-envelope"></i> Message</a>
                      @endif
                      @else
                        <a onclick="loginChecked('{{ $userData->id }}')" style="text-decoration: none" ><i class="fa fa-envelope"></i> Message</a>
                    
                    @endif

                  </span> --}}
            
            
            <!-- Start Rating-->
            <div class="rating">
              <span class="star-rating">
                 <?php  
                        if($userData->reviews->count()==0){
                        $no_of_reviews = 0;
                        }
                        else{
                        $no_of_reviews = $userData->reviews->sum('review_rate')/$userData->reviews->count();
                        }

                 $ratings = $no_of_reviews; 

                 ?>

                  @for($i=1;$i<= floor($ratings);$i++)

                  <i class="fa fa-star" style="color:chocolate"></i>
                 
                  @endfor

                  @if(substr($ratings, strpos($ratings, ".") + 1)==5)
                  <i class="fa fa-star-half-o" style="color:chocolate"></i>
                     @elseif($ratings != 5.0 || $ratings==null)
                  <i class="fa fa-star-o" style="color:chocolate"></i>
                
                  @endif
                  @for($i=1;$i<=(4-floor($ratings));$i++)
                
                  <i class="fa fa-star-o" style="color:chocolate"></i>
                
                  @endfor
                        
              </span> 
              <span class="score"><i>
                      <?php $a=array();
                        foreach($userData->reviews as $review){
                          $a[] = $review->review_rate ;
                        }                      
                           echo count($a);
                      ?> Review</i></span> <!-- |
              <span class="score">100</span>+ user ratings  -->
              {{-- <span style="float: right;">
                <a href="#pablo" class="btn btn-just-icon btn-link btn-dribbble"><i class="fa fa-dribbble"></i></a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-twitter"><i class="fa fa-twitter"></i></a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-pinterest"><i class="fa fa-pinterest"></i></a> 
              </span> --}}
            </div>
            <!--End rating-->
           
            <hr>
            <div class="row">
              <div class="col-sm-4">
                  <div class="item-info mb-3">
                      <span class="icon-holder"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                      <span class="item-label">Location: </span>
                      <span class="value">
                        @if($userData->state == '') 
                          {{ '' }}
                        @else 
                          {{$userData->city->city_name.', '. $userData->state->state_name.', '.$userData->zip_code}}
                        @endif
                      </span>
                  </div>
                  <div class="item-info">
                    <span class="icon-holder"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
                    <span class="item-label">Experience: </span>
                    <span class="value">{{$userData->estd_year. ' years'}}</span>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="item-info mb-3">
                    <span class="icon-holder"><i class="fa fa-language" aria-hidden="true"></i></span>
                    <span class="item-label">Languages: </span>
                    <span class="value">English, Hindi</span>
                  </div>
                 
                 @if($userData->user_catg_id == 2) <div class="item-info">
                    <span class="icon-holder"><i class="fa fa-balance-scale" aria-hidden="true"></i></span>
                    <span class="item-label">Practice areas:</span>
                    
                    @foreach($userData->specialities as $spec)

                    <span class="value">{{$spec->specialization_catgs->catg_desc.','}}</span>
                    @endforeach
                  </div>
                  @endif
              </div>
            </div>
     
          </div>

          <div class="col-md-12 text-justify mt-2" style=" line-height: 30px;">
            <hr>
            <?php echo $userData->detl_profile ?> 
            <hr>
          </div>
              <div class="col-md-12">
                  <div class="row">
                    <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6">
                       <h3>Top Reviews</h3>
                    </div>
                   {{--  <div class="col-sm-6 col-md-6 col-xs-6 col-lg-6 text-right">
                       <a class="btn text-primary border-primary font-weight-bold text-white">Write A Reviews</a> 
                    </div> --}}
                   </div>
                    <hr>
              
                    <div class="col-md-11 m-auto " id="writeReviewBox" >
                      <form >
                          @csrf
                      <div class="row form-group">
                        <div class="col-md-12" >
                            <input type="hidden" name="user_id" value = "{{$userData->id}}">
                            <input type="hidden" name="guest_id" value = "{{Auth::user() ? Auth::user()->id:''}}">
                        <!--  <input id="ratings-hidden" name="rating" type="hidden">  -->
                            <textarea class="form-control animated" cols="40" rows="5" id="review_text" name="review_text" placeholder="{{Auth::user() ? 'Enter your review here...' :'If want to write here so login first'}} " required   {{Auth::user() ? '' :'readonly'}}></textarea>
                            @error('review_text')
                            <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-2">
                          <div class="my-rating mb-2">
                            <span>Working Star Ratings for {{$userData->name}}</span>&nbsp;&nbsp;&nbsp;
                            <span class="my-rating-9"></span>
                            <span class="live-rating"></span>
                          </div>
                          @if(Auth::user()) 
                          <button class="btn text-success border-success btn-sm font-weight-bold" type="submit" style="font-size: 12px" id="review_submit">Submit</button>
                          @else
                            <button type="button" class="btn text-success border-success btn-sm font-weight-bold" id="writeReview" >Submit</button>
                          @endif
                          <a class="btn text-danger border-danger btn-sm font-weight-bold"  id="cancelWR" style="margin-right: 10px; color: #fff;font-size: 12px">
                          Cancel <i class="fa fa-remove"></i></a>
                       </div>

                      </div>
                      </form>
                  </div>
                
                  <br>          
               </div>

               <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                   @foreach($reviews as $review)
                     <div class="review-list">
                      <div class="review-item">
                        <div class="media">
                          <a class="pull-left" href="#">
                            <span class="d-inline-block text-info border-info text-center font-weight-bold p-4" style="border:1px solid;">{{$review->customers->name[0]}}</span>
                          </a>
                          <i class="fa fa-caret-left fa-4x mt-2" style="color: #ececec!important;"></i>
                          <div class="media-body d-table-cell p-4" style="background-color: #ececec!important; border-radius: 20px;">
                            <div class="author mb-2" >
                              <span class="name"><b>{{$review->customers->name}} - </b></span>
                              <span class="verified"><i class="text-info">Verified Client</i></span>
                              <span class="star-rating m-4">

                                <?php $rating = $review->review_rate; ?>

                                  @for($i=1;$i<= floor($rating);$i++)

                                  <i class="fa fa-star" style="color:chocolate"></i>
                                 
                                  @endfor

                                  @if(substr($rating, strpos($rating, ".") + 1)==5)
                                  <i class="fa fa-star-half-o" style="color:chocolate"></i>
                                     @elseif($rating != 5.0 || $rating==null)
                                  <i class="fa fa-star-o" style="color:chocolate"></i>
                                
                                  @endif
                                  @for($i=1;$i<=(4-floor($rating));$i++)
                                
                                  <i class="fa fa-star-o" style="color:chocolate"></i>
                                
                                  @endfor
                             
                             </span>
                           </div>
                           <div class="review-content mb-2">{{$review->review_text}}</div>
                           <div class="review-timestamp"><i>{{date('M d, Y', strtotime($review->review_date))}}</i></div>
                         </div>
                       </div>
                     </div>
                     <br>
                   </div>

                   @endforeach

                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 pull-right">
                 {{$reviews->links()}}
                </div>
  </div>

</div>
{{-- Start Login  Modal --}}
  @include('models.login_model')
{{-- End login  Modal --}}

<script>

$(document).ready(function(){


 var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
 $('#writeReview, #submitBtn').click(function(e){
 e.preventDefault();
  if(AuthUser){


  }
  else{
    $('.login_modal').modal({"backdrop": "static"});
  }
 
});


$('#cancelWR').on('click',function(){

  $('#review_text').val('').empty();
  $('.live-rating').text('').empty();

});

$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

  $('#review_submit').on('click',function(e){
      e.preventDefault();
   
       var review_text = $.trim($('#review_text').val());
       var user_id = $('input[name="user_id"]').val();
       var guest_id = $('input[name="guest_id"]').val();
       var review_rate =$('.live-rating').text();

         var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
         if(AuthUser){
          var checkUser = "{{(Auth::user()) ? Auth::user()->id : null}}";
         if(checkUser != user_id){
           if(review_text !=0 && review_rate !=''){
           
              $.ajax({
                  type:'POST',
                  url: "{{route('lawfirms.writeReview')}}",
                  data:{user_id:user_id, guest_id:guest_id, review_text:review_text, review_rate:review_rate },
                  success:function(data){
                    swal({
                      title: "Review",
                      text : data,
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
                  text: 'Review field required',
                  icon: 'warning'
               });
             }
           }
           else{
            alert("You can't send review on your own profile");
           }
         }
    });
$(".my-rating-9").starRating({
    starSize: 20,
    disableAfterRate: false,
    onHover: function(currentIndex, currentRating, $el){
      $('.live-rating').text(currentIndex);
    },
    onLeave: function(currentIndex, currentRating, $el){
      $('.live-rating').text(currentRating);
    }
  });

});
</script>
@endsection