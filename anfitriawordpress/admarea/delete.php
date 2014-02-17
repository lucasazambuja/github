<?php
require_once('../wp-config.php');
wp_delete_post($_GET['post_id']);
header('location: '.get_option('siteurl').'/admarea/admin.php');
?>