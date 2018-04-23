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
$stm= $db->prepare("SELECT * FROM users WHERE username = :username and password = :password");
$ergebnis= $stm->execute(array('username'=> $username, 'password'=> $password));
$user = $stm->fetch();

if ($user!==false){
    $_SESSION['user_id'] = $username;
    header("Location: https://mars.iuk.hdm-stuttgart.de/~lb100/Cloudprojekt/dashboard.php");
    exit();
} else{
    echo("Benutzername oder Passwort ungültig<br>");
    die();
}