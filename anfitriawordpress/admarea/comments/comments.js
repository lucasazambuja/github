  $(function() {
  
    var sortable = false;
  
    $(" #activesortable ").click(function(){
    
    	if (!sortable) {
    		sortable = true;
    		$(" #activesortable ").html("Desativar ordem");
    		activesortable();
    	} 
    	
    	else {
    		desactivesortable();
    		sortable = false;
    		alert('desativo a ordem de comentarios');
    		window.location.reload();
    	}
    
    });

    $('select.filtertype').change(function () {
	    $( "select option:selected" ).each(function(i) {
		if (i == 0)
		window.location.assign(filter($(this).val()));
	    });
    });

   $('select.filterpost').change(function () {
	    $( "select.filterpost option:selected" ).each(function(i) {
		if (i == 0)
		window.location.assign(postid($(this).val()));
	    });
    });

	ajaxs();

	if (navigator.appName == 'Microsoft Internet Explorer')
		$('.center').center();

  });
  
  function activesortable() {
  
  	$(" ul#comments ").sortable({
	stop: function( event, ui ) {

		if (ui.item.index() < ($(this).children().size() - 1)) {
			if(orderajax(ui.item.attr('id'), ui.item.next().attr('id'), 'next') != '')
				alert('ordem de comentarios reorganizada');
		} else {
			if(orderajax(ui.item.attr('id'), ui.item.prev().attr('id'), 'prev') != '')
				alert('ordem de comentarios reorganizada');
		}
	}
    });

    $(" ul#comments ").disableSelection();
    
  }
  
  function desactivesortable() {
  
  	$(" ul#comments ").sortable( "disable" );
  	$(" ul#comments ").enableSelection();
  
  }

  function pagina(url, value) {

	var regExp = new RegExp('.+pagina.+');
	var myString = url;
	if(myString.match(regExp)) {
		var regExp = new RegExp('(.+)pagina=(\\w{1,10})(.+)?');
		var url = myString.replace(regExp, '$1pagina='+value+'$3');
	} else {
		var regExp = new RegExp('(.+)(\\?)(.+)');

		if (myString.match(regExp))
			var url = myString.replace(regExp, '$1$2$3&pagina='+value);
		else {
			var regExp = new RegExp('(.+)');
			var url = myString.replace(regExp, '$1?pagina='+value);
		}
		
	}

	return url;
  }

  function filter(value) {

	var regExp = new RegExp('.+filter.+');
	var myString = window.location.href;
	if(myString.match(regExp)) {
		var regExp = new RegExp('(.+)filter=(\\w{2,3})(.+)?');
		var url = myString.replace(regExp, '$1filter='+value+'$3');
	} else {
		var regExp = new RegExp('(.+)(\\?)(.+)');

		if (myString.match(regExp))
			var url = myString.replace(regExp, '$1$2$3&filter='+value);
		else {
			var regExp = new RegExp('(.+)');
			var url = myString.replace(regExp, '$1?filter='+value);
		}
		
	}

	return pagina(url, 1);
  }

  function postid(value) {

	var regExp = new RegExp('.+post.+');
	var myString = window.location.href;
	if(myString.match(regExp)) {
		var regExp = new RegExp('(.+)post=(\\d{1,10})(.+)?');
		var url = myString.replace(regExp, '$1post='+value+'$3');
	} else {
		var regExp = new RegExp('(.+)(\\?)(.+)');

		if (myString.match(regExp))
			var url = myString.replace(regExp, '$1$2$3&post='+value);
		else {
			var regExp = new RegExp('(.+)');
			var url = myString.replace(regExp, '$1?post='+value);
		}
		
	}

	return pagina(url, 1);
  }

  function ajaxs() {

	$('.active').click(function(){
		if(ajax('desactive_comment','', $(this).parents('li').attr('id')) != '')
			alert('comentario desativado');
			// window.location.reload();
	});

	$('.noactive').click(function(){
		if(ajax('active_comment','', $(this).parents('li').attr('id')) != '')
			alert('comentario ativado');
			// window.location.reload();
	});

	$('.reply-create').click(function(){
		object = $(this).parents('li');
		textarea = object[0].getElementsByTagName('textarea')[0];

		if(ajax('create_reply_comment', textarea.value, $(this).parents('li').attr('id')) != '') {
			alert('comentario respondido com sucesso!');
			window.location.reload();
		}
	});

	$('.reply-update').click(function(){
		object = $(this).parents('li');
		textarea = object[0].getElementsByTagName('textarea')[0];

		if(ajax('create_reply_comment', textarea.value, $(this).parents('li').attr('id')) != '') {
			alert('comentario atualizado com sucesso!');
			window.location.reload();
		}
	});

	$('.delet').click(function(){
		if(confirm("Deseja mesmo excluir esse comentario?"))
		if(ajax('delete_comment', '', $(this).parents('li').attr('id')) != '') {
			alert('comentario deletado com sucesso');
			window.location.reload();
		}
	});

  }

  function ajax(action, content, id) {

	$.ajax({
                url: 'ajax.php',
                type:'POST',
                data: {
                    action: action,
		    commentid: id,
		    content: content
                },

                success:function(result, textStatus, XMLHttpRequest){
                	// alert(result);
                },

                error: function(XMLHttpRequest, textStatus, result){
                    alert('erro');
                }
            });

  }

  function orderajax(idat, id, position) {

	$.ajax({
                url: 'ajax.php',
                type:'POST',
                data: {
                    action: 'order_comment',
		    commentid: id,
		    commentatid: idat,
		    position: position
                },

                success:function(result, textStatus, XMLHttpRequest){
                	// alert(result);
                },

                error: function(XMLHttpRequest, textStatus, result){
                    alert('erro');
                }
            });

  }

  jQuery.fn.center = function(){
	parentwidth = $(this).parent().width();
	moveleft = (parentwidth - $(this).width()) / 2;
	$(this).css({ left: moveleft, position: 'relative' });
  };

  function commentpostopen(link) {
	width = 800;
	height = 500;
	top = 0;
	left = 0;
	URL = link;

	window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');

   }