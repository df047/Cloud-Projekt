<?php
session_start();
if($_POST["username"]=='' OR $_POST["password"]== '' OR $_POST["email"]==''){
    header ("Location: https://mars.iuk.hdm-stuttgart.de/~df047/dataincomplete.html");
    die();
}
$username=$_POST["username"];
$password=$_POST["password"];
$hashedpassword=password_hash($password,PASSWORD_DEFAULT);
$email=$_POST["email"];
$vorname=$_POST["vorname"];
$nachname=$_POST["nachname"];
$passwordconfirm=$_POST["passwordconfirm"];

if ($password !== $passwordconfirm){
    header ("Location: https://mars.iuk.hdm-stuttgart.de/~df047/passwordwrong_register.html");
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
$stmt = $db ->prepare("INSERT INTO users (id, username, password, e_mail, vorname, nachname) VALUES('',:username,:hashedpassword,:email,:vorname,:nachname)");
$stmt ->bindParam('username', $username);
$stmt ->bindParam('hashedpassword',$hashedpassword);
$stmt ->bindParam('email', $email);
$stmt ->bindParam('vorname',$vorname);
$stmt ->bindParam('nachname',$nachname);
$stmt ->execute();

echo("Sie haben sich erfolgreich registriert! Sie werden in 3 Sekunden auf die Startseite weitergeleitet");
sleep(4);
header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/register_confirm.html");
exit();
?>