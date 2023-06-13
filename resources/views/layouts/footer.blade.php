
{{-- <footer id="footer">
 <div class="footer-nav">
 <div class="container">
   <div class="content-wrapper pt-4 ">
     <div class="row">
       <div class="col-sm-9">
         <ul class="list-inline">
           <li class="pl-4 text-center d-inline-block"><a href="{{url('/about-us')}}">About</a></li>
           <li class="pl-4 text-center d-inline-block"><a href="{{url('/tos')}}">Terms</a></li>
           <li class="pl-4 text-center d-inline-block"><a href="{{route('privacy_policy')}}">Privacy Policy</a></li>
          
           <li class="pl-4 text-center d-inline-block"><a href="{{url('disclaimer')}}">Disclaimer</a></li>
           <li class="pl-4 text-center d-inline-block"><a href="{{route('contact.index')}}">Contact</a></li>
         </ul>
       </div>
       <div class="col-sm-3">
         <ul class="list-inline social-links pl-4 ">
           <li class="btn-facebook btn btn-sm "><a  href="https://www.facebook.com/Adlaw-109225687182044/?modal=admin_todo_tour" target="_blank"><span class="fa fa-facebook"></span></a></li>
           <li class="btn-twitter btn btn-sm"><a  href="https://twitter.com/adlaw6" target="_blank"><span class="fa fa-twitter"></span></a></li>
           <li class="btn-linkedin btn btn-sm"><a  href="https://www.linkedin.com/in/adlaw-in-7b9632187/" target="_blank"><span class="fa fa-linkedin"></span></a></li>
         </ul>
       </div>
     </div>
   </div>
 </div>
 </div>
 <div class="footer-copyright">
 <div class="container">
   <div class="content-wrapper border-top pt-4 text-center ">
     The information provided on <a href="{{url('/')}}">Adlaw.in</a> is provided AS IS, subject to <a style="color:#FFFFFF;" href="{{url('/tos')}}">Terms Of Services</a> &amp; <a style="color:#FFFFFF;" href="{{url('privacy_policy')}}">Privacy Policy</a>. It is solely available at your request for informational purposes only, should not be interpreted as soliciting or advertisement. In cases where the user has any legal issues, he/she in all cases must seek independent legal advice.<br><br>
   </div>
 </div>
 </div>

</footer>  --}}
<footer class="border-1" id="footer">
    {{-- <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div> --}}

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3><img src="{{asset('images/adlaw-logo1.png')}}" alt="Adlaw" style="width: 90px;"></h3>
            <p>
              1st Floor, Laxyo House, Plot No. 2, County Park,<br> MR-5, Mahalaxmi Nagar, Indore,<br> Madhya Pradesh, 452010<br><br>
              <strong>Phone:</strong> 0731 404 3798<br>
              <strong>Email:</strong> info@adlaw.in<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Links</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="{{url('/')}}">Home</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="{{route('about_us')}}">About</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="{{route('faqs')}}">FAQ's</a></li>
              {{-- <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li> --}}
              <li><i class="fa fa-angle-right"></i> <a href="{{route('contact.index')}}">Contact</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Support</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="{{route('tos')}}"> Terms of Use</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="{{route('privacy_policy')}}"> Privacy Policy</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="{{route('disclaimer')}}"> Disclaimer</a></li>
            
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Follow Us</h4>
            {{-- <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p> --}}
            <div class="social-links mt-1">
              <a href="https://www.facebook.com/Adlaw-109225687182044/?modal=admin_todo_tour" target="_blank" class="facebook" style="background-color:#3b5998 !important"><i class="fa fa-facebook"></i></a>
              <a href="https://twitter.com/adlaw6" target="_blank" class="twitter" style="background-color: #50abf1 !important"><i class="fa fa-twitter"></i></a>
              
              <a href="https://www.linkedin.com/in/adlaw-in-7b9632187/" target="_blank" class="linkedin" style="background-color: #0077b5 !important"><i class="fa fa-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container py-4">
      <div class="copyright text-white">
        @2019 &#169; All Rights Reserved by <strong><span>ADLAW</span></strong>
      </div>
      <div class="credits">
     
        Designed by <a href="http://www.libersolution.com/" target="_blank"><i class="text-primary">Liber Solution Pvt. Ltd.</i></a>
      </div>
    </div>
</footer>
 <a href="javascript:void(0)" class="back-to-top"><i class="fa fa-angle-up"></i></a>

  <script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
  {{-- <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script> --}}
  <script src="https://cdn.jsdelivr.net/sweetalert2/4.2.4/sweetalert2.min.js"></script>
  <script src="{{asset('js/jquery.star-rating-svg.js')}}"></script>
  <script src="{{asset('js/all_category.js')}}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <script>
    
    $(document).ready(function(){
       AOS.init();
      $(window).on("scroll", function() {
      scroll_nav();

      });
      scroll_nav();

       // Back to top button
      $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
          $('.back-to-top').fadeIn('slow');
        } else {
          $('.back-to-top').fadeOut('slow');
        }
      });

      $('.back-to-top').click(function() {
        $('html, body').animate({
          scrollTop: 0
        }, 1500, 'easeInOutExpo');
        return false;
      });


      $('.searchHeader').on('click',function(){
          $('#searchModal').modal('show');
      });



    @if(url('/') != Request::url())
      $(".menunav li>a").css({ 'color': 'black', 'font-weight': 'bold' }); 
       $(".menunav").css({'box-shadow' : '0 .335rem .25rem rgba(0,0,0,.075) '});
       $('#topbar').addClass("other-page");
        $('.navbar-toggler').removeClass('text-white');
        $('.navbar-toggler-icon').removeClass('text-white');
    @else
        $('#topbar').addClass('before-topbar');
    @endif

    })
   
  function scroll_nav(){
    if($(window).scrollTop() > 50) {
        $(".menunav").addClass("bg-white");
        $('.menunav').addClass('header-scrolled');
        $('#topbar').addClass('topbar-scrolled');
        $('.navbar-toggler').removeClass('text-white');
        $('.navbar-toggler-icon').removeClass('text-white');
   
        $(".menunav").css({'box-shadow' : '0 .335rem .25rem rgba(0,0,0,.075) '});
        $(".menunav li>a").css({ 'color': 'black', 'font-weight': 'bold' });
    } else {


        //remove the background property so it comes transparent again (defined in your css)
       $(".menunav").removeClass("bg-white");
      @if(url('/') == Request::url())
       $(".menunav li>a").css({ 'color': 'white', 'font-weight': 'bold' });
       $(".menunav").css({'box-shadow' : ''});
       $('.navbar-toggler').addClass('text-white');
       $('.navbar-toggler-icon').addClass('text-white');
      @endif
      $('.menunav').removeClass('header-scrolled');
      $('#topbar').removeClass('topbar-scrolled');

    }  
  }
  </script>
  <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-48209472-2',{ cookie_flags: 'SameSite=lax;Secure' });
</script>

<script>
  $(document).ready(function(){
      $('.stateView').on('click',function(e){
        e.preventDefault();
          var state_code = $(this).attr('id');
          var state_name = $(this).data('id');
          $.ajax({
            type:'GET',
            url:"{{url('/get_city_count')}}/"+state_code,
            success:function(res){
              $('#cityRow').removeClass('d-none');
              $('#cityRow1').removeClass('d-none');
              $('#stateRow').addClass('d-none');
              $('#stateRow1').addClass('d-none');
              $('#cityRow').empty();
              $.each(res,function(i,v){
                $('#cityRow').append('<div class="col-md-4"><a href="{{url('/search')}}/'+v.city_name.toLowerCase()+'" class="text-primary stateView"> <i class="fa fa-map-marker "></i> '+v.city_name+' ('+v.city_count+')</a><br/><br/></div>')
              })
            
            }
          })
      });

      $(document).on('click','#backStateBtn',function(e){
        e.preventDefault();
        $('#cityRow').addClass('d-none');
        $('#cityRow1').addClass('d-none');
        $('#stateRow').removeClass('d-none');
        $('#stateRow1').removeClass('d-none');
        $('#cityRow').empty();
      })
  })
</script>
  {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
  </main>
</body>
</html>