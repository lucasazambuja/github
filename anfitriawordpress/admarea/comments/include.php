<?php include('../../wp-config.php');?>

<?php

if (is_user_logged_in() == NULL){
    header('Location: '.get_option('siteurl').'/admarea');
} ?>