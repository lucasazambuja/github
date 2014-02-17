<?php include('include.php');?>

<?php

$ajax = new Ajax();
$do = $_POST['action'];
$ajax->$do();


class Ajax {

  public function testajax() {
	echo $_POST['commentid'];
	die();
  }

  public function ajax_reply($id) {
		return $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_parent = %d ORDER BY comment_ID DESC LIMIT 0,1 ", $id), OBJECT);
  }

  public function update_reply_comment() {
	$reply = ajax_reply($_POST['commentid']);
	$commentarr = array();
	$commentarr['comment_ID'] = $reply->comment_ID;
	$commentarr['comment_content'] = $_POST['content'];
	wp_update_comment ( $commentarr );

	echo 'update reply';
	die();
  }

  public function create_reply_comment() {
	$time = current_time('mysql');
	$commentid = $_POST['commentid'];
	$content = $_POST['content'];
	$postid = get_comment($commentid, OBJECT)->comment_post_ID;
	$data = array(
		    'comment_post_ID' => $postid,
		    'comment_author' => 'Priscila Marques',
		    'comment_content' => $content,
		    'comment_parent' => $commentid,
		    'user_id' => 1,
		    'comment_date' => $time,
		    'comment_approved' => 1
		);

	wp_insert_comment($data);

	echo 'reply';
	die();
  }

  public function delete_comment() {
	$commentid = $_POST['commentid'];
	wp_delete_comment( $commentid, false );
	die();
  }

  public function active_comment() {
	$commentarr = array();
	$commentarr['comment_ID'] = $_POST['commentid'];
	$commentarr['comment_approved'] = 1;
	wp_update_comment ( $commentarr );
	die();
  }

  public function desactive_comment() {
	$commentarr = array();
	$commentarr['comment_ID'] = $_POST['commentid'];
	$commentarr['comment_approved'] = 0;
	wp_update_comment ( $commentarr );
	die();
  }

  public function addtime($commentid, $newtime) {
	$commentarr = array();
	$commentarr['comment_ID'] = $commentid;
	$commentarr['comment_date'] = date('Y-m-d H:i:s', $newtime);
	wp_update_comment ( $commentarr );
  }

  public function order_comment() {

	global $wpdb;
	$time = strtotime(get_comment($_POST['commentid'], OBJECT)->comment_date); //2013-09-09 17:55:41
	if ($_POST['position'] == 'next')
		$newtime = $time + 1;

	if ($_POST['position'] == 'prev')
		$newtime = $time - 1;

	$this->addtime($_POST['commentatid'], $newtime);
	$check = true;

		/* if ($comment = $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_approved = 1 and comment_date = %s LIMIT 1,1 "), $date ))

	echo $comment[0]->comment_ID; */

	die();
  }

}

?>
