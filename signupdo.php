<?php
session_start();
if($_POST["username"]=='' OR $_POST["password"]== '' OR $_POST["email"]=''){
    echo ("Geben Sie bitte alle Daten ein!");
    die();
}
$username=$_POST["username"];
$password=$_POST["password"];
$email=$_POST["email"];
$vorname=$_POST["vorname"];
$nachname=$_POST["nachname"];
$passwordconfirm=$_POST["passwordconfirm"];

if ($password !== $passwordconfirm){
    echo ("Wiederholen Sie das Passwort korrekt!");
    die;
    }
require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$stmt = $db ->prepare("INSERT INTO users (id, username, password, e_mail, vorname, nachname) VALUES('',:username,:password,:email,:vorname,:nachname)");
$stmt ->bindParam('username', $username);
$stmt ->bindParam('password',$password);
$stmt ->bindParam('email', $email);
$stmt ->bindParam('vorname',$vorname);
$stmt ->bindParam('nachname',$nachname);
$stmt ->execute();

echo("Sie haben sich erfolgreich registriert! Sie werden in 3 Sekunden auf die Startseite weitergeleitet");
sleep(4);
header("Location: https://mars.iuk.hdm-stuttgart.de/~lb100/Cloudprojekt/startseite.html");
exit();
?>