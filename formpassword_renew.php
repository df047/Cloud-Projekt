<?php
require_once "logindaten.php";


// Datenbankverbindung

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}

// Hier wird zunächst überprüft, ob die user_id und passwortcode übergeben wurde
$user_id=$_GET['userid'];
$passwortcode=$_GET['code'];

//Hier wird überprüft, ob der Link zum zurücksetzten des Passworts Inhalt in user_id und in passwortcode hat

if($user_id === NULL || $passwortcode=== NULL){
    echo "Nutzer hat kein Passwortcode angefordert";
    die();
}

// die beendet die Skriptausführung


// Abfrage des Nutzers
try {

    $stmt = $db->prepare("SELECT * FROM users WHERE id = :user_id"); // Datenbankabfrage Verbereitung wird in $stmt gespeichert
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute(); // Abfrage wird ausführen
    $row = $stmt->fetch(PDO::FETCH_ASSOC); // Ergebnisabfrage wird in einem Array abgespeichert
}

catch(PDOException $e) {
    echo "Error: ". $e->getMessage();
}


if(sha1($passwortcode)===$row['passwortcode']){
    // Überprüfung, ob der Passwortcode die Gültigkeitsdauer von 1h überschreitet?
    $passwortcode_time = strtotime($row['passwortcode_time']);
    if($passwortcode_time < (time()-1*3600)){
        echo "Ihr Rücksetzungslink wurde vor mehr als 1h angefordert, bitte fordern Sie einen neuen an!";
        die();
    } else {
        echo "
            <form method='post' action='password_renew.php'>
                <input type='hidden' value='". $row['user_id'] ."' name='id'>
                <p>Neues Passwort eingeben:</p>
                <input type='password' name='password'> <br> <br>
                <p>Passwort wiederholen:</p>
                <input type='password' name='password_2'> <br> <br>
                <input type='submit' value='Zurücksetzen'>
             </form>   
        ";
    }

}
