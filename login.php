<?php

$page = isset($_GET["page"]) ? $_GET["page"] : "/";

// TODO: add error checking, handle non existent file?
$hash = trim(@file_get_contents("/data/conf/vncpassword.txt"));

if ($hash == "") {
	header("HTTP/1.1 303 Logged in");
	header("Location: " . $page);
	exit();
}

require('session.php');
venus_session_start();

$wrong_passwd = false;

if (isset($_POST['password'])) {

	if ($hash == "" || password_verify($_POST['password'], $hash)) {
		$_SESSION["remoteconsole-authenticated"] = true;

		header("HTTP/1.1 303 Logged in");
		header("Location: " . $page);
		exit();
	} else {
		session_destroy();
		$wrong_passwd = true;
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
	</head>
	<body>
	    <? if ($wrong_passwd) print("Incorrect password"); ?>
		<div class="login">
			<h1>Login</h1>
			<form method="post">
				<input type="text" value="remoteconsole" name="username" id="username" autocomplete="username" style="display:none;">
				<input type="password" name="password" id="password" autocomplete="new-password" required>
				<input type="submit" value="Login">
			</form>
		</div>
	</body>
</html>

