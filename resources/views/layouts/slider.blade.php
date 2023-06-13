<header>
  <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <!-- Slide One - Set the background image for this slide in the line below -->
      <div class="carousel-item active" style="background-image: url('images/banner.jpg') ;">
       
        <div class="carousel-caption d-md-block">
          @include('layouts.counts')



        {{--   <h2 class="display-4 mb-2 animate__animated animate__backIndown">Lawyer / Law Firms</h2>
          <p class="lead animate__animated animate__fadeInDown animate__delay-1s" >Solo Lawyer, Small Firms, Medium and Large Law Firm manage.</p> --}}
        </div>
      </div>
      <!-- Slide Two - Set the background image for this slide in the line below -->
    {{--   <div class="carousel-item" style="background-image: url('images/banner.jpg'); ">

        <div class="carousel-caption  d-md-block">
         @include('layouts.counts')
          <h2 class="display-4 animate__animated animate__backIndown">Company / Other Law Users</h2>
           <p class="lead animate__animated animate__fadeInDown animate__delay-1s">Everything you need to manage your account.</p>
        </div>
      </div>  --}}
      <!-- Slide Three - Set the background image for this slide in the line below -->
      <div class="carousel-item" style="background-image: url('images/new_slider5.jpg')">
        <div class="carousel-caption  d-md-block">
          {{-- <form  action="{{route('search')}}" method="get" autocomplete="off">
            @csrf

            <input type="text" class="search_input p-2 mb-4" name="user_name"  placeholder="Select from 2,00,000 + lawyers across 650 + Cities in India">

              <button class="btn btn-md btn-primary p-2" style="border-radius: 10px;">Search</button>
          </form> --}}
          @include('layouts.counts')
          {{-- <h2 class="display-4 animate__animated animate__backIndown">Law Schools / Students</h2>
          <p class="lead animate__animated animate__fadeInDown animate__delay-1s" >Everything you need to manage your Lawschools.</p> --}}
        </div>
      </div>

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
  </div>
</header>

<script type="text/javascript">
  $(document).ready(function(){
    $('input[name="user_name"]').on('keyup',function(e){
      e.preventDefault();
      $('input[name="user_name"]').val($(this).val());
    });

  })
</script>
