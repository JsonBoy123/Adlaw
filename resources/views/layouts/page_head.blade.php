<div class="container-fluid mt-3 mb-2">
    <div class="row" style="background-color: #fbfbfb !important">
        <div class="col-sm-12 col-md-12 col-xl-12 text-center py-5">
            <h3 class="text-center page-title text-uppercase" data-aos="fade-down">{{$title}}</h3> 
            @if($description !='')
            	<p class="p-text text-center w-responsive mx-auto m-0 text-why animate__animated animate__fadeInDown animate__delay-1s" >{!!$description!!}</p>
            @endif
        </div>
    </div>
</div>