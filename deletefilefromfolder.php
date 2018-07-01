<?php
$filetodelete=$_POST["filetodelete"];
$folderid=$_POST["folderid"];
require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$sql = "SELECT * FROM folders WHERE folder_id=$folderid";
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
$stmt ->bindParam('id',$folderid);
$stmt ->execute();
header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/showfolder.php?folderid=$folderid");

exit();