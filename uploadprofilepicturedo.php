<?php
session_start();
{
    $fileName=$_FILES["uploadfile"]["name"];
    $fileType=$_FILES["uploadfile"]["type"];
    $fileSize=$_FILES["uploadfile"]["size"];
    $filePath= "mars.iuk.hdm-stuttgart.de/home/df047/public_html/profilepictures"."$fileName";

}
require_once "logindaten.php";
try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$stmt = $db ->prepare("INSERT INTO users (profilepicture) VALUES(:profilepicture)");
$stmt ->bindParam('profilepicture', $fileName);
$stmt ->execute();

echo "Dateiname: ".$_FILES["uploadfile"]["name"]."<br>";
if($_FILES["uploadfile"]["name"]=="")
{
    echo "Fehler Dateiname.";
    die(); }
$fileName=$_FILES["uploadfile"]["name"];
$fileType=substr($fileName,strlen($fileName)-3,strlen($fileName) ); $fileName=substr($fileName,0,strlen($fileName)-4 );
echo "FILENAME:".$fileName."FILETYPE:".$fileType."<br>";
if ($_FILES["uploadfile"]["size"] > 800000) {
    echo"Datei zu groß.";
    die();
}

if ($fileType == "jpg" OR $fileType=="png" OR $fileType== "jpeg" OR $fileType == "gif" OR $fileType=="pdf" OR $fileType== "gif") {
    echo "Dateiart ok<br>";
} else {
    echo"Dateiart nicht zugelassen.";
    die();
}
if (!move_uploaded_file($_FILES["uploadfile"]["tmp_name"], "/home/df047/public_html/profilepictures/".$_FILES["uploadfile"]["name"])) { echo "Datei nicht hochgeladen";
    die();
}