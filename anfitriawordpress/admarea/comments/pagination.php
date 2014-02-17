<?php include('paginacao.php');?>

<?php

function page_nav($num_result, $per_page) {

	$num_page = ceil($num_result/$per_page);
	if(!isset($_GET['pagina']))
		$_GET['pagina'] = 1;

	// estrutua $first $prev $page_prev $page_present $page_next $ret $next $last

	if ($num_page < 2 || $num_result == 0) {
		$first = '';
		$prev = '';
		$page_prev = '';
		$page_present = 'pagina ' . $_GET['pagina'];
		$page_next = '';
		$ret = '';
		$next = '';
		$last = '';
	}

	if ($num_page >= 2 && $num_page <= 3) {
		$first = '';
		$prev = '';
		$page_prev = ($_GET['pagina'] > 1) ? prevpage('pagina') : '';
		$page_present = '<span class="atual">' . $_GET['pagina'] . '</span>';
		$page_next = ($_GET['pagina'] < $num_page) ? nextpage('pagina') : '';
		$ret = '';
		$next = '';
		$last = '';
	}

	if ($num_page > 3) {
		$first = ($_GET['pagina'] > 1) ? urlParametros('pagina', 1, 'primeira') : '';
		$prev = ($_GET['pagina'] > 1) ? prevpages('pagina', 'anterior') : '';
		$page_prev =  ($_GET['pagina'] > 1) ? prevpage('pagina') : '';
		$page_present = '<span class="atual">' . $_GET['pagina'] . '</span>';
		$page_next = ($_GET['pagina'] < $num_page) ? nextpage('pagina') : '';
		$ret = ($_GET['pagina'] < $num_page - 1) ? '<span> ... </span>' : '';
		$next = ($_GET['pagina'] < $num_page) ? nextpages('pagina', 'proximo') : '';
		$last = ($_GET['pagina'] < $num_page) ? urlParametros('pagina', $num_page, 'ultima') : '';
	}

	echo '<div>' . $first . $prev . $page_prev . $page_present . $page_next . $ret . $next . $last . '</div>';

}

?>
