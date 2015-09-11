<?php 
// setcookie("cookieId", '' , time()+(60*60*24*365));
// setcookie("cookieSec", '', time()+(60*60*24*365));

session_start();

$_SESSION = array(); 
session_regenerate_id(TRUE);
session_unset();
session_destroy();
header("Location:/secret_santa/index.php");

?>
