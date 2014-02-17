$(function(){
		
		$('.nav > li').hover(
			function() {
				$(this).children().children().eq(1).css('display','block');
				$(this).children().children().eq(0).css({color: '#685e38', fontWeight: 'bold'});
		  }, function() {
			  	$(this).children().children().eq(1).css('display','none');
			  	$(this).children().children().eq(0).css({color: '#685e38', fontWeight: 'normal'});
		});
  
  		$('div.center').each(function(){

  	  		moveTop = ($(this).height() - $(this).find('a').height()) / 2 + "px";
  	  		$(this).find('a').css({top: moveTop});
  	  		$(this).find('.menu-icon-title').css({top: '60%'});
  	  		
  	  	});
  		
  		$('div.sub-center').each(function(){

  	  		moveTop = ($(this).height() - $(this).find('a').height()) / 2 + "px";
  	  		$(this).find('a').css({top: moveTop});
  	  		
  	  	});

		$('.sub').hover(
			  function() {
				  	$(this).find('ul').css({display: 'block'});
			  }, function() {
				  $(this).find('ul').css({display: 'none'});
		});

		$('.sub ul').css({display: 'none'});
		
		$('#author, #email, #comment, #s').focus(function(){
			if( $(this).val() == $(this).attr('data-value') ) $(this).val('');
		});
		
		$('#author, #email, #comment, #s').blur(function(){
			if( $(this).val() == '' ) $(this).val($(this).attr('data-value'));
		});
		
		hash = window.location.hash;
		
		if (hash)
			$('html, body').scrollTop( $(hash).offset().top);
			
		$('.image-case').each(function(){
			attachment = $(this).next().children();
			$(this).find('img').eq(0).width('100%').height('100%');
			attachment.append($(this).find('img').eq(0));
		});

	});

	function resizeTablet() {
		
		if($(window).width() < 800) {
			
			element = $('<div>',{
				id: 'sidebar-tablet',
				prepend: $('#sidebar-1').clone()
			});

			$('body').prepend(element);
			$(this).off('resize');
			$(this).resize(noresizeTablet);
			
		}
		
	}

	function noresizeTablet() {
		if($(window).width() >= 800) {
			$('#sidebar-tablet').remove();
			$(this).off('resize');
			$(this).resize(resizeTablet);
		}
	}