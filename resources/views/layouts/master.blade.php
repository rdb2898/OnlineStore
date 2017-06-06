<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>

    <link rel="stylesheet" type="text/css" href="/awesome/icons/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="/css/restart.css">
    <link rel="stylesheet" type="text/css" href="/css/mystyle.css">
    <link rel="stylesheet" href="/bootstrap3/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/owl/dist/assets/owl.carousel.css">
    <link rel="stylesheet" href="/owl/dist/assets/owl.theme.default.css">
    <link rel="stylesheet" href="https://npmcdn.com/flickity@1.2/dist/flickity.css">
<!-- or -->
<link rel="stylesheet" href="https://npmcdn.com/flickity@1.2/dist/flickity.min.css">
    <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>


</head>
<body>
  @php
    function current_page($uri)
    {
      return strstr(request()->path(),$uri);
    }
  @endphp
<header>
	<div class="heading-Container">
	    <div class="upper-container">
	  		<div class="upper-nav">
	  			<div class="left-nav">
                <div class="burger">
	          		     <button id="mobile-nav"><i class="fa fa-bars"></i></button>
                </div>
                <div class="mobile-searchbox">
                    <button type="button" name="button"> <i class="fa fa-search"></i></button>
                </div>
                @if((Auth::check())&&(Auth::user()->role==1))
                <div class="AdminNav">
                  <a href="#"><i class="fa fa-cog"><span id="admin-navtext">Admin</span></i></a>

                </div>
                @endif
	        </div>
	  			<div class="right-bar">
	  				<ul>
	  					<li id="searchbox"> <i class="fa fa-search"></i><input type="text" name="search" placeholder="search items..."></li>
	  					<li id="myacc">
	  						<i class="fa fa-user"></i><a href="#">My account</a><i class="fa fa-caret-down"></i>
	  						<ul>
                  @if (Auth::check())
                    <li class="lined"><a href="#">My info</a></li>
                    <li class="lined"><a href="#">Purchase history</a></li>
                    <li class="lined"><a href="#">My wish list</a></li>
                    <li class="lined"><a href="#" onclick="document.getElementById('logoff').submit()">Sign out</a></li>
                    <form id="logoff" action="{{route('logging.out')}}" method="post">{{ csrf_field() }}</form>
                  @else
	  							<li class="lined" id="log-modal-opener"><a href="#">Sign In</a></li>
	  							<li class="lined"><a href="/register">Register</a></li>
                  @endif
	  						</ul>
	  					</li>
	  					<li id="cart"><i class="fa fa-shopping-cart"></i><a href="#">My Cart</a> <span id="cart-number">0</span></li>
	  				</ul>
	  			</div>
	  		</div>
	  	</div>
			<div class="lower-nav">
				<div class="logo">
					<a href="{{route('home')}}"><img src="/designIMG/logo.png"></a>
				</div>
				<div class="lownav">
					<ul>
						<li class="sizable"><a href="/welcome" class="{{current_page('welcome') ? 'active' : ''}}">HOME</a></li>
						<li class="sizable"><a href="#" class="{{current_page('hotdeals') ? 'active' : ''}}">HOT DEALS</a></li>
						<li class="sizable"><a href="/brands" class="{{current_page('brands') ? 'active' : ''}}">BRANDS</a></li>
						<li class="sizable"><a href="#" class="{{current_page('shipping') ? 'active' : ''}}">SHIPPING</a></li>
						<li class="sizable" id="droping"><i class="fa fa-angle-down">
						</i>
							<ul>
								<li class="hideable drop" ><a href="#" class="{{current_page('new') ? 'active' : ''}}">NEW!</a></li>
								<li class="hideable"><a href="#" class="{{current_page('comming') ? 'active' : ''}}">COMMING SOON</a></li>
								<li class="hideable"><a href="#" class="{{current_page('contact') ? 'active' : ''}}">CONTACT US</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
  <div class="modal-container">
    <div class="modal">
      <ul>
        <li> <i class="fa fa-times animated"></i><h2>MENU</h2></li>
        <li class="sizable"><a href="/welcome" class="{{current_page('welcome') ? 'active' : ''}}">Home</a></li>
        <li class="sizable"><a href="#">Hot deals</a></li>
        <li class="sizable"><a href="/brands">Brands</a></li>
        <li class="sizable"><a href="#">Shipping</a></li>
        <li class="hideable drop" ><a href="#">New!</a></li>
        <li class="hideable"><a href="#">Comming soon</a></li>
        <li class="hideable"><a href="#">Contact us</a></li>
        @if (Auth::check())
          <li class="lined"><a href="#">Purchase history</a></li>
          <li class="lined"><a href="#">My wish list</a></li>
          <li class="lined"><a href="#" onclick="document.getElementById('logoff').submit()">Sign out</a></li>
        @else
        <li class="lined" id="log-mobile-opener"><a href="#">Sign In</a></li>
        <li class="lined"><a href="/register">Register</a></li>
        @endif
      </ul>
    </div>
  </div>
  <div class="modal-container-log">
    <div class="modal-log">
      <i class="fa fa-times"></i>
      <h1>Sign In</h1>
      <form class="login" action="{{route('logging.in')}}" method="post">
        {{ csrf_field() }}
        <label>Email :</label><input type="email" name="email"  required><br>
        <label>Password :</label><input type="password"  name="password"  required><br>
        <button id="sign-button" type="submit">Sign In</button>
        <a href="#">Forgot password?</a>
      </form>
      @if(Session::has('error-login'))
      <h4>{{Session::get('error-login')}}</h4>
      @endif
    </div>
  </div>
  <div class="modal-search">
    <div class="search-modal-container">
      <form action="index.html" method="post">
      <input type="text" name="search" placeholder="Search items ...">
      </form>
    </div>
  </div>
  @if((Auth::check())&&(Auth::user()->role==1))
  <div class="Admin-Modal-container">
    <div class="Admin-Modal">
      <ul>
        <li><i class="fa fa-times animated"></i></li>
        <li>ADMIN</li>
        <a href="{{route('products.create')}}"><li>Add new product</li></a>
        <a href="{{route('brands.create')}}"><li>Add new brand</li></a>
        <a href="#"><li>See stocks</li></a>
        <a href="#"><li>See summary</li></a>

      </ul>
    </div>
  </div>
@endif

</header>
@section('body')
@show
<footer>
  <div class="advantages">
      <div class="advantages-container">
          <ul>
              <li><i class="fa fa-truck"></i><h1>Free shipping</h1></li>
              <li><i class="fa fa-gift"></i><h1>Special gift cards</h1></li>
              <li><i class="fa fa-star"></i><h1>New products everyday</h1></li>
              <li><i class="fa fa-cog"></i><h1>We work 24/7</h1></li>
              <li><i class="fa fa-cog"></i><h1>Trying on before buying</h1></li>
          </ul>
      </div>
  </div>
  <div class="news">
      <div class="news-container">
          <p>Subscribe to get daily <span class="highlight">X</span>CART news</p>
          <input type="email" name="email" placeholder="Enter email address">
          <button>Subscribe</button>
      </div>
  </div>
  <div class="links">
      <div class="links-container">
          <div class="link">
              <ul><h1>Categories</h1>
                      <li><a href="#">Apparel</a></li>
                      <li><a href="#">Goods</a></li>
                      <li><a href="#">Toys</a></li>
              </ul>
          </div>
          <div class="link">
              <ul><h1>Sales</h1>
                      <li><a href="#">Comming Soon</a></li>
                      <li><a href="#">New</a></li>
              </ul>
          </div>
          <div class="link">
              <ul><h1>Info links</h1>
                      <li><a href="#">Shipping</a></li>
                      <li><a href="#">Site Map</a></li>
                      <li><a href="#">Terms & Conditions</a></li>
              </ul>
          </div>
          <div class="link">
              <ul><h1>Services</h1>
                      <li><a href="#">Shipping</a></li>
                      <li><a href="#">Contact Us</a></li>
              </ul>
          </div>
      </div>
  </div>
	<div class="foot">
		<h3>&copy; 2017 - 2018 X-Cart. All rights reserved. Powered by Dexter's online shop software</h3>
	</div>
</footer>
<script src="https://npmcdn.com/flickity@1.2/dist/flickity.pkgd.js"></script>
<!-- or -->
<script src="https://npmcdn.com/flickity@1.2/dist/flickity.pkgd.min.js"></script>
<script type="text/javascript" src="/bootstrap3/js/bootstrap.js"></script>
<script type="text/javascript" src="/bootstrap3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/owl/dist/owl.carousel.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
      $('#mobile-nav').click(function()
      {
        $('.modal > ul > li > i').addClass('rotateIn');
        $('.modal-container').addClass('active');

      });


      $('.modal > ul > li > i').click(function(){
        $('.modal > ul > li > i').removeClass('rotateIn');
        $('.modal-container').removeClass('active');
      });

      $('#log-modal-opener').click(function(){
        $('.modal-container-log').addClass('active');
      });


      $('#log-mobile-opener').click(function(){
        $('.modal-container').removeClass('active');
        $('.modal-container-log').addClass('active');
      });

      $('.modal-log > i').click(function(){
        $('.modal-container-log').removeClass('active');
      });



      $('.mobile-searchbox').click(function(){
        $('.modal-search').addClass('active');
      });

      $('.modal-search').click(function(){
        $('.modal-search').removeClass('active');
      }).children().click(function(){
        return false;
      });

      $('.AdminNav a i').click(function(event) {
        $('.Admin-Modal-container').addClass('active');
        $('.Admin-Modal > ul > li > i').addClass('rotateIn');
      });

      $('.Admin-Modal > ul > li > i').click(function(event) {
        $('.Admin-Modal > ul > li > i').removeClass('rotateIn');
        $('.Admin-Modal-container').removeClass('active');
      });

      $('.Admin-Modal-container').click(function(event) {
        $('.Admin-Modal-container').removeClass('active');
      });

      /*HOME BRANDS jquery*/
      $('.all-b-slide').first().addClass('active');//Adding ACTIVE class to the first brand

      $('p#control_next').click(function(event) {
          var currentSlide = $('.all-b-slide.active');
          var nextSlide = currentSlide.next();
          $('.all-b-slide h1').removeClass('slideInLeft');
          $('.all-b-slide h1').addClass('slideInRight');


          currentSlide.fadeOut(500).removeClass('active');
          nextSlide.fadeIn(500).addClass('active');

          if (nextSlide.length==0) {
            $('.all-b-slide').first().fadeIn(300).addClass('active');
          }
      });

      $('p#control_prev').click(function(event) {
          var currentSlide = $('.all-b-slide.active');
          var prevs = currentSlide.prev();
            $('.all-b-slide h1').removeClass('slideInRight');
          $('.all-b-slide h1').addClass('slideInLeft');


          if (prevs.length==0) {
            $('.all-b-slide').last().fadeIn(300).addClass('active');
            currentSlide.fadeOut(500).removeClass('active');
          }else {
            currentSlide.fadeOut(500).removeClass('active');
            prevs.fadeIn(500).addClass('active');
          }



      });

      /*jquery for 3pics of brands at ADMIN BRAND*/
      $('.brand-box').first().addClass('b1');
      $('.brand-box.b1').next().addClass('b2');
      $('.brand-box.b2').next().addClass('b3');

        /*Featured products*/

        $("#owl-demo").owlCarousel({
          items :5,
          loop:true,
          responsiveClass:true,
          margin:10,
          autoplayHoverPause:true,
          autoplay:true,
          responsive:
          {
            0:{
              items:1,
            },
            400:{
              items:1,
            },
            600:{
              items:2,
            },
            790:{
              items:3,
            },
            1100:{
              items:4,
            },
            1300:{
              items:4,
            },

          },

        });
        /*OWL FOR BRANNAMES AT HOMEPAGE*/
        $(".owl-brand").owlCarousel({
          items :5,
          loop:true,
          responsiveClass:true,
          margin:10,
          autoplayHoverPause:true,
          autoplay:true,
          responsive:
          {
            0:{
              items:1,
            },
            400:{
              items:1,
            },
            600:{
              items:2,
            },
            790:{
              items:3,
            },
            1100:{
              items:4,
            },
            1300:{
              items:4,
            },

          },

        });
        /*RELATED Flickity CAROUSEL*/
        $('.related-carousel').flickity({

            // options
            adaptiveHeight: true,
             imagesLoaded: true,
             initialIndex:1,

          });


        /*JQ for LOGIN ERROR*/
      @if (Session::has('error-login'))
        $('.modal-container-log').addClass('active');
        $('.modal-log').addClass('animated shake');
      @endif

      /*JQUERY FOR OTHER ERRORS*/
      @if (count($errors)>0)
        $('.modal-for-errors').addClass('active');
        $('.modal-error-block').addClass('animated shake');
      @endif

      $('#tryagain').click(function(event)
      {
        $('.modal-for-errors').removeClass('active');
      });



      /*JQ for Display several image products View individually*/
      $('.item-view-image').first().addClass('active')
      $('.small-thumbnail').click(function(event) {
        var current = $(this).index();
        var active = $('.item-view-image.active');
        active.removeClass('active');
        $('.item-view-image').eq(current).addClass('active');
      });

  });

  </script>



</body>
</html>