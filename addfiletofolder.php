<?php
//check ob owner von datei ist

$filetoadd=$_GET["filetoadd"];
$folderid=$_GET["folderid"];

require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$sql2 = "SELECT * FROM folders WHERE folder_id='$folderid'";
$query2  = $db ->prepare($sql2);
$query2 ->execute();
while ($zeile2 = $query2->fetchObject()) {
    $currentaccessrights=$zeile2->file_code;
}
if ($currentaccessrights == "") {
    $accessrights= $filetoadd;
}
else {
    $accessrights = "$currentaccessrights" . "." . "$filetoadd";
}

$stmt = $db->prepare("UPDATE folders SET file_code=:filecode WHERE folder_id=:id");
$stmt ->bindParam('filecode', $accessrights);
$stmt ->bindParam('id',$folderid);
$stmt ->execute();
header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/showfolder.php?folderid=$folderid");
exit();
?>