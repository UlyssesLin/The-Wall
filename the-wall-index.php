<?php
session_start();
if(isset($_SESSION['current_user_first_name'])){
	$current_user=$_SESSION['current_user_first_name'];
}else{
	$current_user="Ulysses";
	$_SESSION['current_user_first_name']=$current_user;
}
if(!isset($_SESSION['old_posts'])){
	$_SESSION['old_posts']="NO OLD POSTS SHOWING YET";
}
if(isset($_SESSION['warning'])){
	$warning=$_SESSION['warning'];
}else{
	$warning="";
}
if(isset($_SESSION['new-post'])){
	$new_post=$_SESSION['new-post'];
}else{
	$new_post="NO NEW MESSAGE";
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>The Wall</title>
    <link rel="stylesheet" type="text/css" href="the-wall.css">
</head>
<body>
	<div id="left" class="nestled">
		<?= $_SESSION['old_posts'] ?>
	</div>
	<div id="right" class="nestled">
		<div id="right-top">
			<h1>Coding</h1>
			<h1>Dojo</h1>
			<h1>Wall</h1>
			<h6>Welcome <?= $current_user ?></h6>
		</div>
		<div id="right-bottom">
			<h4>Post a message below: <?= $warning ?></h4>
			<form id="new-post" action="the-wall-process.php" method="post">
				<textarea name="new-post" placeholder="Write here!..."></textarea>
				<input class="normal" type="hidden" name="action" value="new-post"><br>
				<input id="post-new-message-button" class="normal" type="submit" value="Post a message">
			</form>
			<form id="reset" action="the-wall-process.php" method="post">
				<input class="normal" type="hidden" name="action" value="reset">
				<input id="reset-button" class="normal" type="submit" value="Reset">
			</form>
		</div>
	</div>
</body>
</html>