<?php
session_start();
$_SESSION['user_id']=null;
header("Location: https://mars.iuk.hdm-stuttgart.de/~lb100/Cloudprojekt/startseite.html");
exit();
?>