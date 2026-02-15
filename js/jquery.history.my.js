function historial(){
	window.addEventListener('popstate',popUrl,false);
	var urls=document.querySelectorAll('a.a,form .submit');
	$(document).on('click','a.a,form .submit',clkUrl);
	var stt=chainState(window.location.href);
	if(window.history.state==null){
		if(stt.url==''){
			window.history.replaceState({url:'novelties',prm:'',href:stt.href+'novelties.html'},null,'novelties.html');
		}else{
			window.history.replaceState(stt,null,stt.url+'.html'+(stt.prm?'?'+stt.prm:''));
		}
	}else{
		window.history.replaceState(stt,null,stt.url+'.html'+(stt.prm?'?'+stt.prm:''));
	}
	cargar(window.history.state.url,window.history.state.prm||null)
}
function clkUrl(e){
	e.preventDefault();
	var stt=chainState(this.href);
	if(stt.url!=window.history.state.url||stt.href!=window.location.href){
		window.history.pushState(stt,null,stt.url+'.html'+(stt.prm?'?'+stt.prm:''));
		cargar(window.history.state.url,window.history.state.prm||null);
	}
}
function popUrl(e){
	e.preventDefault();
	cargar(e.state.url,e.state.prm||null)
}
function cargar(url,prm){
	prm=(prm?decodeURIComponent(prm):'')
	var container=$('#workarea');
	container.html(charge);
	var php="files/"+url.replace('.html','')+'.php',href=url;
	var node=$('.a[href^="'+href+'"]');
	var arg={url:php,type:'get',data:prm,dataType:'html'};
	var ajx=$.ajax(arg)
		.done(function(req){
			if(req.slice(0,15)!='<!DOCTYPE html>'){
//				console.log(req.slice(0,15))
				container.html(req);
			}else{
				container.load('files/vacio.php')
			}
		})
		.fail(function(req){container.load('files/vacio.php')})
		.always(function(){
			$('#menu').find('a.a.active').removeClass('active');
			$('#menu').find('a.a[href^="'+href+'"]').addClass('active');
			$('head title').text(url.replace(/#(.+)?(.*)/ig,'$1'))
		});
}
function chainState(href){
	var re=/([\w\W]*\/)(\w*)(\.?\w*)(\??)(.*)/ig;
	var url=href.replace(re,'$2');
	var prm=href.replace(re,'$5');
	return {url:url,prm:prm,href:href};
}
window.addEventListener('load',historial,false)


/*(function($){
	$.fn.hist=function(){
		var container=$('#workarea'),regHref=/([\w\W]*\/)(\w*\.?\w*)(\??)(.*)/ig;
		var HRef=window.history.state||decodeURIComponent(window.location.href);
		var wStart='novelties.html';
		var wFile=HRef.replace(regHref,'$2');
		var wQStr=HRef.replace(regHref,'$4');
		var url=wFile||wStart;
		console.log(this);
		var chClk=chClick;
		window.history.replaceState(url+(wQStr?'?'+wQStr:''),false,url+(wQStr?'?'+encodeURIComponent(wQStr):''));
		read(url,wQStr);
		this.each(function(){
//			console.log(this);
			$(this).on('click',chClick);
		});
		$(window).on('popstate',chState);
		function chClick(e){
			e.preventDefault();
			var HRef=e.target.href;
			url=HRef.replace(regHref,'$2');
			wQStr=decodeURIComponent(HRef.replace(regHref,'$4'));
			if(window.history.state!=HRef||window.history.state==null){
				window.history.pushState(url+(wQStr?'?'+wQStr:''),false,url+(wQStr?'?'+encodeURIComponent(wQStr):''))
				read(url,wQStr);
			}
		}
		function chState(e){
			e.preventDefault();
			var HRef=window.history.state||decodeURIComponent(window.location.href);
			url=HRef.replace(regHref,'$2');
			wQStr=HRef.replace(regHref,'$4');
			read(url,wQStr);
		}
		function read(url,qryStr){
			if(!qryStr||typeof(qryStr)=='undefined'){qryStr=''}else{qryStr=qryStr.toString()}
//console.log(url+' --- '+qryStr);
			container.html(charge);
			var node=$('.hist[href^="'+url+'"]');
			var php="files/"+url.replace('.html','.php'),href=url;
			var arg={url:php,type:'get',dataType:node.attr('datatype')};
			if(qryStr){arg['url']=arg['url']+'?'+qryStr;}
			var ajx=$.ajax(arg)
				.done(function(req){container.html(req);})
				.fail(function(req){container.load('files/vacio.php')})
				.always(function(){
					$('#menu').find('a.active').removeClass('active');
					$('#menu').find('a[href^=\"'+href+'\"]').addClass('active');
					$('head title').text(url.replace(/#(.+)?(.*)/ig,'$1'))
				});
		};
	}
})(jQuery);
*/
