<?php
session_start();

$_SESSION = array();

session_destroy();

header("Location: ../../structure/login.php");
exit();
?>
