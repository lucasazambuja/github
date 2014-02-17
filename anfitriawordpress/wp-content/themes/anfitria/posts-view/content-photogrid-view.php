<li class="post" id="<?php the_ID();?>">

	<div class="post-bg">

		<div class="meta-header">
			<div>
				<span class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></span>
				<div class="line"></div>
				<span class="post-date"><?php the_date();?></span>
			</div>
		</div>
		
		<div class="post-content-photogrid">
		
			<div class="article-body" role="acontent">

				<div class="photogrid">
				
				<?php $images = getImagesArrayPost();?>
				<?php $num = sizeof($images);?>
				
				<?php if ($num > 1) : ?>
				
					<ul class="count-<?php echo $num;?>">
					
					<?php for ($i=0;$i<$num;$i++) : ?>
		
						<?php $img = wp_get_attachment_image_src( $images[$i], 'full' ); ?>
						<?php $style = "background: url('" . getImageUrlModify($img[0]) . "') no-repeat center;" ?>
						<?php $style .= ($img[1] < $img[2]) ? "background-size: 100% auto" : "background-size: auto 100%;";?>
					
						<li class="photo-<?php echo $i + 1;?>">
							<a href="<?php the_permalink();?>">
								<div class="image-mask"></div>
								<div class="image" style="<?php echo $style;?>"></div>
								<img src="http://placehold.it/640/fff/fff/" alt="">
							</a>
						</li>
					  
					<?php endfor;?>
					
					</ul>
					
				<?php else : ?>
				
				<ul class="count-<?php echo $num;?>">
		
						<?php $img = wp_get_attachment_image_src( $images[0], 'full' ); ?>
					
						<li class="photo-<?php echo $i + 1;?>">
							<a href="<?php the_permalink();?>">
								<div class="image-mask"></div>
								<img src="<?php echo getImageUrlModify($img[0]);?>" alt="">
							</a>
						</li>
				
				</ul>
				
				<?php endif;?>
					
				</div>
		
			</div>
			
			<div class="excpert-post">
				<?php the_content();?>
			</div>
		
		</div>
		
		<div class="post-footer">
			<div class="author">
				<div class="author-name"><span>Postado por <?php the_author();?></span></div>
				<div class="line"></div>
			</div>
			
			<div class="comments-like">
				<?php global $wp_query;?>
				<a href="<?php the_custom_permalink_comment($wp_query); echo '#comment-' . get_the_ID();?>"><?php theCountComments();?></a>
				<a href="" class="like" id="<?php the_ID();?>"><?php the_like();?> Gostaram</a>
			</div>
		</div>
		
	</div>
	
	<div class="post-bg-footer"><img src="<?php echo get_template_directory_uri(); ?>/img/post-footer-bg.png"></div>
		
</li> <!-- end .post -->