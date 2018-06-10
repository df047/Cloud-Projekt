<?php

// Random String ersstellen

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


require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}




try {

    $stmt = $con->prepare("SELECT * FROM users WHERE e_mail = :e_mail"); // Datenbankabfrage vorbereiten und in $stmt abspeichern
    $stmt->bindParam(':e_mail', $e_mail);
    $stmt->execute(); // Abfrage ausführen
    $row = $stmt->fetch(PDO::FETCH_ASSOC); // Ergebnis der Abfrage in Array speichern
}

catch(PDOException $e) {             // Standard
    echo "Fehler: ". $e->getMessage();
}

// Check Nr.1: Ist E-Mail-Adresse in der Datenbank hinterlegt?

//echo $row['e_mail'];
//echo $row['user_id'];

if(count($row)==0) {
    echo "Die E-Mail Adresse ist nicht hinterlegt";
} else {
    $passwortcode=random_string();
    $stmt = $con->prepare("UPDATE users SET passwortcode=:passwortcode, passwortcode_time=NOW() WHERE id=:user_id");
    $result= $stmt->execute(array('passwortcode'=> sha1($passwortcode),'user_id'=>$row['id']));

    //E-Mail für Empfänger, der das Passwort vergessen hat wird vorbereitet
    $empfaenger=$row['e_mail'];
    $absender="From: Thunderstorm GmbH <info.thunderstorm@mail.de>";
    $betreff="Setzen Sie Ihr Passwort zurück";
    $url_passwortcode="https://mars.iuk.hdm-stuttgart.de/~df047/formpassword_renew.php?userid=".$row['id']."&code=".$passwortcode;
    $text="Hallo".$row['vorname'];.$row['nachname'] "
    Es wurde eine Änderung des Konnworts Ihres Thunderstorm-Kontos angefordert. Wenn Sie das waren, können Sie Ihr Passwort hier in der nächsten Stunde neu festlegen:"
        .$url_passwortcode;
    mail($empfaenger,$betreff,$text,$absender);
    echo "Ein Link wurde soeben an die von Ihnen angegebene E-Mail-Adresse versendet";
    echo "<br>";
    echo "Zum Testen: <a href='$url_passwortcode'>Zurücksetzen</a>";


}







