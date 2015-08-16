/* jQuery Easing */
jQuery.easing['jswing']=jQuery.easing['swing'];jQuery.extend(jQuery.easing,{def:'easeOutQuad',swing:function(x,t,b,c,d){return jQuery.easing[jQuery.easing.def](x,t,b,c,d)},easeInQuad:function(x,t,b,c,d){return c*(t/=d)*t+b},easeOutQuad:function(x,t,b,c,d){return-c*(t/=d)*(t-2)+b},easeInOutQuad:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t+b;return-c/2*((--t)*(t-2)-1)+b},easeInCubic:function(x,t,b,c,d){return c*(t/=d)*t*t+b},easeOutCubic:function(x,t,b,c,d){return c*((t=t/d-1)*t*t+1)+b},easeInOutCubic:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t+b;return c/2*((t-=2)*t*t+2)+b},easeInQuart:function(x,t,b,c,d){return c*(t/=d)*t*t*t+b},easeOutQuart:function(x,t,b,c,d){return-c*((t=t/d-1)*t*t*t-1)+b},easeInOutQuart:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t+b;return-c/2*((t-=2)*t*t*t-2)+b},easeInQuint:function(x,t,b,c,d){return c*(t/=d)*t*t*t*t+b},easeOutQuint:function(x,t,b,c,d){return c*((t=t/d-1)*t*t*t*t+1)+b},easeInOutQuint:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t*t+b;return c/2*((t-=2)*t*t*t*t+2)+b},easeInSine:function(x,t,b,c,d){return-c*Math.cos(t/d*(Math.PI/2))+c+b},easeOutSine:function(x,t,b,c,d){return c*Math.sin(t/d*(Math.PI/2))+b},easeInOutSine:function(x,t,b,c,d){return-c/2*(Math.cos(Math.PI*t/d)-1)+b},easeInExpo:function(x,t,b,c,d){return(t==0)?b:c*Math.pow(2,10*(t/d-1))+b},easeOutExpo:function(x,t,b,c,d){return(t==d)?b+c:c*(-Math.pow(2,-10*t/d)+1)+b},easeInOutExpo:function(x,t,b,c,d){if(t==0)return b;if(t==d)return b+c;if((t/=d/2)<1)return c/2*Math.pow(2,10*(t-1))+b;return c/2*(-Math.pow(2,-10*--t)+2)+b},easeInCirc:function(x,t,b,c,d){return-c*(Math.sqrt(1-(t/=d)*t)-1)+b},easeOutCirc:function(x,t,b,c,d){return c*Math.sqrt(1-(t=t/d-1)*t)+b},easeInOutCirc:function(x,t,b,c,d){if((t/=d/2)<1)return-c/2*(Math.sqrt(1-t*t)-1)+b;return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b},easeInElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b},easeOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b},easeInOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d/2)==2)return b+c;if(!p)p=d*(.3*1.5);if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);if(t<1)return-.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*.5+c+b},easeInBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b},easeOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b},easeInOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;if((t/=d/2)<1)return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b},easeInBounce:function(x,t,b,c,d){return c-jQuery.easing.easeOutBounce(x,d-t,0,c,d)+b},easeOutBounce:function(x,t,b,c,d){if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b}else if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b}else if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b}else{return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b}},easeInOutBounce:function(x,t,b,c,d){if(t<d/2)return jQuery.easing.easeInBounce(x,t*2,0,c,d)*.5+b;return jQuery.easing.easeOutBounce(x,t*2-d,0,c,d)*.5+c*.5+b}});

(function($){var patterns={text:/^['"]?(.+?)["']?$/,url:/^url\(["']?(.+?)['"]?\)$/};function clean(content){if(content&&content.length){var text=content.match(patterns.text)[1],url=text.match(patterns.url);return url?'<img src="'+url[1]+'" />':text}}function inject(prop,elem,content){if(prop!='after')prop='before';if(content=clean(elem.currentStyle[prop])){$(elem)[prop=='before'?'prepend':'append']($(document.createElement('span')).addClass(prop).html(content))}}$.pseudo=function(elem){inject('before',elem);inject('after',elem);elem.runtimeStyle.behavior=null};if(document.createStyleSheet){var o=document.createStyleSheet(null,0);o.addRule('.dummy','display: static;');o.cssText='html, head, head *, body, *.before, *.after, *.before *, *.after * { behavior: none; } * { behavior: expression($.pseudo(this)); }'}})(jQuery);

jQuery(document).ready(function($){
	$(".topmenucon .menu li").hover(function(){
		$(this).find(".sub-menu").stop(true,true).animate({opacity:'show',height:'show'},450,'easeOutCubic');},function(){
		$(this).find(".sub-menu").stop(true,true).animate({opacity:'hide',height:'hide'},450,'easeOutCubic');}
	);
	function posttitle(){
		$('.post .title a').not('.status .title a').click(function(){
			myloadoriginal = this.text;
			$(this).text('请稍等，正在努力加载中...');
			var myload = this;
			setTimeout(function() { $(myload).text(myloadoriginal); }, 2011);
		});
	}
	posttitle();

	$(".reply").click(function(){$('html,body').animate({scrollTop:$(this).parent().parent().parent().parent().parent().find("#respond").offset().top-150},1000,"easeOutExpo");var atid = '"#' + $(this).parent().parent().parent().parent().attr("id") + '"';var atname = $(this).parent().prev().find(".commentid").text();$("#comment").attr("value","<a href=" + atid + ">@" + atname + "</a> : ").focus();});
	$('#cancel-comment-reply').click(function(){$("#comment").attr("value",'');});
	var id=/^#comment-/;
	var at=/^@/;
	$('.commentp p a').each(function() {if($(this).attr('href').match(id)&& $(this).text().match(at)) {$(this).addClass('atreply');}});
	$('.atreply').hover(function() {$($(this).attr('href')).find('div:first').clone().hide().insertAfter(  $(this).parents('li')  ).attr('id','').addClass('tip').fadeIn(200);}, 
		function() {$('.tip').hide(200, function(){$(this).remove();});});	
	$('.atreply').mousemove(function(e) {$('.tip').css({left:(e.clientX+18),top:(e.pageY+18)})});
	$(".pingpart").click(function(){$(this).css({color:"#a0a0a0"});$(".commentshow").hide(400);$(".pingtlist").show(400);$(".commentpart").css({color:"#b3b3b3"})});
	$(".commentpart").click(function(){$(this).css({color:"#a0a0a0"});$(".pingtlist").hide(400);$(".commentshow").show(400);$(".pingpart").css({color:"#b3b3b3"})});

	$('.commentnav a').live('click', function(e){e.preventDefault();$.ajax({type: "GET",url: $(this).attr('href'),beforeSend: function(){$('.commentnav').remove();$('.commentlist').remove();$('#loading-comments').slideDown();$body.animate({scrollTop: $('#comments').offset().top - 65}, 800 );},dataType: "html",success: function(out){result = $(out).find('.commentlist');nextlink = $(out).find('.commentnav');$('#loading-comments').slideUp(500);$('#loading-comments').after(result.fadeIn(800));$('.commentlist').after(nextlink);$(".reply a").ajaxReply();}});})

	$body=(window.opera)?(document.compatMode=="CSS1Compat"?$('html'):$('body')):$('html,body');
	if($.browser.mozilla){$body.bind("DOMMouseScroll",function(){$body.stop();});}else{$body.bind("mousewheel",function(){$body.stop();});}
	$('#gototop').click(function(){
		$('html,body').animate({scrollTop:0},1200,'easeOutQuart');
		return false;
	});
	$('#gotobottom').click(function(){
		$('html,body').animate({scrollTop:$(document).height()-$(window).height()},1200,'easeOutQuart');
		return false;
	});
	$('#gotocomment').click(function(){
		$('html,body').animate({scrollTop:$("#comments").offset().top-150},1200,'easeOutQuart');
		return false;
	});
});

$(function(){$("a.et_smilies").click(function(){$('#smilies-container').toggle(function(){$(document).click(function(event){if(!($(event.target).is('#smilies-container')||$(event.target).parents('#smilies-container').length||$(event.target).is('a.et_smilies'))){$('#smilies-container').hide(500)}})})})});
$(function(){function addEditor(a,b,c){if(document.selection){a.focus();sel=document.selection.createRange();c?sel.text=b+sel.text+c:sel.text=b;a.focus()}else if(a.selectionStart||a.selectionStart=='0'){var d=a.selectionStart;var e=a.selectionEnd;var f=e;c?a.value=a.value.substring(0,d)+b+a.value.substring(d,e)+c+a.value.substring(e,a.value.length):a.value=a.value.substring(0,d)+b+a.value.substring(e,a.value.length);c?f+=b.length+c.length:f+=b.length-e+d;if(d==e&&c)f-=c.length;a.focus();a.selectionStart=f;a.selectionEnd=f}else{a.value+=b+c;a.focus()}}var g=document.getElementById('comment')||0;var h={strong:function(){addEditor(g,'<strong>','</strong>')},em:function(){addEditor(g,'<em>','</em>')},del:function(){addEditor(g,'<del>','</del>')},underline:function(){addEditor(g,'<u>','</u>')},ahref:function(){var a=prompt('请输入链接地址','http://');var b=prompt('请输入链接描述','');if(a){addEditor(g,'<a target="_blank" href="'+a+'" rel="external">'+b+'</a>','')}},empty:function(){g.value="";g.focus()},fontColor:function(){var a=prompt("\u8f93\u5165\u989c\u8272css\u503c","#000000");a&&addEditor(g,"<font color=#"+a.match(/[^#]{3,6}/gi)[0]+">","</font>")}};window['SIMPALED']={};window['SIMPALED']['Editor']=h});


//colirtip
(function($){$.fn.colorTip = function(settings){var defaultSettings = {color: 'black',timeout:0}
	var supportedColors = ['red','green','blue','white','yellow','black'];
		settings = $.extend(defaultSettings,settings);
		return this.each(function(){
			var elem = $(this);
			if(!elem.attr('title')) return true;		
			var scheduleEvent = new eventScheduler();
			var tip = new Tip(elem.attr('title'));
			elem.append(tip.generate()).addClass('colorTipContainer');		
			var hasClass = false;
			for(var i=0;i<supportedColors.length;i++)
			{if(elem.hasClass(supportedColors[i])){hasClass = true;break;}}	
			if(!hasClass){elem.addClass(settings.color);}
			elem.hover(function(){tip.show();scheduleEvent.clear();},function(){scheduleEvent.set(function(){tip.hide();},settings.timeout);});
			elem.removeAttr('title');
		});
	}
	function eventScheduler(){}
	eventScheduler.prototype = {set	: function (func,timeout){this.timer = setTimeout(func,timeout);},clear: function(){clearTimeout(this.timer);}}
	function Tip(txt){this.content = txt;this.shown = false;}
	Tip.prototype = {generate: function(){return this.tip || (this.tip = $('<span class="colorTip">'+this.content+'<span class="pointyTipShadow"></span><span class="pointyTip"></span></span>'));},show: function(){if(this.shown) return;this.tip.css('margin-left',-this.tip.outerWidth()/2).show(100);this.shown = true;},hide: function(){this.tip.hide();this.shown = false;}}
})(jQuery);

$('.sharebar [title], .statusindex a[title], #gotocomment, #gototop, #gotobottom, #bdshare a[title]').colorTip({color:'black'});

/*jQuery(document).ready(function($) {
    $("a").mouseover(function(c) {
        this.myTitle = this.title;
        this.myHref = this.href;
        this.myHref = this.myHref.length > 30 ? this.myHref.toString().substring(0, 30) + "...": this.myHref;
        this.title = "";
        var d = "<div id='tooltip'><p>" + this.myTitle + "<em>" + this.myHref + "</em></p></div>";
        $("body").append(d);
        $("#tooltip").css({
            opacity: "0.8",
            top: c.pageY + 20 + "px",
            left: c.pageX + 10 + "px"
        }).show("fast")
    }).mouseout(function() {
        this.title = this.myTitle;
        $("#tooltip").remove()
    }).mousemove(function(c) {
        $("#tooltip").css({
            top: c.pageY + 20 + "px",
            left: c.pageX + 10 + "px"
        })
    })
});*/