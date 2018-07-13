<?php
$folderid= $_POST["folderid"];
require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$file= $_GET["fileid"];
$sql = "DELETE FROM folders WHERE folder_id=:folderid";
$query  = $db ->prepare($sql);
$query ->bindParam('folderid',$folderid);
$query ->execute();




header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php");