<?php
$user_email=$_POST["user_email"];
$file=$_POST["file"];
require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$sql = "SELECT * FROM users WHERE e_mail='$user_email'";
$query  = $db ->prepare($sql);
$query ->execute();
while ($zeile = $query->fetchObject()) {
    $existing="$zeile->e_mail";
    if ($existing != ""){

        require_once "logindaten.php";

        try
        {
            $db= new PDO ($dsn,$dbuser,$dbpass);
        }
        catch (PDOException $p) {
            echo("Fehler bei Aufbau der Datenbankverbindung.");
        }
        $sql2 = "SELECT * FROM files WHERE file_id='$file'";
        $query2  = $db ->prepare($sql2);
        $query2 ->execute();
        while ($zeile2 = $query2->fetchObject()) {
            $currentaccessrights=$zeile2->access_rights;
        }
        $accessrights="$currentaccessrights"."."."$zeile->id";
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
        $stmt ->bindParam('accessrights', $accessrights);
        $stmt ->bindParam('id',$file);
        $stmt ->execute();
        echo ($currentaccessrights."|");
        echo($accessrights."|");
        echo($file."|");
        echo $existing;
    }
    else{
        echo("User nicht vorhanden");
        die;
    }
}
?>
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 13.06.2018
 * Time: 17:06
 */