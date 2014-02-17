<?php include('include.php');?>

<?php

	define('PER_PAGE', 5);

	function all_comments() {

		global $wpdb;

		if (!isset($_GET['pagina']))
			$pagina = 1;
		else
			$pagina = $_GET['pagina'];

		$per_page = PER_PAGE;
		$starting = ($pagina - 1) * $per_page;

		$filter = (isset($_GET['filter'])) ? $_GET['filter'] : 'td';
		$postid = (isset($_GET['post'])) ? $_GET['post'] : 0;


		if ($postid) {

		if ($filter == 'td')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_parent = 0  and comment_post_ID = %d  and comment_approved != 'trash' ORDER BY comment_ID DESC LIMIT %d,%d ", $postid, $starting, $per_page ), OBJECT);

		if ($filter == 'ar')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_approved = 1 and comment_ID IN (SELECT comment_parent FROM $wpdb->comments WHERE comment_parent != 0) and comment_post_ID = %d and comment_approved != 'trash' ORDER BY comment_ID DESC LIMIT %d,%d ", $postid, $starting, $per_page ), OBJECT);

		if ($filter == 'sna')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_parent = 0 and comment_approved = 0 and comment_post_ID = %d and comment_approved != 'trash' ORDER BY comment_ID DESC LIMIT %d,%d ", $postid, $starting, $per_page ), OBJECT);

		if ($filter == 'sa')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_parent = 0 and comment_approved = 1 and comment_post_ID = %d and comment_approved != 'trash' ORDER BY comment_date DESC", $postid ), OBJECT);

		if ($filter == 'sr')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_ID IN (SELECT comment_parent FROM $wpdb->comments WHERE comment_parent != 0) and comment_post_ID = %d and comment_approved != 'trash' ORDER BY comment_ID DESC LIMIT %d,%d ", $postid, $starting, $per_page ), OBJECT);
		if ($filter == 'snr')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_ID NOT IN (SELECT comment_parent FROM $wpdb->comments WHERE comment_parent != 0) and comment_parent = 0 and comment_post_ID = %d and comment_approved != 'trash' ORDER BY comment_ID DESC LIMIT %d,%d ", $postid, $starting, $per_page ), OBJECT);
		
		if ($filter == 'sanr')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_ID NOT IN (SELECT comment_parent FROM $wpdb->comments WHERE comment_parent != 0) and comment_parent = 0 and comment_post_ID = %d and comment_approved = 1 and comment_approved != 'trash' ORDER BY comment_ID DESC LIMIT %d,%d ", $postid, $starting, $per_page ), OBJECT);

		} else {

		if ($filter == 'td')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_parent = 0 and comment_approved != 'trash' ORDER BY comment_ID DESC LIMIT %d,%d ", $starting, $per_page ), OBJECT);

		if ($filter == 'ar')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_approved = 1 and comment_ID IN (SELECT comment_parent FROM $wpdb->comments WHERE comment_parent != 0) ORDER BY comment_ID DESC LIMIT %d,%d ", $starting, $per_page ), OBJECT);

		if ($filter == 'sna')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_parent = 0 and comment_approved = 0 ORDER BY comment_ID DESC LIMIT %d,%d ", $starting, $per_page ), OBJECT);

		if ($filter == 'sa')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_parent = 0 and comment_approved = 1 ORDER BY comment_ID DESC LIMIT %d,%d ", $starting, $per_page ), OBJECT);

		if ($filter == 'sr')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_ID IN (SELECT comment_parent FROM $wpdb->comments WHERE comment_parent != 0) and comment_approved != 'trash' ORDER BY comment_ID DESC LIMIT %d,%d ", $starting, $per_page ), OBJECT);
		
		if ($filter == 'snr')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_ID NOT IN (SELECT comment_parent FROM $wpdb->comments WHERE comment_parent != 0) and comment_parent = 0 and comment_approved != 'trash' ORDER BY comment_ID DESC LIMIT %d,%d ", $starting, $per_page ), OBJECT);
		
		if ($filter == 'sanr')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_ID NOT IN (SELECT comment_parent FROM $wpdb->comments WHERE comment_parent != 0) and comment_parent = 0 and comment_approved = 1 and comment_approved != 'trash' ORDER BY comment_ID DESC LIMIT %d,%d ", $starting, $per_page ), OBJECT);

		}

	}


	function per_page() {

		return PER_PAGE;

	}

	function overall_page() {

		global $wpdb;

		$filter = (isset($_GET['filter'])) ? $_GET['filter'] : 'td';
		$postid = (isset($_GET['post'])) ? $_GET['post'] : 0;

		if ($postid) {

		if ($filter == 'td')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_parent = 0 and comment_post_ID = %d and comment_approved != 'trash'", $postid), OBJECT);

		if ($filter == 'ar')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_approved = 1 and comment_ID IN (SELECT comment_parent FROM $wpdb->comments WHERE comment_parent != 0) and comment_post_ID = %d", $postid), OBJECT);

		if ($filter == 'sna')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_parent = 0 and comment_approved = 0 and comment_post_ID = %d and comment_approved != 'trash'", $postid), OBJECT);

		if ($filter == 'sa')
		return 1;

		if ($filter == 'sr')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_ID IN (SELECT comment_parent FROM $wpdb->comments WHERE comment_parent != 0) and comment_post_ID = %d", $postid), OBJECT);
		
		if ($filter == 'snr')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_ID NOT IN (SELECT comment_parent FROM $wpdb->comments WHERE comment_parent != 0) and comment_parent = 0 and comment_post_ID = %d", $postid), OBJECT);
		
		if ($filter == 'sanr')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_ID NOT IN (SELECT comment_parent FROM $wpdb->comments WHERE comment_parent != 0) and comment_parent = 0 and comment_approved = 1 and comment_post_ID = %d", $postid), OBJECT);

		} else {

		if ($filter == 'td')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_parent = 0 and comment_approved != 'trash'"), OBJECT);

		if ($filter == 'ar')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_approved = 1 and comment_ID IN (SELECT comment_parent FROM $wpdb->comments WHERE comment_parent != 0)"), OBJECT);

		if ($filter == 'sna')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_parent = 0 and comment_approved = 0 and comment_approved != 'trash'"), OBJECT);

		if ($filter == 'sa')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_parent = 0 and comment_approved = 1 and comment_approved != 'trash'"), OBJECT);

		if ($filter == 'sr')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_ID IN (SELECT comment_parent FROM $wpdb->comments WHERE comment_parent != 0)"), OBJECT);
		
		if ($filter == 'snr')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_ID NOT IN (SELECT comment_parent FROM $wpdb->comments WHERE comment_parent != 0) and comment_parent = 0"), OBJECT);
		
		if ($filter == 'sanr')
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_ID NOT IN (SELECT comment_parent FROM $wpdb->comments WHERE comment_parent != 0) and comment_parent = 0 and comment_approved = 1"), OBJECT);

		}

	}

	function filterpost() {
		echo (isset($_GET['post']) && $_GET['post'] != 0 && isset($_GET['filter']) && $_GET['filter'] == 'sa') ? 'sortable' : 'nosortable';
	}
	
	function filterpostbutton() {
		return (isset($_GET['post']) && $_GET['post'] != 0 && isset($_GET['filter']) && $_GET['filter'] == 'sa') ? true : false;
	}

	function commentstatus($approved) {
		echo ($approved) ? 'active' : 'noactive';
	}

	function commentstatustext($approved) {
		echo ($approved) ? 'desativar' : 'ativar';
	}

	function reply($id) {
		global $wpdb;
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_parent = %d ORDER BY comment_ID DESC LIMIT 0,1", $id), OBJECT);
	}

	function replycontent($id, $name) {
		$reply = reply($id);
		if (sizeof($reply) == 1)
			echo $reply[0]->comment_content;
		else
			echo $name . ',';
	}

	function replyclass($id) {
		echo (sizeof(reply($id)) == 1) ? 'reply-update' : 'reply-create';
	}

	function replyclasstext($id) {
		echo (reply($id)) ? 'atualizar' : 'responder';
	}

	function filtertext() {
		$filter = (isset($_GET['filter'])) ? $_GET['filter'] : 'td';

		if ($filter == 'td') echo 'Todos';
		if ($filter == 'ar') echo 'Ativos e Respondidos';
		if ($filter == 'sna') echo 'Somente Nao Ativos';
		if ($filter == 'sa') echo 'Somente Ativos';
		if ($filter == 'sr') echo 'Somente Respondidos';
		if ($filter == 'snr') echo 'Somente Nao Respondidos';
		if ($filter == 'sanr') echo 'Somente Ativos Nao Respondidos';
	}

	function postidtext() {
		echo (isset($_GET['post'])) ? get_post($_GET['post'], OBJECT)->post_title : '';
	}
	
	function mygetposts() {
	  	 $args = array(
		'posts_per_page'   => 1000,
		'offset'           => 0,
		'category'         => '',
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'post',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'publish',
		'suppress_filters' => true );
		
		return $args;
	}

?>