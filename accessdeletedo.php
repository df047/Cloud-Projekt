<?php
$usertodelete=$_POST["usertodelete"];
$fileid=$_POST["fileid"];
require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$sql = "SELECT * FROM files WHERE file_id=$fileid";
$query  = $db ->prepare($sql);
$query ->execute();
while ($zeile = $query->fetchObject()) {
    $currentcode=$zeile->access_rights;
}
$currentarray=explode(".",$currentcode);
unset($currentarray[$usertodelete]);
foreach ($currentarray as $value){
    if (isset($newarray)) {
        $newarray = "$newarray.$value";
    }
    else{
        $newarray = "$value";
    }
}
require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p)
{
    echo ("Fehler bei Aufbau der Datenbankverbindung.");
}
$stmt = $db->prepare("UPDATE files SET access_rights=:accessrights WHERE file_id=:id");
$stmt ->bindParam('accessrights', $newarray);
$stmt ->bindParam('id',$fileid);
$stmt ->execute();
header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php");

exit();