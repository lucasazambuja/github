<?php include('pagination.php');?>
<?php include('config.php');?>
<!doctype html>
 
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>jQuery UI Sortable - Default functionality</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script src="comments.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
  <link rel="stylesheet" href="style.css" />

</head>
<body>

<div id="center" class="center">

<div id="warper">

	<div id="header" class="line">

		<div class="line">
			<select class="filtertype">
			  <option value=""><?php filtertext();?></option>
			  <option value="td">Todos</option>
			  <option value="ar">Ativos e Respondidos</option>
			  <option value="sna">Somente Nao Ativos</option>
			  <option value="sr">Somente Respondidos</option>
			  <option value="sa">Somente Ativos</option>
			  <option value="snr">Somente Nao Respondidos</option>
			  <option value="sanr">Somente Ativos Nao Respondidos</option>
			</select>
		</div>

		<div class="line">
			<select class="filterpost">
			  <option value=""><?php postidtext();?></option>
			  <option value="0">Todos</option>
			  	<?php wp_reset_query();?>
				<?php foreach (get_posts(mygetposts()) as $post):?>
					<option value="<?php echo $post->ID;?>"><?php echo $post->post_title;?></option>
				<?php  endforeach;?>
			</select>
		</div>
		
		<?php if (filterpostbutton()) : ?>
		
		<div class="line">
			<button type="button" id="activesortable">Ativar Ordem</button>
		</div>
		
		<?php endif;?>
		
	</div> <!-- end header -->


	<div id="content" class="line">

		<ul id="comments" class="<?php // filterpost();?>">

			<?php foreach(all_comments() as $comment):?>

			<li id="<?php echo $comment->comment_ID;?>" class="line"/>

				<div class="header-comment line">
					<div><?php echo $comment->comment_author;?></div>
					<div><?php echo $comment->comment_author_email;?></div>
					<div><button type="button" class="<?php commentstatus($comment->comment_approved);?>"><?php commentstatustext($comment->comment_approved);?></button></div>
				</div>

				<div class="comment-comment line">
					<div><?php echo $comment->comment_content;?></div>
				</div>

				<div class="comment-reply line">
					<div><textarea><?php replycontent($comment->comment_ID, $comment->comment_author);?></textarea></div>
				</div>

				<div class="comment-action line">
					<div>
						<button type="button" class="<?php replyclass($comment->comment_ID);?>"><?php replyclasstext($comment->comment_ID);?></button>
					</div>

					<div>
						<button type="button" class="delet">deletar</button>
					</div>
				</div>

				<a href="#" onclick="commentpostopen('<?php echo get_permalink( $comment->comment_post_ID );?>');"><?php echo get_post($comment->comment_post_ID, OBJECT)->post_title;?></a>

			</li>

			<?php endforeach;?>

		</ul>

	</div> <!-- end content -->

	<div id="footer-comment" class="line">

		<div id="page_nav"><?php page_nav(sizeof(overall_page()), per_page());?></div>

	</div> <!-- end footer -->

</div> <!-- end warper -->

</div> <!-- end center -->
 
 
</body>
</html>