<?php
session_start();
{
    $namearray= explode (".", $_FILES["uploadfile"]["name"], 2);
    $fileName=$namearray[0].".".$namearray[1];
    //$fileType=$_FILES["uploadfile"]["type"];
    $fileSize=$_FILES["uploadfile"]["size"];
    //$filePath= "mars.iuk.hdm-stuttgart.de/home/df047/public_html/profilepictures"."$fileName";
    $identificator=$_SESSION['user_id'];

}
//Löschen des alten Profilbildes
$directory= "/home/df047/public_html/profilepictures";
require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$sql = "SELECT * FROM users WHERE id='$identificator'";
$query  = $db ->prepare($sql);
$query ->execute();

while ($zeile = $query->fetchObject()) {
    $currentpicture= $zeile->profilepicture;}


unlink($directory."/".$currentpicture);

//Upload des neuen Profilbildes
if($_FILES["uploadfile"]["name"]=="")
{
    echo "Fehler Dateiname.";
    sleep(4);
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/editprofile.php");
    exit();
    die();
}

if (isset($namearray[2])){
    echo ("Ungültiger Dateiname, bitte keine Punkte im Dateiname.");
    sleep(4);
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/editprofile.php");
    exit();
    die();
}

$fileName=$_FILES["uploadfile"]["name"];
echo "FILENAME:".$namearray[0]."FILETYPE:".$namearray[1]."<br>";
if ($_FILES["uploadfile"]["size"] > 8000000) {
    echo"Datei zu groß.";
    sleep(4);
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/editprofile.php");
    exit();
    die();
}

if ($namearray[1] == "jpg" OR $namearray[1]=="png" OR $namearray[1]=="JPG"OR $namearray[1]== "jpeg" OR $namearray[1] == "gif" OR $namearray[1]=="pdf" OR $namearray[1]== "gif") {
    echo "Dateiart ok<br>Sie werden in 3 Sekunden auf Ihre Profilseite weitergeleitet";
} else {
    echo"Dateiart nicht zugelassen.";
    sleep(4);
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/editprofile.php");
    exit();
    die();
}
require_once "logindaten.php";
try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}

//Zuordnung für die Datenbank
$stmt = $db ->prepare("UPDATE users SET profilepicture=:profilepicture WHERE id=$identificator");
$stmt ->bindParam('profilepicture', $fileName);
$stmt ->execute();

if (!move_uploaded_file($_FILES["uploadfile"]["tmp_name"], "/home/df047/public_html/profilepictures/".$_FILES["uploadfile"]["name"])) { echo "Datei nicht hochgeladen";

}
sleep(3);
header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/showprofile.php");
exit();
