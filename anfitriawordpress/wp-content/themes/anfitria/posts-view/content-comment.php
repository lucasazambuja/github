<li class="post" id="<?php the_ID();?>">

	<div class="post-bg">

		<div class="meta-header">
			<div>
				<span class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></span>
				<div class="line"></div>
				<span class="post-date"><?php the_date();?></span>
			</div>
		</div>
		
		<div class="post-content">
			<?php the_content();?>
		</div>
		
		<div class="post-footer">
			<div class="author">
				<div class="author-name"><span>Postado por <?php the_author();?></span></div>
				<div class="line"></div>
			</div>
			
			<div class="comments-like">
				<a href="<?php the_permalink();?>#comments" target="_blank"><?php theCountComments();?></a>
				<a href="" class="like" id="<?php the_ID();?>"><?php the_like();?> Gostaram</a>
			</div>
		</div>
		
	</div>
	
	<div class="comments-list" id="comment-<?php the_ID();?>">
				
		<?php get_template_part('comments'); ?>
					
		<div class="navigation">
		</div>
 					
	</div>
	
	<div class="post-bg-footer"><img src="<?php echo get_template_directory_uri(); ?>/img/post-footer-bg.png"></div>
		
</li> <!-- end .post -->