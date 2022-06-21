<?php
	session_start();
	$_SESSION['auth'] = null;
	header("Location: http://192.168.0.115/index.php");
?>