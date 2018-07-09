<?php

function random_string() {
    if(function_exists('random_bytes')) {
        $bytes = random_bytes(16);
        $str = bin2hex($bytes);
    } else if(function_exists('openssl_random_pseudo_bytes')) {
        $bytes = openssl_random_pseudo_bytes(16);
        $str = bin2hex($bytes);
    } else if(function_exists('mcrypt_create_iv')) {
        $bytes = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
        $str = bin2hex($bytes);
    } else {
        $str = md5(uniqid('e_mail_string', true));
    }
    return $str;
}

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
    $existing = "$zeile->e_mail";
    $newuser = $zeile->id;
}
    if ($existing != "") {

        require_once "logindaten.php";

        try {
            $db = new PDO ($dsn, $dbuser, $dbpass);
        } catch (PDOException $p) {
            echo("Fehler bei Aufbau der Datenbankverbindung.");
        }
        $sql2 = "SELECT * FROM files WHERE file_id='$file'";
        $query2 = $db->prepare($sql2);
        $query2->execute();
        while ($zeile2 = $query2->fetchObject()) {
            $currentaccessrights = $zeile2->access_rights;
        }
        if ($currentaccessrights != "") {
            $accessrights = "$currentaccessrights" . "." . "$newuser";
        }
        else{
            $accessrights=$newuser;
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
        $stmt ->bindParam('accessrights', $accessrights);
        $stmt ->bindParam('id',$file);
        $stmt ->execute();
        header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php");
        exit();
    }
    else{
        $randomcode=random_string();
        require_once "logindaten.php";

        try
        {
            $db= new PDO ($dsn,$dbuser,$dbpass);
        }
        catch (PDOException $p) {
            echo("Fehler bei Aufbau der Datenbankverbindung.");
        }
        $stmt2 = $db ->prepare("INSERT INTO sharing (share_id, random_string, file, non_user) VALUES('',:randomstring,:file,:useremail)");
        $stmt2 ->bindParam('randomstring', $randomcode);
        $stmt2 ->bindParam('file',$file);
        $stmt2 ->bindParam('useremail', $user_email);
        $stmt2 ->execute();

        $absender="From: Thunderstorm GmbH <info.thunderstorm@mail.de>";
        $betreff="Eine Thunderstorm-Datei wurde Ihnen freigegeben";
        $url_downloadcode="https://mars.iuk.hdm-stuttgart.de/~df047/externaldownload.php?code=".$randomcode;
        $text="Hallo,".
            "Ihnen wurde eine Datei auf Thunderstorm freigegeben. Klicken Sie auf den Link um sie herunterzuladen:"
            .$url_downloadcode;
        mail($user_email,$betreff,$text,$absender);
        //E-Mail versand an nicht registrierten Nutzer
        header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php");
        exit();
    }

?>
