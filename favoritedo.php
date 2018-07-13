<?php
session_start();
$file=$_GET["fileid"];
$user=$_SESSION["user_id"];

//check ob benutzer auch owner dieser file id ist.
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

    require_once "logindaten.php";

    try
    {
        $db= new PDO ($dsn,$dbuser,$dbpass);
    }
    catch (PDOException $p)
    {
        echo ("Fehler bei Aufbau der Datenbankverbindung.");
    }
    $stmt = $db->prepare("UPDATE files SET favorite=:favorite WHERE file_id=:id");
    $stmt ->bindParam('favorite', $user);
    $stmt ->bindParam('id',$file);
    $stmt ->execute();
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php");
    exit();


    //alt
//
// else if($favorite==1)
//{
//    echo "Die Datei wurde entfavorisiert";
//    $sql = "UPDATE files SET favorite=0 WHERE file_id='$file'";
//    $query=$db->prepare($sql);
//    $query->execute();
//
//}




