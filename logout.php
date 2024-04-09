<?php

require('session.php');
venus_session_start(true);
session_destroy();
header('Location: /');
?>

