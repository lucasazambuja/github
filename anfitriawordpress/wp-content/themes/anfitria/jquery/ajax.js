$(document).ready(function($){
   
	$('.like').each(function(){
		$(this).live('click', function(){
			$(this).unbind('click');
			$(this).removeClass('like').addClass('like-click');
			var regExp = new RegExp('([0-9]+)\\sGostaram');
			html = $(this).html();
			html = html.replace(regExp, '$1');
			newhtml = String(parseInt(html) + 1) + " Gostaram";
			$(this).html(newhtml);
			var thisidpost =  $(this).attr('id');
						
			$.ajax({
			
		                url: the_ajax_script.ajaxurl,
		                type: 'POST',
		                data: {
		                    action : 'add_like_jquery',
		                    idpost : thisidpost
		                },
		                
		                success:function(results, textStatus, XMLHttpRequest){
		                   console.log('like');
		                },
		                
		                error: function(XMLHttpRequest, textStatus, results){
				   console.log('erro');
		                }
		       });
		       
		       $(this).click(returnFalse);
		       return false;
			
		});
	});
	
});

function returnFalse(){
	
	return false;
	
}