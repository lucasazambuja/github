<?php
/* Template Name: contato */

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php get_header();?>

<div id="content">

<div id="posts" class="contact">

	<ul>
	
		<li class="post" id="0">
		
			<div class="post-bg">
			
			<h1>CONTATO ANFITRIÃ</h1>
			
			<div id="content-form"><?php the_content();?></div>

			<form id="contact-form" name="contact-form" method="post">
			
				<p>
					<label for="name">Seu Nome: </label>
	  				<input type="text" name="name" id="name" value="">
				</p>
				
				<p>
					<label for="email">Seu E-mail: </label>
	  				<input type="text" name="email" id="email" value="">
				</p>
				
				<p>
					<label for="phone">Seu Telefone: </label>
	  				<input type="text" name="phone" id="phone" value="">
				</p>
				
				<p>
					<label for="subject">Assunto: </label>
	  				<input type="text" name="subject" id="subject" value="">
				</p>
				
				<p>
					<label for="message">Mensagem: </label>
	  				<textarea name="message" id="message" rows="10"></textarea>
				</p>
				
				<p class="submit-buttom">
	  				<input type="submit" name="send" id="send" value="Enviar">
				</p>
				
			
			</form>
				
			</div>
			
			<div class="post-bg-footer"><img src="<?php echo get_template_directory_uri(); ?>/img/post-footer-bg.png"></div>
				
		</li> <!-- end .post -->
		
	</ul>
	
</div>
<?php get_sidebar(); get_footer();?>