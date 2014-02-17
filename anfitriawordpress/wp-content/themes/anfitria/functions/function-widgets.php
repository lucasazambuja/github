<?php

$includes = array(
    'widgets/patrocinio.php'
);

foreach ($includes as $i) {
    locate_template($i, true);
}

?>
