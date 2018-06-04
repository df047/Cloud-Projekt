<?php
session_start();
{
    $namearray= explode (".", $_FILES["uploadfile"]["name"], 2);
    //$fileName=$_FILES["uploadfile"]["name"];
    //$fileType=$_FILES["uploadfile"]["type"];
    $fileSize=$_FILES["uploadfile"]["size"];
    $filePath= "mars.iuk.hdm-stuttgart.de/home/df047/public_html/uploadfiles"."$fileName";
    $accessRights=4;
    $owner=$_SESSION['user_id'];

}

if($_FILES["uploadfile"]["name"]=="")
{
    echo "Fehler Dateiname.";
    sleep(4);
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php");
    exit();
    die(); }

if (isset($namearray[2])){
    echo ("Ungültiger Dateiname, bitte keine Punkte im Dateiname.");
    sleep(4);
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php");
    exit();
    die();
}

$fileName=$_FILES["uploadfile"]["name"];
echo "FILENAME:".$namearray[0]."FILETYPE:".$namearray[1]."<br>";
if ($_FILES["uploadfile"]["size"] > 8000000) {
    echo"Datei zu groß.";
    sleep(4);
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php");
    exit();
    die();
}

if ($namearray[1] == "jpg" OR $namearray[1]=="png" OR $namearray[1]=="JPG"OR $namearray[1]== "jpeg" OR $namearray[1] == "gif" OR $namearray[1]=="pdf" OR $namearray[1]== "gif") {
    echo "Dateiart ok<br>";
} else {
    echo"Dateiart nicht zugelassen.";
    sleep(4);
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php");
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
$stmt = $db ->prepare("INSERT INTO files (file_id, filename, filetype, filesize, owner, upload_date, access_rights, filepath) VALUES('',:filename,:filetype,:filesize,$owner,CURRENT_TIMESTAMP (),:access_rights,:filepath)");
$stmt ->bindParam('filename', $namearray[0]);
$stmt ->bindParam('filetype',$namearray[1]);
$stmt ->bindParam('filesize', $fileSize);
$stmt ->bindParam('access_rights',$accessRights);
$stmt ->bindParam('filepath',$filePath);
$stmt ->execute();

echo "Dateiname: ".$_FILES["uploadfile"]["name"]."<br>";
if (!move_uploaded_file($_FILES["uploadfile"]["tmp_name"], "/home/df047/public_html/uploadfiles/".$_FILES["uploadfile"]["name"])) { echo "Datei nicht hochgeladen";
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php");
    exit();
    die();
}


/**
 * Created by PhpStorm.
 * User: tjard
 * Date: 16.05.18
 * Time: 17:14
 */