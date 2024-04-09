<?php

require('session.php');
venus_session_start();
session_destroy();
header('Location: /');
?>

