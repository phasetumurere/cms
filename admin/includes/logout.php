<?php session_start(); ?>
<?php

$_SESSION['username']=null;
$_SESSION['userFirstName']=null;
$_SESSION['userLastName']=null;
$_SESSION['userRole']=null;

header("Location: ../../index.php");

?>