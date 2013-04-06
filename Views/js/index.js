// this computes the width of the window, and sets the mainContain width to 85%
// of that
var docWidth = $(window).width();
var docHeight = $(window).height();
var mainWidth;
var mainHeight;
if (docWidth>1.01*963){
	mainWidth = 0.99*docWidth;
}
else {mainWidth = 963;}

mainHeight = docHeight*0.8;


// for parsing integers falling between values

//alert(docWidth);

$(document).ready(function(){	
	$('#codeOutput').html(docWidth);



	if (docWidth <= 481){
		$('#calendarFrame').attr('width', 480);
	}

	else if ((docWidth >= 481) && docWidth <= 965){
		$('#calendarFrame').attr('width', 500);
	}

	else {
		$('#calendarFrame').attr('width', 900);
	}



	// -------------- navbar -----------
	$('.utf8').css('opacity', 0);
	$("a.navLinks").mouseenter(function(){
			var $arrowL = $(this).find('.left');
			$arrowL.addClass("utf8Hover");	
			$arrowL.stop(true, true).show();
			$arrowL.animate({opacity: 1}, {queue: false, duration: 200});
			$arrowL.animate({left:'+10px'}, {duration: 400, easing: 'easeOutBounce'});

			var $arrowR = $(this).find('.right');
			$arrowR.addClass("utf8Hover");	
			$arrowR.stop(true, true).show();
			$arrowR.animate({opacity: 1}, {queue: false, duration: 200});
			$arrowR.animate({left:'-10px'}, {duration: 400, easing: 'easeOutBounce'});
	});

	$("a.navLinks").mouseleave(function(){
			var $arrowL = $(this).find('.left');
			$arrowL.removeClass("utf8Hover");	
			$arrowL.stop(true, true).show();
			$arrowL.animate({opacity: 0}, {queue: false, duration: 200});
			$arrowL.animate({left:'0px'}, {duration: 400, easing: 'easeOutBounce'});

			var $arrowR = $(this).find('.right');
			$arrowR.removeClass("utf8Hover");	
			$arrowR.stop(true, true).show();
			$arrowR.animate({opacity: 0}, {queue: false, duration: 200});
			$arrowR.animate({left:'0px'}, {duration: 400, easing: 'easeOutBounce'});

			
	});

	$(".uvmLogo").mouseenter(function(){
			$(this).stop(true, true).show();
			$(this).animate({width: ($(this).width()+5)}, {queue: false, duration: 100});
			$(this).animate({height: ($(this).height()+3)}, {queue: false, duration: 100});
			$(this).animate({'marginRight': '+35px'}, {queue: false, duration: 100});

	});

	$(".uvmLogo").mouseleave(function(){
			$(this).stop(true, true).show();
			$(this).animate({width: ($(this).width()-5)}, {queue: false, duration: 100});
			$(this).animate({height: ($(this).height()-3)}, {queue: false, duration: 100});
			$(this).animate({'marginRight': '+40px'}, {queue: false, duration: 100});
			

	});
	// -------------- end navbar -----------



	// ---------------- tools ---------------

		$('.shiftArrow').css('opacity', 0);
		$('.tools li').mouseenter(function(){
			var $arrow = $(this).find('.shiftArrow');			
			$arrow.stop(true, true).show();
			$arrow.animate({opacity: 1}, {queue: false, duration: 'slow'});
			$arrow.animate({left:'-2px'}, {duration: 400, easing: 'easeOutBounce'});
		});

		$('.tools li').mouseleave(function(){
			var $arrow = $(this).find('.shiftArrow');	
			$arrow.stop(true, true).css('opacity', 0);
			$arrow.animate({left:'-20px'});
		});

	// --------------- end tools ------------






	// --------- load project ----//

	$('.projectRow').click(function(){
		$('body').load("http://132.198.10.80/cscrew-website-2.0/projectTemplate");
	});

});









