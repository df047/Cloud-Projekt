<?php
session_start();
if(!isset($_POST["username"]) OR !isset($_POST["password"])){
    echo ("Geben Sie bitte alle Daten ein!");
    die();
}
$username=$_POST["username"];
$password=$_POST["password"];
$hashedpassword=password_hash($password,PASSWORD_DEFAULT);
echo ($hashedpassword);


require_once "logindaten.php";

 try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$stm= $db->prepare("SELECT * FROM users WHERE username = :username and password = :hashedpassword");
$ergebnis= $stm->execute(array('username'=> $username, 'hashedpassword'=> $hashedpassword));
$user = $stm->fetch();

if ($user!==false){
    $stm->execute();
    while ($zeile = $stm->fetchObject()) {
        $_SESSION['user_id'] = $zeile->id;
    }
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php");
    exit();
} else{
    echo("Benutzername oder Passwort ungültig<br>");
    die();
}
?>