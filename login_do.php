<?php
session_start();
if(!isset($_POST["username"]) OR !isset($_POST["password"])){
    echo ("Geben Sie bitte alle Daten ein!");
    die();
}
$username=$_POST["username"];
$password=$_POST["password"];

require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}

$sql = "SELECT * FROM users WHERE username = '$username'";
$query  = $db ->prepare($sql);
$query ->execute();
while ($zeile = $query->fetchObject()) {
    $abc = $zeile->password;
    $def = $zeile->id;
}

    $check=password_verify($password,$abc);
    if ($check == true) {
        $_SESSION['user_id'] = $def;

        header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php");

    exit();}
  else{
    echo("Benutzername oder Passwort ungültig<br>");
    die();
}
?>