<?php
session_start();
if(!isset($_POST["Benutzername"]) OR !isset($_POST["Passwort"])){
    echo ("Geben Sie bitte alle Daten ein!");
    die();
}
$Benutzername=$_POST["Benutzername"];
$Passwort=$_POST["Passwort"];

require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$stm= $db->prepare("SELECT * FROM users WHERE username = :Benutzername and password = :Passwort");
$ergebnis= $stm->execute(array('Benutzername'=> $Benutzername, 'Passwort'=> $Passwort));
$user = $stm->fetch();

if ($user!==false){
    $_SESSION['user_id'] = "loggedin";
    header("Location: https://mars.iuk.hdm-stuttgart.de/~lb100/Cloudprojekt/dashboard.php");
    exit();
} else{
    echo("Benutzername oder Passwort ungültig<br>");
    die();
}