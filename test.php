<?php

require('session.php');
venus_session_start();

if ($_GET["user"] == "remoteconsole") {
	if (isset($_SESSION["remoteconsole-authenticated"])) {
		header("HTTP/1.1 200 OK");
		exit();
	} else {
		header("HTTP/1.1 401 Authentication required");
		exit();
	}
}

header("HTTP/1.1 400 Bad Request");

?>
