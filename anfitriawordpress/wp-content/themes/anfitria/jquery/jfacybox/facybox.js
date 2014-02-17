$(function() {

	  lightFancyBoxWidth = 700;
	  lightFancyBoxHeight = 400;

	  $('a.light').each(function(){
		$(this).click(function(){

			html  = '<div id="mask"></div>';
			html += '<div id="fancybox-wrap">';
			html += '<div id="fancybox-outer">';
			html += '<div class="fancybox-bg" id="fancybox-bg-n"></div>';
			html += '<div class="fancybox-bg" id="fancybox-bg-ne"></div>';
			html += '<div class="fancybox-bg" id="fancybox-bg-e"></div>';
			html += '<div class="fancybox-bg" id="fancybox-bg-se"></div>';
			html += '<div class="fancybox-bg" id="fancybox-bg-s"></div>';
			html += '<div class="fancybox-bg" id="fancybox-bg-sw"></div>';
			html += '<div class="fancybox-bg" id="fancybox-bg-w"></div>';
			html += '<div class="fancybox-bg" id="fancybox-bg-nw"></div>';
			html += '<div id="fancybox-content">';
			html += '<iframe src="' + $(this).attr('href') + '" frameborder="0" allowfullscreen></iframe>';
			html += '</div>';
			html += '<a id="fancybox-close" style="display: inline;"></a>';
			html += '</div>';
			html += '</div>';

			$('body').prepend(html);

			$('#fancybox-wrap').width(lightFancyBoxWidth + 20);
			$('#fancybox-content').width(lightFancyBoxWidth);
			$('#fancybox-content').height(lightFancyBoxHeight);

			$('#fancybox-close').click(function(){
				$('#mask').toggle().remove();
				$('#fancybox-wrap').toggle().css({top: 0, left: 0}).remove();
			});
			
			positionLeft = ($(window).width() - $('#fancybox-wrap').width()) / 2;
			positionTop = ($(window).height() - $('#fancybox-wrap').height()) / 2;
			positionTop =  positionTop + $(window).scrollTop();
			
			$('#fancybox-wrap').css({top: positionTop, left: positionLeft});
			$('#mask').css({top: $(window).scrollTop()});
			
			$('#mask').css('display','block');
			$('#fancybox-wrap').css('display','block');
			
			return false;
			
		});
	  });
	  
  });