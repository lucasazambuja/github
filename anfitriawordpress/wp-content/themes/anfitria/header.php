<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes();?>>
	<head>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link href="http://fonts.googleapis.com/css?family=Muli:300.400" rel ="stylesheet" type ="text/css" />
		<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>" />
		<meta http-equiv="content-language" content="<?php bloginfo( 'language' ); ?>" />
	
		<title><?php wp_title( ' | ', true, 'right' ); bloginfo( 'name' ); ?></title>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		
		<?php wp_head(); ?>
		
		<script type="text/javascript">
		    $(document).ready(function($){
				$('#post-content a').each(function(){$(this).attr('target','blank');});
		    });
		</script>
		
	</head>

	<body>

	<div id="wrap">
	
		<div id="container">
		
			<div id="header">
			
				<ul id="nav-1" class="nav group-collum-5">
				
				<?php $query = getMenu('menu-1');?>
				
				<?php if ( $query->have_posts() ) : ?>
				
					<?php while ( $query->have_posts() ) : $query->the_post();?>
					
						<?php theLinkMenu();?>
						
					<?php endwhile;?>
				
				<?php endif; wp_reset_postdata();?>
				
					<!-- <li class="sub">				
						<div class="center"><a href="#">Menu opcao</a><img src="http://placehold.it/600x600&amp;text=FooBar1"></div>
						<ul>
							<li class="sub-item"><div class="sub-center"><a href="#">Menu opcao</a></div></li>
							<li class="sub-item"><div class="sub-center"><a href="#">Menu opcao</a></div></li>
							<li class="sub-item"><div class="sub-center"><a href="#">Menu opcao</a></div></li>
							<li class="sub-item"><div class="sub-center"><a href="#">Menu opcao</a></div></li>
						</ul>
					</li>
					
					<li><div class="center"><a href="#">Menu opcao</a></div></li>
					<li><div class="center"><a href="#">Menu opcao</a></div></li>
					<li><div class="center"><a href="#">Menu opcao</a></div></li>
					<li><div class="center"><a href="#">Menu opcao</a></div></li>
					
					<li class="sub">				
						<div class="center"><a href="#">Menu opcao</a></div>
						<ul>
							<li class="sub-item"><div class="sub-center"><a href="#">Menu opcao</a></div></li>
							<li class="sub-item"><div class="sub-center"><a href="#">Menu opcao</a></div></li>
							<li class="sub-item"><div class="sub-center"><a href="#">Menu opcao</a></div></li>
							<li class="sub-item"><div class="sub-center"><a href="#">Menu opcao</a></div></li>
						</ul>
					</li>
					
					<li><div class="center"><a href="#">Menu opcao</a></div></li> -->
				</ul>
				
				<?php $query = getBanners();?>
				
				<?php if ( $query->have_posts() ) : ?>
				
					<div id="banner">
					
					<?php while ( $query->have_posts() ) : $query->the_post();?>
					
						<a href="<?php theHomeUrl();?>"><img alt="banner" src="<?php theUrlThumbFull();?>"></a>
						
					<?php endwhile;?>
						
					</div>
				
				<?php else : ?>
				
					<div id="banner"><a href="<?php theHomeUrl();?>"><img alt="banner" src=""></a></div>
				
				<?php endif; wp_reset_postdata();?>
				
				<ul id="nav-2" class="nav group-collum-6">
				
				<?php $query = getMenu('menu-2');?>
				
				<?php if ( $query->have_posts() ) : ?>
				
					<?php while ( $query->have_posts() ) : $query->the_post();?>
					
						<?php theLinkMenu();?>
						
					<?php endwhile;?>
				
				<?php endif; wp_reset_postdata();?>
				
					<!-- <li><div class="center"><a href="#">Menu opcao</a></div></li>
					<li><div class="center"><a href="#">Novidade<br>Matiz</a></div></li>
					<li><div class="center"><a href="#">Menu opcao</a></div></li>
					<li class="sub">				
						<div class="center"><a href="#">Menu opcao</a></div>
						<ul>
							<li class="sub-item"><div class="sub-center"><a href="#">Menu opcao</a></div></li>
							<li class="sub-item"><div class="sub-center"><a href="#">Menu opcao</a></div></li>
							<li class="sub-item"><div class="sub-center"><a href="#">Menu opcao</a></div></li>
							<li class="sub-item"><div class="sub-center"><a href="#">Menu opcao</a></div></li>
						</ul>
					</li>
					<li><div class="center"><a href="#">Menu opcao</a></div></li> -->
				</ul>
				
			</div> <!-- end #header -->