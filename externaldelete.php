<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/logout.php");
    exit();
}
$currentuser=$_SESSION["user_id"];
$shareid=$_GET["shareid"];

require_once "logindaten.php";

try {
    $db = new PDO ($dsn, $dbuser, $dbpass);
} catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$checksql = "SELECT * FROM sharing WHERE share_id='$shareid'";
$checkquery = $db->prepare($checksql);
$checkquery->execute();
while ($checkzeile=$checkquery->fetchobject()) {
    $filecheck=$checkzeile->file;

    $checksql2 = "SELECT * FROM files WHERE file_id='$filecheck'";
    $checkquery2 = $db->prepare($checksql2);
    $checkquery2->execute();
    while ($checkzeile2=$checkquery2->fetchobject()) {
        if ($checkzeile2->owner != $currentuser){
            header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/logout.php");
            exit();
        }

    }
    
}

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