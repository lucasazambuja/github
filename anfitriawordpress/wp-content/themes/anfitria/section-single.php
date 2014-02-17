<div id="content">

	<div id="posts">
	
		<ul>
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<li class="post" id="<?php the_ID();?>">
			
				<div class="post-bg">
			
					<div class="meta-header">
						<div>
							<span class="post-title"><?php the_title();?></span>
							<div class="line"></div>
							<span class="post-date"><?php the_date();?></span>
						</div>
					</div>
					
					<div class="post-content">
						<?php the_content();?>
					</div>
					
					<div class="post-footer">
						<div class="author">
							<span>Postado Por <?php the_author();?></span>
							<div class="line"></div>
						</div>
						
						<a href="<?php the_permalink();?>#comments" target="_blank"><?php theCountComments();?></a>
						<a href="" class="like" id="<?php the_ID();?>"><?php the_like();?> Gostaram</a>
					</div>
					
				</div>
				
				<div class="comments-list">
				
					<?php comments_template(); ?>
					
					<div class="navigation">
 					</div>
 					
				</div>
				
				<div class="post-bg-footer"><img src="<?php echo get_template_directory_uri(); ?>/img/post-footer-bg.png"></div>
					
			</li> <!-- end .post -->
			
			<?php endwhile; ?> 
			
			<?php wp_reset_query(); endif;?>
			
		</ul>
		
	</div>