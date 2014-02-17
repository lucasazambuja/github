<div id="content">

	<div id="posts">
	
		<ul>
		
		<?php
		
		if (have_posts()) : while (have_posts()) : the_post();
			
			if ( get_post_meta( get_the_ID(), 'gallery_value_key', true ) ) :
			
				if ( get_query_var('post_open') == get_the_ID() ) :
				
					if (get_query_var('comment')) :
					
						get_template_part('posts-view/content','photogrid-comment');
						
					else :
					
						get_template_part('posts-view/content','photogrid-view');
						
					endif;	
						
				else :
				
					get_template_part('posts-view/content','photogrid');
					
				endif;
				
			else : 
			
				if ( get_query_var('comment') && get_query_var('post_open') == get_the_ID() ) :
				
					get_template_part('posts-view/content','comment');
					
				else :
				
					get_template_part('posts-view/content');
					
				endif;
				
			endif;

		endwhile;
			
		?> 
			
			<div id="page-navi-post">
			
				<?php wp_pagenavi();?>
				
			</div>
			
		<?php else : ?>
			
			<?php get_template_part('posts-view/no','post'); ?>
			
		<?php wp_reset_query(); endif;?>
			
		</ul>
		
	</div>