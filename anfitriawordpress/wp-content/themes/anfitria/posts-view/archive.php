<li class="post" id="0">
	
		<div class="post-bg">
		
		<h1>ARQUIVOS ANFITRIÃ</h1>
		<h2> <?php printf("%s de %d", mounthName(get_query_var('monthnum')), get_query_var('year'));?> </h2>
		
			<ul>
			
			<div class="line-movie"></div>
			
			<?php while (have_posts()) : the_post();?>
		
			<li class="archive" id="<?php the_ID();?>">
				
				<div class="image-case"><?php theCase();?></div>
				<div class="movie-attachment"><a href="<?php the_permalink();?>"></a></div>
				
				<div class="movie-description">
					<div>
						<span><?php theDate();?></span>
						<a href="<?php the_permalink();?>"><?php the_title();?></a>
						<p><?php the_excerpt();?></p>
						<a href="<?php the_permalink();?>" class="see-more" target="_blank">Veja o Post Completo</a>
					</div>
				</div>
				
			</li>
			
			<div class="line-movie"></div>
		
		<?php endwhile; ?> 
		
		</ul>
		
	</div>
	
	<div class="post-bg-footer"><img src="<?php echo get_template_directory_uri(); ?>/img/post-footer-bg.png"></div>
		
</li> <!-- end .post -->