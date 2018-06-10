<?php
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
    $stmt = $con->prepare("UPDATE users SET passwort=:passwort WHERE id=:user_id");
    $result= $stmt->execute(array('passwort'=> $hash,'user_id'=>$user_id));
    echo"Das Passwort wurde erfolgreich zurückgesetzt <a href='logindo.php'>Zurück zu Anmeldung</a>";
}