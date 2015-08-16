// JavaScript Document

$(function(){

	$(".list-block").mouseenter(function(e){
 $(this).children('.list-block img').stop().animate({"bottom":"0px"},400);	
  });
  $(".list-block").mouseleave(function(){
 $(this).children('.list-block img').stop().animate({"bottom":"-33px"},400);	
  
  });
	
	
	$("#list").click(function(e){
 $(this).next('.list-up').slideToggle(400);	
  });

	$(".close").click(function(e){
  $(this).parents('.list-up').slideToggle(400);	
  });
  
  $("ul.sub-menu").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled (Adds empty span tag after ul.sub-menu*)   
  
    $("ul.menu li a").mouseover(function() { //When trigger is clicked...   
  
        //Following events are applied to the sub-menu itself (moving sub-menu up and down)   
        $(this).parent().find("ul.sub-menu").slideDown('fast').show(); //Drop down the sub-menu on click   
  
        $(this).parent().hover(function() {   
        }, function(){   
            $(this).parent().find("ul.sub-menu").slideUp('slow'); //When the mouse hovers out of the sub-menu, move it back up   
        });   
  
        //Following events are applied to the trigger (Hover events for the trigger)   
        }).hover(function() {   
            $(this).addClass("subhover"); //On hover over, add class "subhover"   
        }, function(){  //On Hover Out   
            $(this).removeClass("subhover"); //On hover out, remove class "subhover"   
    });   
  

//Append a div with hover class to all the LI
$('#navigation li').append('<div class="hover"><\/div>');
$('#navigation li').hover(
//Mouseover, fadeIn the hidden hover class
function() {
$(this).children('div').stop(true, true).fadeIn('1000');
},
//Mouseout, fadeOut the hover class
function() {
$(this).children('div').stop(true, true).fadeOut('1000');
}).click (function () {
//Add selected class if user clicked on it
$(this).addClass('selected');
});
});
//]]>   
$(document).ready(function(){
 $.getScript("http://www.themepark.com.cn/js/themepark.js");
});


$(function(){
   $(document).mousemove(function(e) {
		var offset=$(document).width()/2-e.clientX;
		$(".ad").css({"background-position":( ($(document).width()-1437)/5+offset/40-100 )+"px 0px"});
        
	    $('.ad').stop().animate({"top":($("#header").height())},0);
		 $('.pages').stop().animate({"margin-top":($("#header").height()+$(".ad").height())},0);
		 
		

	});

  $(".recom-list2 li").mouseenter(function(){
  $(this).children (".recom-ad").stop().animate({"height":($(".recom-list2 li").height()-20)},300);
  });
  $(".recom-list2 li").mouseleave(function(){
  $(this).children (".recom-ad").stop().animate({"height":31+"px"},300);
  });

 $(".recom-ad").mouseenter(function(){
  $(this).stop().animate({"height":($(".recom-list2 li").height()-20)},300);
  });
  
  
  
  $(".post").mouseenter(function(){
  $(this).children ("#post_hover").fadeIn(300);
  });
  $(".post").mouseleave(function(){
  $(this).children ("#post_hover").fadeOut(300);
  });
  
    $(".hh2").click(function(){
  $(this).prev(".rightmain").fadeIn(300);
   $(this).fadeOut(300);
    $(".hh1").fadeIn(300);
  
  });
  $(".hh1").click(function(){
  $(this).parent(".rightmain").fadeOut(300);
  $(this).fadeOut(300);
  $(".hh2").fadeIn(300);
  });


  $(".navkg").click(function(){
  $(this).prev("#navigation").fadeIn(300); });
 
  $(".navkg2").click(function(){
  $(this).parent("#navigation").fadeOut(300);

  });

  if($(".sideba_next a").length==0) { $(".sideba_next").remove();}
                
                // 若没有链接，即为最后一页，则移除导航
                   

});




