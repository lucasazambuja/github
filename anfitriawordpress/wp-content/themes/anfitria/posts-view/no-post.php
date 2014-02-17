<li class="post" id="0">
			
	<div class="post-bg">
		
		<div class="post-content">
		
			<?php if (!get_query_var('s')) : ?>
				<h3> Nenhum post cadastrado </h3>
			<?php else :?>
				<h3> Nenhum resultado encotrado para <?php echo get_query_var('s');?> </h3>
			<?php endif;?>
			
		</div>
	
	</div>
	
	<div class="post-bg-footer"><img src="<?php echo get_template_directory_uri(); ?>/img/post-footer-bg.png"></div>
	
</li>