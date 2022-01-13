/*
	 $(document).ready(function() {
             enableInputOnChangeDisableOnCheck('sg-buy-pincode-input', 'sg-buy-pincode-change', 'sg-buy-pincode-check');
                

         });
		 
		   function enableInputOnChangeDisableOnCheck(inputId, changeId, checkId) {
             $('#' + changeId).click(function() {
                 $('#' + inputId).prop('disabled', false);
                 $('#' + changeId).addClass('hidden');
                 $('#' + checkId).removeClass('hidden');
             });
             $('#' + checkId).click(function() {
                 $('#' + inputId).prop('disabled', true);
                 $('#' + checkId).addClass('hidden');
                 $('#' + changeId).removeClass('hidden');
             });
         }
  */
   
(function($){"use strict";$(document).ready(function(){jQuery(window).load(function(){jQuery("#status").fadeOut();jQuery("#preloader").delay(1000).fadeOut("slow");})
var introHeader=$('.intro'),intro=$('.intro');buildModuleHeader(introHeader);$(window).resize(function(){var width=Math.max($(window).width(),window.innerWidth);buildModuleHeader(introHeader);});$(window).scroll(function(){effectsModuleHeader(introHeader,this);});intro.each(function(i){if($(this).attr('data-background')){$(this).css('background-image','url('+$(this).attr('data-background')+')');}});function buildModuleHeader(introHeader){};function effectsModuleHeader(introHeader,scrollTopp){if(introHeader.length>0){var homeSHeight=introHeader.height();var topScroll=$(document).scrollTop();}};$('.bg-img').parallax("50%",.12);$('.bg-img2').parallax("50%",.12);$('.bg-img3').parallax("50%",.12);$('.bg-img4').parallax("50%",.12);$('.bg-img5').parallax("50%",.12);$(window).scroll(function(){var nav=$('.navbar-universal');if(nav.length){if($(".navbar-universal").offset().top>50){$(".navbar-fixed-top").addClass("top-nav-collapse");}else{$(".navbar-fixed-top").removeClass("top-nav-collapse");}}});$('#myTabs a').click(function(e){e.preventDefault()
$(this).tab('show')})
$(function(){$('a.page-scroll').on('click',function(event){var $anchor=$(this);$('html, body').stop().animate({scrollTop:($($anchor.attr('href')).offset().top-55)},1500,'easeInOutExpo');event.preventDefault();});});$('body').scrollspy({target:'.navbar-fixed-top',offset:65})
$('.navbar-onepage .navbar-collapse ul li a').on('click',function(){$('.navbar-onepage .navbar-toggle:visible').click();});var url=window.location;$('ul.nav a[href="'+url+'"]').parent().addClass('active');$('ul.nav a').filter(function(){return this.href==url;}).parent().addClass('active');$('.carousel-big').carousel({interval:6500,pause:"false"})
$('.carousel-small').carousel({interval:5000,pause:"false"})
new WOW().init();$(".progress-bar").each(function(){var each_bar_width;each_bar_width=$(this).attr('aria-valuenow');$(this).width(each_bar_width+'%');});;(function($){})(jQuery);jQuery(function(){jQuery(document.body).on('click touchend','#swipebox-slider .current img',function(e){return false;}).on('click touchend','#swipebox-slider .current',function(e){jQuery('#swipebox-close').trigger('click');});});$(window).on("load",function(){$(document).scrollzipInit();$(document).rollerInit();});$(window).on("load scroll resize",function(){$('.numscroller').scrollzip({showFunction:function(){numberRoller($(this).attr('data-slno'));},wholeVisible:false,});});$.fn.scrollzipInit=function(){$('body').prepend("<div style='position:fixed;top:0;left:0;width:0;height:0;' id='scrollzipPoint'></div>");};$.fn.rollerInit=function(){var i=0;$('.numscroller').each(function(){i++;$(this).attr('data-slno',i);$(this).addClass("roller-title-number-"+i);});};$.fn.scrollzip=function(options){var settings=$.extend({showFunction:null,hideFunction:null,showShift:0,wholeVisible:false,hideShift:0},options);return this.each(function(i,obj){var numbers=$('#scrollzipPoint');if(numbers.length){$(this).addClass('scrollzip');if(!(!$.isFunction(settings.showFunction)||$(this).hasClass('isShown')||$(window).outerHeight()+$('#scrollzipPoint').offset().top-settings.showShift<=$(this).offset().top+(settings.wholeVisible?$(this).outerHeight():0)||$('#scrollzipPoint').offset().top+(settings.wholeVisible?$(this).outerHeight():0)>=$(this).outerHeight()+$(this).offset().top-settings.showShift)){$(this).addClass('isShown');settings.showFunction.call(this);}
if($.isFunction(settings.hideFunction)&&$(this).hasClass('isShown')&&($(window).outerHeight()+$('#scrollzipPoint').offset().top-settings.hideShift<$(this).offset().top+(settings.wholeVisible?$(this).outerHeight():0)||$('#scrollzipPoint').offset().top+(settings.wholeVisible?$(this).outerHeight():0)>$(this).outerHeight()+$(this).offset().top-settings.hideShift)){$(this).removeClass('isShown');settings.hideFunction.call(this);}
return this;}});};function numberRoller(slno){var min=$('.roller-title-number-'+slno).attr('data-min');var max=$('.roller-title-number-'+slno).attr('data-max');var timediff=$('.roller-title-number-'+slno).attr('data-delay');var increment=$('.roller-title-number-'+slno).attr('data-increment');var numdiff=max-min;var timeout=(timediff*1000)/ numdiff;numberRoll(slno,min,max,increment,timeout);}
function numberRoll(slno,min,max,increment,timeout){if(min<=max){$('.roller-title-number-'+slno).html(min);min=parseInt(min,10)+parseInt(increment,10)
setTimeout(function(){numberRoll(eval(slno),eval(min),eval(max),eval(increment),eval(timeout))},timeout);}else{$('.roller-title-number-'+slno).html(max);}}});})(jQuery);!function(n){"use strict";var t=n(window),e=t.height();t.resize(function(){e=t.height()}),n.fn.parallax=function(i,o,r){function u(){var r=t.scrollTop();h.each(function(){var t=n(this),u=t.offset().top,l=s(t);r>u+l||u>r+e||h.css("backgroundPosition",i+" "+Math.round((c-r)*o)+"px")})}
var s,c,h=n(this);h.each(function(){c=h.offset().top}),s=r?function(n){return n.outerHeight(!0)}:function(n){return n.height()},(arguments.length<1||null===i)&&(i="50%"),(arguments.length<2||null===o)&&(o=.1),(arguments.length<3||null===r)&&(r=!0),t.bind("scroll",u).resize(u),u()}}(jQuery);
;( function ( document, window, index )
{
	var inputs = document.querySelectorAll( '.inputfile' );
	Array.prototype.forEach.call( inputs, function( input )
	{
		var label	 = input.nextElementSibling,
			labelVal = label.innerHTML;

		input.addEventListener( 'change', function( e )
		{
			var fileName = '';
			if( this.files && this.files.length > 1 )
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
			else
				fileName = e.target.value.split( '\\' ).pop();

			if( fileName )
				label.querySelector( 'span' ).innerHTML = fileName;
			else
				label.innerHTML = labelVal;
		});

		// Firefox bug fix
		input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
		input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
	});
}( document, window, 0 ));

