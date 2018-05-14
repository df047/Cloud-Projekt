<?php

$searchphrase=$_GET["search"];

require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$sql = "SELECT * FROM files WHERE filename LIKE '%$searchphrase%'";
$query  = $db ->prepare($sql);
$query ->execute();
while ($zeile = $query->fetchObject()) {
    echo ($zeile->filename);
    echo ($zeile->filetype);
    echo ("<br>");
}