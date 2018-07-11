<?php

//Datenbankverbindung

require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}

$passwort = $_POST['password'];
$passwort_wiederholen = $_POST['password_2'];
$hash = password_hash($passwort, PASSWORD_DEFAULT);
$user_id = $_POST['id'];

if ($passwort === NULL || $passwort == $passwort_wiederholen) {
    $stmt = $db->prepare("UPDATE users SET password=:passwort WHERE id='$user_id'");
    $stmt ->bindParam('passwort', $hash);
    $stmt->execute();
    //$result= $stmt->execute(array('passwort'=> $hash,'user_id'=>$user_id));
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/passwordreset_confirm.html");
}
