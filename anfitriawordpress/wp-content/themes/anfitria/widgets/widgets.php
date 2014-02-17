<?php

$includes = array(
    'widgets/patrocinio.php',
    'widgets/destaque.php',
    'widgets/facebook.php',
    'widgets/perfil.php',
    'widgets/video.php',
    'widgets/instagram.php',
    'widgets/links.php',
    'widgets/arquivos-anfitria.php',
	'widgets/social.php',
	'widgets/tags.php',
	'widgets/list-category.php'
);

$includes = apply_filters('anfitria_widgets_includes', $includes);

foreach ($includes as $i) {
    locate_template($i, true);
}

?>