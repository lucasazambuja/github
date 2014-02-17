<div class="metabox-galery">

   <?php if ( have_posts() ) : ?>

   <ul id="gallery" class="gallery ui-helper-reset ui-helper-clearfix">

	<?php while ( have_posts() ) : the_post(); ?>
	
		<?php $img = wp_get_attachment_image_src( get_the_ID(), 'full' ); ?>
	
		<?php $style = "background: url('" . getImageUrlModify($img[0]) . "') no-repeat center;" ?>
		<?php $style .= ($img[1] < $img[2]) ? "background-size: 100% auto" : "background-size: auto 100%;";?>
		<?php $listyle = ( is_numeric(array_search(get_the_ID(), getImagesValuesArray())) ) ? "display: none;" : '';?>
		
		<li class="ui-widget-content ui-corner-tr" id="<?php the_ID();?>" style="<?php echo $listyle;?>">
			<img alt="The peaks of High Tatras" width="100" height="100" style="<?php echo $style;?>">
		</li>
		
	<?php endwhile; ?>
		
	</ul>
		
		
	<div class="page-nav-ajax">	
		<?php // wp_pagenavi(); ?>
	</div>
		
		<?php wp_reset_query(); ?>
		
	<?php endif; ?>
 
	<div id="trash" class="ui-widget-content ui-state-default ui-droppable">
	
		<ul class="gallery ui-helper-reset">
		
		<?php $images = new WP_Query( getImageArray() ); ?>
		<?php if ( $images->have_posts() ) : ?>
		
		<?php while ( $images->have_posts() ) : $images->the_post(); ?>
		
			<?php $img = wp_get_attachment_image_src( get_the_ID(), 'full' ); ?>
	
			<?php $style = "background: url('" . getImageUrlModify($img[0]) . "') no-repeat center;" ?>
			<?php $style .= ($img[1] < $img[2]) ? "background-size: 100% auto" : "background-size: auto 100%;";?>
			
			<li class="ui-widget-content ui-corner-tr ui-draggable" id="<?php the_ID();?>">
				<img alt="The peaks of High Tatras" width="100" height="100" style="<?php echo $style;?>">
			</li>
		
		<?php endwhile;?>
		
		<?php endif;?>
		
		</ul>
	
	</div>

	<input type="hidden" id="images" name="images-gallery" value="<?php theImagesValues();?>">

</div>