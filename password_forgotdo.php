<?php

// Hier wird ein Random String ersstellt

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


session_start();

{
    $e_mail=$_POST['e_mail'];


}

// Datenbankverbindung

require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}


try {

    $stmt = $db->prepare("SELECT * FROM users WHERE e_mail = :e_mail");  // Datenbankabfrage Verbereitung wird in $stmt gespeichert
    $stmt->bindParam(':e_mail', $e_mail);
    $stmt->execute(); // Abfrage wird ausführen
    $row = $stmt->fetch(PDO::FETCH_ASSOC); // Ergebnisabfrage wird in einem Array abgespeichert

}

catch(PDOException $e) {
    echo "Fehler: ". $e->getMessage();
}




// 1. Test: Befindet sich die E-Mail Adresse in der Datenbank?

if(count($row)==0) {
    echo "Ihre E-Mail Adresse ist nicht hinterlegt";
} else {
    $passwortcode=random_string();
    $stmt = $db->prepare("UPDATE users SET passwortcode=:passwortcode, passwortcode_time=NOW() WHERE id=:user_id");
    $result= $stmt->execute(array('passwortcode'=> sha1($passwortcode),'user_id'=>$row['id']));

    //E-Mail für Benutzer, der das Passwort vergessen hat
    $empfaenger=$row['e_mail'];
    $absender="From: Thunderstorm GmbH <info.thunderstorm@mail.de>";
    $betreff="Setzen Sie Ihr Passwort zurueck";
    $url_passwortcode="https://mars.iuk.hdm-stuttgart.de/~df047/formpassword_renew.php?userid=".$row['id']."&code=".$passwortcode;
    $text="Hallo ".$row['vorname']." ".$row['nachname'].",".
    "Es wurde eine Änderung des Kennworts Ihres Thunderstorm-Kontos angefordert. Wenn Sie das waren, können Sie Ihr Passwort hier neu festlegen:"
        .$url_passwortcode;
    mail($empfaenger,$betreff,$text,$absender);

    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/emailreceived.html");

}
