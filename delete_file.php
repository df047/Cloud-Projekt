<?php
//https://mars.iuk.hdm-stuttgart.de/~gurzki/dl/download2.php?filename=bild.jpg
$directory= "/home/df047/public_html/uploadfiles";
require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$file= $_GET["fileid"];
$sql = "DELETE FROM files WHERE file_id=:file";
$query  = $db ->prepare($sql);
$query ->bindParam('file',$file);
$query ->execute();


if (!isset($_GET["filename"]))
{
    echo " keine Datei angegeben";
    die();
}
else
{
    unlink($directory."/".$_GET["filename"]);
    echo "Die Datei wurde gelöscht";
}

header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php");
