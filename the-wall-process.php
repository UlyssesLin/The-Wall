<?php
session_start();
if(isset($_POST['action']) && $_POST['action']=='new-post'){
	var_dump($_SESSION);
	$current_user=$_SESSION['current_user_first_name'];
	$post_id=1;
	include_once('new-connection.php');
	$old_post_query='SELECT users.first_name,users.last_name,messages.message,messages.created_at FROM messages LEFT JOIN users ON users.id=messages.user_id ORDER BY messages.created_at DESC;';
	$old_posts=fetch_all($old_post_query);
	//Handles user icon creation
	if(!isset($_SESSION['icons_made'])){
		$icon_query='SELECT users.first_name FROM users;';
		$icon_results=fetch_all($icon_query);
		$icons=array();
		foreach($icon_results as $icon_result){
			array_push($icons,$icon_result['first_name'][0]);
		}
		include_once('the-wall-icons.php');
		$_SESSION['icons_made']=true;
	}
	//Populates the messages area with posts and their comments
	$_SESSION['old_posts']="<h2>OLD POSTS</h2>";
	foreach($old_posts as $old_post){
		
		
		$_SESSION['old_posts'].='<div class="user-post-container"><div class="user-box" class="nestled"><h2>' . $old_post['first_name'] . " " . $old_post['last_name'] . '</h2><h5>[' . $old_post['created_at'] . ']</h5></div><img src="icon_' . $old_post['first_name'][0] . '.png" alt="user initial icon">' . '<div class="post-box" class="nestled"><p class="old-post">' . $old_post['message'] . '</p></div></div>';
	}

	if(empty($_POST['new-post'])){
		$_SESSION['warning']="<span id='warning'>[Please enter a message!]</span>";
	}else{
		unset($_SESSION['warning']);
		date_default_timezone_set('America/Vancouver');
		$_SESSION['new-post']="<p>Ulysses Lin - " . date("g:i a") . "</p><p class='indented'>" . $_POST['new-post'];
	}
	header('location: the-wall-index.php');
	die();
}

if(isset($_POST['action']) && $_POST['action']=='reset'){
	session_destroy();
	header('location: the-wall-index.php');
	die();
}
?>