<?php
session_start();
$user=$_SESSION["user_id"];
$file=$_GET["fileid"];
//https://mars.iuk.hdm-stuttgart.de/~gurzki/dl/download2.php?filename=bild.jpg
$directory= "/home/df047/public_html/uploadfiles";
require_once "logindaten.php";

try {
    $db = new PDO ($dsn, $dbuser, $dbpass);
} catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$checksql = "SELECT * FROM files WHERE file_id='$file'";
$checkquery = $db->prepare($checksql);
$checkquery->execute();
while ($checkzeile=$checkquery->fetchobject()) {
    if ($checkzeile->owner != $user) {
        header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/logout.php");
        exit();
    }
}

$sql="SELECT * FROM files WHERE file_id='$file'";
$query=$db->prepare($sql);
$query->execute();
while ($zeile=$query->fetchObject()) {

    $favorite=$zeile->favorite;
}

if ($favorite==$user)
{
    echo "Die Datei wurde entfavorisiert";
    $sql = "UPDATE files SET favorite=0 WHERE file_id='$file'";
    $query=$db->prepare($sql);
    $query->execute();

}
else{
    echo "Fehler typ nicht gefunden";
}
header ("Location: https://mars.iuk.hdm-stuttgart.de/~df047/favorite.php");
exit();