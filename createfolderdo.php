<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/logout.php");
    exit();
}

$foldername=$_POST["foldername"];
$owner=$_SESSION["user_id"];
require_once "logindaten.php";
try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$stmt = $db ->prepare("INSERT INTO folders (folder_id, owner, folder_name, file_code, access_code) VALUES('',$owner,:foldername,'','')");
$stmt ->bindParam('foldername', $foldername);
$stmt ->execute();
?>