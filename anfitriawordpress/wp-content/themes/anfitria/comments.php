<?php

if ( post_password_required() )
	return false;
?>

<div class="list">

<div class="nav-comments">
	<?php paginate_comments_links( array('prev_text' => '&laquo;', 'next_text' => '&raquo;') ); ?>
</div>

<?php if ($comments = getComments()) : ?>

<ul>

<?php foreach($comments as $comment) : ?>

<li id="<?php echo $comment->comment_ID;?>">

	<div class="comment">
		<span class="comment-author"><?php echo $comment->comment_author;?></span>
		<?php echo $comment->comment_content;?>
	</div>
	
	<div class="line-comment"></div>
	
	<?php if ($reply = getReplyComment($comment->comment_ID)) : ?>
	
	<div class="comment replace">
		<span class="comment-author"><?php echo $reply->comment_author;?></span>
		<?php echo $reply->comment_content;?>
	</div>
	
	<div class="line-comment"></div>
	
	<?php endif; ?>
	
</li>

<?php endforeach;?>

</ul>

<?php endif; ?>

</div>

<form action="<?php theHomeUrl();?>/wp-comments-post.php" method="post" id="commentform" class="comment-form">

	<p class="comment-form-author">
		<input id="author" name="author" type="text" value="Nome" size="30" aria-required="true" data-value="Nome">
	</p>
	
	<p class="comment-form-email">
		<input id="email" name="email" type="text" value="Email" size="30" aria-required="true" data-value="Email">
	</p>
	
	<p class="comment-form-comment">
		<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" data-value="Comentário">Comentário</textarea>
	</p>
	
	<p class="form-submit">
		<input name="submit" type="submit" id="submit" value="Enviar">
		<input type="hidden" name="comment_post_ID" value="<?php the_ID();?>" id="comment_post_ID">
		<input type="hidden" name="comment_parent" id="comment_parent" value="0">
	</p>

</form>