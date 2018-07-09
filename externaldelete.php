<?php
$shareid=$_GET["shareid"];
require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$sql = "DELETE FROM sharing WHERE share_id=:shareid";
$query  = $db ->prepare($sql);
$query ->bindParam('shareid',$shareid);
$query ->execute();

header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php ");
    exit;