// JavaScript Document

$(document).ready(function(){ 

  var parallax = document.querySelectorAll(".parallax_inner, #innerslide2"),speed = 0.65;

  window.onscroll = function(){
    [].slice.call(parallax).forEach(function(el,i){

      var windowYOffset = window.pageYOffset,
          elBackgrounPos = "50% " + (windowYOffset * speed) + "px";
      
      el.style.backgroundPosition = elBackgrounPos;

    });
  };

});



$('.nav-submenu').mouseenter(function(){
	$(this).find('.nav-item').addClass('active');
});

$('.nav-submenu').mouseleave(function(){
	$(this).find('.nav-item').removeClass('active');
});



