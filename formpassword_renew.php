<?php
require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}

// Überprüfung, ob user_id und passwortcode übergeben wurde
$user_id=$_GET['userid'];
$passwortcode=$_GET['code'];

//Überprüfung, ob Link zum Passwort zurücksetzten einen Inhalt in user_id und in passwortcode haben - die() beendet die Skriptausführung

if($user_id === NULL || $passwortcode=== NULL){
    echo "Nutzer hat kein Passwortcode angefordert";
    die();
}

// Nur Abfrage des Nutzers?
try {

    $stmt = $con->prepare("SELECT * FROM users WHERE id = :user_id"); // Datenbankabfrage vorbereiten und in $stmt abspeichern
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute(); // Abfrage ausführen
    $row = $stmt->fetch(PDO::FETCH_ASSOC); // Ergebnis der Abfrage in Array speichern
}

catch(PDOException $e) {             // Standard
    echo "Error: ". $e->getMessage();
}


if(sha1($passwortcode)===$row['passwortcode']){
    // Überprüfung, ob Passwortcode die Gültigkeit von 24h überschreitet
    $passwortcode_time = strtotime($row['passwortcode_time']);
    if($passwortcode_time < (time()-1*3600)){
        echo "Ihr Rücksetzungslink wurde vor mehr als 1h angefordert, bitte fordern Sie einen neuen an!";
        die();
    } else {
        echo "
            <form method='post' action='password_renew.php'>
                <input type='hidden' value='". $row['id'] ."' name='id'>
                <p>Neues Passwort eingeben:</p>
                <input type='password' name='password'> <br> <br>
                <p>Passwort wiederholen:</p>
                <input type='password' name='password_2'> <br> <br>
                <input type='submit' value='Zurücksetzen'>
             </form>   
        ";
    }

}
