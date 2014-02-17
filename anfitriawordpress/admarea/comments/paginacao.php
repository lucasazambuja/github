<?php

function urlParametros($parametro, $newvalue, $text) {

	$url = 'http://';
	$url .= $_SERVER['HTTP_HOST'];
	$url .= $_SERVER['PHP_SELF'];

	if ($_GET)
		$url .= '?';

	if (isset($_GET[$parametro])) {
		$page = $_GET[$parametro];
		$_GET[$parametro] = $newvalue;
	}

	$i = 0;

	foreach ($_GET as $key => $value) {

		if ($i < sizeof($_GET) - 1)
			$url .= $key . '=' . $value . '&';
		else
			$url .= $key . '=' . $value;

		$i++;
	}

	$_GET[$parametro] = $page;

	return '<a href="' . $url . '"><span>' . $text . '</span></a>';

}


function urlParametro($parametro, $newvalue) {

	$url = 'http://';
	$url .= $_SERVER['HTTP_HOST'];
	$url .= $_SERVER['PHP_SELF'];

	if ($_GET)
		$url .= '?';

	if (isset($_GET[$parametro])) {
		$page = $_GET[$parametro];
		$_GET[$parametro] = $newvalue;
	}

	$i = 0;

	foreach ($_GET as $key => $value) {

		if ($i < sizeof($_GET) - 1)
			$url .= $key . '=' . $value . '&';
		else
			$url .= $key . '=' . $value;

		$i++;
	}

	$_GET[$parametro] = $page;

	return '<a href="' . $url . '"><span>' . $newvalue . '</span></a>';

}

function nextpage($parametro) {
	return urlParametro($parametro, $_GET[$parametro] + 1);
}

function nextpages($parametro, $text) {
	return urlParametros($parametro, $_GET[$parametro] + 1, $text);
}

function prevpage($parametro) {
	return urlParametro($parametro, $_GET[$parametro] - 1);
}

function prevpages($parametro, $text) {
	return urlParametros($parametro, $_GET[$parametro] - 1, $text);
}

// echo urlParametro('pagina', 10);

?>
