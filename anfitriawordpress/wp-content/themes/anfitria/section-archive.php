<div id="content">

<div id="posts" class="movies">

	<ul>
	
	<?php getArchiveMonth();?>
	<?php if (have_posts()) : ?>
	
		<?php get_template_part('posts-view/archive'); ?>
		
		<div id="page-navi-post">
		
			<?php wp_pagenavi();?>
			
		</div>
		
		<?php else : ?>
		
			<?php get_template_part('posts-view/no','post'); ?>
		
		<?php wp_reset_query(); endif;?>
		
	</ul>
	
</div>