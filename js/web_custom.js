jQuery(document).ready(function($){


	$(".main_menu a, .responsive_menu a").click(function(){
		var id =  $(this).attr('class');
		id = id.split('-');
		$("#menu-container .content").hide();
		$("#menu-container #menu-"+id[1]).addClass("animated fadeInDown").show();
		$("#menu-container .homepage").hide();
		$(".support").hide();
		$(".testimonials").hide();
		return false;
	});

	$( window ).load(function() {
	  $("#menu-container .products").hide();
	});

	$(".main_menu a.web_home").addClass('active');

	$(".main_menu a.web_home").click(function(){
		$("#menu-container .homepage").addClass("animated fadeInDown").show();
		$(this).addClass('active');
		$(".main_menu a.web_page2").removeClass('active');
		$(".main_menu a.web_page3").removeClass('active');
		$(".main_menu a.web_page4").removeClass('active');
		return false;
	});

	$(".main_menu a.web_page2").click(function(){
		$("#menu-container .gallery").addClass("animated fadeInDown").show();
		$(this).addClass('active');
		$(".main_menu a.web_home").removeClass('active');
		$(".main_menu a.web_page3").removeClass('active');
		$(".main_menu a.web_page4").removeClass('active');
		return false;
	});

	$(".main_menu a.web_page3").click(function(){
		$("#menu-container .about").addClass("animated fadeInDown").show();
		$(".our-services").show();
		$(this).addClass('active');
		$(".main_menu a.web_page2").removeClass('active');
		$(".main_menu a.web_home").removeClass('active');
		$(".main_menu a.web_page4").removeClass('active');
		return false;
	});

	
	$(".main_menu a.web_page4").click(function(){
		$("#menu-container .contact").addClass("animated fadeInDown").show();
		$(this).addClass('active');
		$(".main_menu a.web_page2").removeClass('active');
		$(".main_menu a.web_page3").removeClass('active');
		$(".main_menu a.web_home").removeClass('active');
		
		loadScript();
		return false;
	});



	loadScript();


	$(".overlay").hide();

	$('.gallery-item').hover(
	  function() {
	    $(this).find('.overlay').fadeIn(1000);
	  },
	  function() {
	    $(this).find('.overlay').fadeOut(1000);
	  }
	);
	

	 var num = 50;
	$(window).bind('scroll', function () {
		if ($(window).scrollTop() > num) {
			$('.menu').addClass('fixed');
		} else {
			$('.menu').removeClass('fixed');
		}
	});



	$(function(){
		$('[data-rel="lightbox"]').lightbox();
	});


	$("a.menu-toggle-btn").click(function() {
	  $(".responsive_menu").stop(true,true).slideToggle();
	  return false;
	});
 
    $(".responsive_menu a").click(function(){
		$('.responsive_menu').hide();
	});

});


function loadScript() {


  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
      'callback=initialize';
  document.body.appendChild(script); 
   
}

function initialize() {
    var mapOptions = {
	center: new google.maps.LatLng(56.840697,60.650927),
	zoom: 15,
	scrollwheel: false,
	mapTypeId: google.maps.MapTypeId.ROADMAP
	};
    var map = new google.maps.Map(document.getElementById('web_map'), mapOptions);
}

	    google.maps.event.addDomListener(window, 'load', initialize);
		google.maps.event.addDomListener(window, 'resize', function() 
		{
			map.setCenter(center);
		});