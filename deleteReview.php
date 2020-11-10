<?php 
session_start();
require('dbconnect.php');

if(isset($_SESSION['id'])){
	$id = $_REQUEST['id'];

	//投稿の確認
	$messages = $db->prepare('SELECT * FROM reviews WHERE id=?');
	$messages->execute(array($id));
	$message = $messages->fetch();

	if($message['member_id'] == $_SESSION['id']){
		//削除
		$del = $db->prepare('DELETE FROM reviews WHERE id=?');
		$del->execute(array($id));
	}
}

header('Location:	index.php');
exit();

?>