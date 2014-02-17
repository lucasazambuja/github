<?php

/* Template Name: paginas */
global $post;
$slug = $post->post_name;

$url = get_option('siteurl').'/category/'.$slug.'/';
?>

<script type="text/javascript">document.location = "<?php echo $url;?>"</script>