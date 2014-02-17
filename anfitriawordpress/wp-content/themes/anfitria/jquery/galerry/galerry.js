$(function() {
    // there's the gallery and the trash
    var $gallery = $( "#gallery" ),
      $trash = $( "#trash" );
 
    // let the gallery items be draggable
    $( "li", $gallery ).draggable({
      cancel: "a.ui-icon", // clicking an icon won't initiate dragging
      revert: "invalid", // when not dropped, the item will revert back to its initial position
      containment: "document",
      helper: "clone",
      cursor: "move",
      stop: function( event, ui ) {
    	  
      }
    
    });
    
    $( "li", $trash ).draggable({
        cancel: "a.ui-icon", // clicking an icon won't initiate dragging
        revert: "invalid", // when not dropped, the item will revert back to its initial position
        containment: "document",
        helper: "clone",
        cursor: "move",
        stop: function( event, ui ) {
      	  
        }
      
      });
 
    // let the trash be droppable, accepting the gallery items
    $trash.droppable({
      accept: "#gallery > li",
      activeClass: "ui-state-highlight",
      drop: function( event, ui ) {
        deleteImage( ui.draggable );
      }
    });
 
    // let the gallery be droppable as well, accepting items from the trash
    $gallery.droppable({
      accept: "#trash li",
      activeClass: "custom-state-active",
      drop: function( event, ui ) {
        recycleImage( ui.draggable );
      }
    });
 
    // image deletion function
    function deleteImage( $item ) {
    	
      $item.fadeOut(function() {
    	  
        var $list = $( "ul", $trash );
        $item.find( "a.ui-icon-trash" ).remove();
        $item.appendTo( $list ).fadeIn(function() {
        	
        	value = '';
        	
        	$('#trash li').each(function(){
        		value += $(this).attr('id') + '-';
        	});
        	
        	$('#images').val(value);
        });
        
      });
    }
 
    // image recycle function
    function recycleImage( $item ) {
      $item.fadeOut(function() {
        $item
          .find( "a.ui-icon-refresh" )
            .remove()
          .end()
          .css( "width", "100px")
          .find( "img" )
            .css( "height", "100px" )
          .end()
          .appendTo( $gallery )
          .fadeIn(function(){
        	  value = '';
          	
          	$('#trash li').each(function(){
          		value += $(this).attr('id') + '-';
          	});
          	
          	$('#images').val(value);
          });
      });
      
    }
 
  });