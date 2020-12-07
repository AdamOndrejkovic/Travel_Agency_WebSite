<?php  //pagina om uit te loggen
session_start();
$_SESSION=array();
header('location:index.php');
?>