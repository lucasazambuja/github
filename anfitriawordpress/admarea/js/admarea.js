$(function() {

	$('textarea.tinymce').tinymce({
		// Location of TinyMCE script
		script_url : 'js/tinymce/jscripts/tiny_mce/tiny_mce.js',
		height: "700",

		// General options
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
		
		theme_advanced_resizing : true,
		
	});

	$('input.datepicker').datepicker({
		format: 'yyyy-mm-dd'
	});

	$('.sortable').sortable({
		stop: function( event, ui ) {

			var order = "";

			$(this).find('.element-sort').each(function(){
				order += $(this).attr('id') + " ";
			});

			$(this).find('input:hidden').val(order);
		}
	});

	$('.element-sort').bind("contextmenu",function(e){

		$(this).fadeOut( "slow" , function() {
			$(this).remove();
		});

		orederThumb();

		return false;

	});

	$('.selectable').selectable();

	$('#add_imagem_thumb').bind('click', function() {

		$('#modal-select > .ui-selected .mask').each(function(){

			var id = $(this).parents('.element-modal:eq(0)').attr('id');
			colum = $('<div>').addClass('col-md-3 element-sort');
			a = $('<a>').addClass('thumbnail relative');
			a.prepend('<img data-src="holder.js/300x200" alt="..." src="http://placehold.it/150x150">')
			a.prepend($(this));
			colum.attr('id', id);
			colum.prepend(a);
			$('#sortable-thumb').append(colum);

		});

		$('#modal-select > .ui-selected').fadeOut( "slow" , function(){
			$(this).remove();
		});

		orederThumb();

		$('button[data-dismiss="modal"]:eq(0)').click();

	});
	
});

function orederThumb() {

	var order = "";

	$('#sortable-thumb .element-sort').each(function(){
		order += $(this).attr('id') + " ";
	});

	$('#order_thumbnail').val(order);

}

function PageAjax ( num_pages, numAfterBefore ) {

	this.numPages = num_pages;
	this.numAfterBefore = numAfterBefore;
	this.page = 1;
	this.htmlPage = $('<ul>').addClass('pagination');

	this.setPage = function( num ) {
		this.page = num;
	}

	this.html = function(selector) {

		this.pageBeforeHtml();
		this.pageCurrentHtml();
		this.pageAfterHtml();
		$(selector).append(this.htmlPage);

	}

	this.pageBeforeHtml = function() {

		if ( this.page < this.numAfterBefore )
			return false;

		var i = this.page - this.numAfterBefore;

		while( i < this.page ) {
			a = $('<a>').html(i).attr({ href : '#' });
			a.ajaxPageLink(this);
			this.htmlPage.append(a);
		}

		return true;

	}

	this.pageAfterHtml = function() {

		if ( this.page > (this.numPages - this.numAfterBefore) )
			return false;

		var i = this.page;

		while( i <= (this.page + this.numAfterBefore) ) {
			a = $('<a>').html(i).attr({ href : '#' });
			a.ajaxPageLink(this);
			this.htmlPage.append(a);
		}

		return true;

	}

	this.pageCurrentHtml = function() {

		a = $('<a>').html(this.page).attr({ href : '#' });
		this.htmlPage.append(a);

	}

}

$.fn.ajaxPageLink = function(object) {

	$(this).click(function(object){
		console.log(object.htmlPage);
	});

}