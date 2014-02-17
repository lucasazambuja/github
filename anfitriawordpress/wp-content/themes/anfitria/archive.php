<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<?php if (get_query_var('monthnum')) : ?>

	<?php get_template_part('section','archive'); ?>
	
<?php else : ?>

	<?php get_template_part('section','content'); ?>
	
<?php endif?>

<?php get_sidebar();?>
 
<?php get_footer(); ?>