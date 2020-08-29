<?php
session_start();

$_SESSION = [];
session_destroy();
session_unset();

setcookie('key', '', time() - 3600 );
setcookie('id', '', time() - 3600 );

header("Location: login.php");
exit;
?>