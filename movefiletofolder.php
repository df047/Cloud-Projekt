<?php
$fileid=$_GET["fileid"];
$filetodelete=$_GET["filetodelete"];
$currentfolder=$_GET["currentfolder"];
$newfolder=$_GET["newfolder"];

require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$sql = "SELECT * FROM folders WHERE folder_id=$currentfolder";
$query  = $db ->prepare($sql);
$query ->execute();
while ($zeile = $query->fetchObject()) {
    $currentcode=$zeile->file_code;
}
$currentarray=explode(".",$currentcode);
unset($currentarray[$filetodelete]);
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
$stmt = $db->prepare("UPDATE folders SET file_code=:filecode WHERE folder_id=:id");
$stmt ->bindParam('filecode', $newarray);
$stmt ->bindParam('id',$currentfolder);
$stmt ->execute();






require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$sql2 = "SELECT * FROM folders WHERE folder_id='$newfolder'";
$query2  = $db ->prepare($sql2);
$query2 ->execute();
while ($zeile2 = $query2->fetchObject()) {
    $currentfilecode=$zeile2->file_code;
}
if ($currentfilecode == "") {
    $filecode= $fileid;
}
else {
    $filecode = "$currentfilecode" . "." . "$fileid";
}

$stmt = $db->prepare("UPDATE folders SET file_code=:filecode WHERE folder_id=:id");
$stmt ->bindParam('filecode', $filecode);
$stmt ->bindParam('id',$newfolder);
$stmt ->execute();
header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/showfolder.php?folderid=$newfolder");
exit();
?>