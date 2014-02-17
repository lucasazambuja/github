<?php
/* Template Name: movies */

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php get_header();?>

<div id="content">

<div id="posts" class="movies">

	<ul>
	
	<?php getVideos();?>
	<?php if (have_posts()) : ?>
	
		<li class="post" id="0">
		
			<div class="post-bg">
			
			<h1>VIDEOS ANFITRIÃ</h1>
			
				<ul>
				
				<div class="line-movie"></div>
				
				<?php while (have_posts()) : the_post();?>
				
					<li class="movie" id="<?php the_ID();?>">
						
						<div class="movie-attachment"><a href="<?php theLinkIframe();?>" class="light"><img src="<?php theThumbVideo()?>"></a></div>
						
						<div class="movie-description">
							<div>
								<a href="<?php theLinkPostMovie();?>"><?php the_title();?></a>
								<p><?php the_excerpt();?></p>
								<a href="<?php the_permalink();?>" class="see-more" target="_blank">Leia mais</a>
							</div>
						</div>
						
					</li>
					
					<div class="line-movie"></div>
				
				<?php endwhile; ?> 
				
				</ul>
				
			</div>
			
			<div class="post-bg-footer"><img src="<?php echo get_template_directory_uri(); ?>/img/post-footer-bg.png"></div>
				
		</li> <!-- end .post -->
		
		<div id="page-navi-post">
		
			<?php wp_pagenavi();?>
			
		</div>
		
		<?php else : ?>
		
		<li class="post" id="0">
			
			<div class="post-bg">
				
				<div class="post-content">
					<h3> Nenhum resultado encontrado para <?php the_search_query();?> </h3>
				</div>
			
			</div>
			
			<div class="post-bg-footer"><img src="<?php echo get_template_directory_uri(); ?>/img/post-footer-bg.png"></div>
			
		</li>
		
		<?php wp_reset_query(); endif;?>
		
	</ul>
	
</div>
<?php get_sidebar(); get_footer();?>