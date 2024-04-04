<?php

# FIXME: needs permission some how, preferably once?
if (!file_exists("/data/conf/vncpassword.txt")) {
	if (isset($_POST['password'])) {
			$options['cost'] = 8;
			$hash = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
			$fh = fopen("/data/conf/vncpassword.txt", "w");
			// if ! ..
			fwrite($fh, $hash);
			// if ...
			fclose($fh);
			// rename

			// prevent POST refresh
			header("HTTP/1.1 303 Password set");
			header("Location: /");
			exit();
	}
} else {
	header("HTTP/1.1 303 Password set");
	header("Location: login.php");
	exit();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Choose a password</title>
	</head>
	<body>
		<div class="login">
			<h1>Please choose a password to protect your device</h1>
			<form method="post">
				<input type="text" name="username" placeholder="Username" id="username" style="display:none;">
				<input type="password" name="password" placeholder="Password" id="password" autocomplete="new-password" required>
				<input type="submit" value="Set Password">
			</form>
		</div>
	</body>
</html>

