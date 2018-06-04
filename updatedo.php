<?php
$nachname= $_POST["nachname"];
$vorname= $_POST["vorname"];
$email= $_POST["email"];
$id=$_POST["id"];

require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p)
{
    echo ("Fehler bei Aufbau der Datenbankverbindung.");
}
$stmt = $db->prepare("UPDATE users SET vorname=:vorname, nachname=:nachname, e_mail=:e_mail WHERE id=:id");
$stmt ->bindParam('nachname', $nachname);
$stmt ->bindParam('vorname',$vorname);
$stmt ->bindParam('e_mail',$email);
$stmt ->bindParam('id',$id);
$stmt ->execute();
header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/showprofile.php");
exit();
?>