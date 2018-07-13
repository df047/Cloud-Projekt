<?php
session_start();
{
    $namearray= explode (".", $_FILES["uploadfile"]["name"]);
    //$fileName=$_FILES["uploadfile"]["name"];
    $mimetype=$_FILES["uploadfile"]["type"];
    $fileSize=$_FILES["uploadfile"]["size"];
    $filePath= "mars.iuk.hdm-stuttgart.de/home/df047/public_html/uploadfiles"."$fileName";
    $owner=$_SESSION['user_id'];
    $favorite = "0";

}

if (isset($namearray[2])){
    echo ("Ungültiger Dateiname, bitte keine Punkte im Dateiname.");
    //sleep(2);
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/datanamewrong_dot.php");
    exit();
    die();
}

if($_FILES["uploadfile"]["name"]=="")
{
    echo "Fehler Dateiname.";
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/datanamewrong.php");
    exit();
    die(); }


$fileName=$_FILES["uploadfile"]["name"];
echo "FILENAME:".$namearray[0]."FILETYPE:".$namearray[1]."<br>";
if ($_FILES["uploadfile"]["size"] > 25000000) {
    echo"Datei zu groß.";
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/datatoobig.php");
    exit();
    die();
}

if ($namearray[1] == "jpg" OR $namearray[1]=="png" OR $namearray[1]=="PNG" OR $namearray[1]=="JPG"OR $namearray[1]== "jpeg" OR $namearray[1] == "gif" OR $namearray[1]=="pdf" OR $namearray[1]== "gif" OR $namearray[1]== "pdf" OR $namearray[1]== "PDF" OR $namearray[1]== "docx" OR $namearray[1]== "DOCX" OR $namearray[1]== "doc" OR $namearray[1]== "DOC" OR $namearray[1]== "php" OR $namearray[1]== "PHP" OR $namearray[1]== "html" OR $namearray[1]== "HTML" OR $namearray[1]== "css" OR $namearray[1]== "CSS" OR $namearray[1]== "xlsx" OR $namearray[1]== "XLSX" OR $namearray[1]== "xls" OR $namearray[1]== "XLS" OR $namearray[1]== "ppt" OR $namearray[1]== "PPT" OR $namearray[1]== "pptx" OR $namearray[1]== "PPTX" OR $namearray[1]== "txt" OR $namearray[1]== "TXT" OR $namearray[1]== "mp3" OR $namearray[1]== "MP3") {
    echo "Dateiart ok<br>";
} else {
    echo"Dateiart nicht zugelassen.";
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/datatypewrong.php");
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
$stmt = $db ->prepare("INSERT INTO files (file_id, filename, filetype, filesize, owner, upload_date, access_rights, filepath, mimetype, favorite) VALUES('',:filename,:filetype,:filesize,$owner,CURRENT_TIMESTAMP (),'',:filepath,:mimetype,0)");
$stmt ->bindParam('filename', $namearray[0]);
$stmt ->bindParam('filetype',$namearray[1]);
$stmt ->bindParam('filesize', $fileSize);
$stmt ->bindParam('filepath',$filePath);
$stmt ->bindParam('mimetype',$mimetype);
$stmt ->execute();

echo "Dateiname: ".$_FILES["uploadfile"]["name"]."<br>";
if (!move_uploaded_file($_FILES["uploadfile"]["tmp_name"], "/home/df047/public_html/uploadfiles/".$namearray[0].".".$owner.".".$namearray[1])) { echo "Datei nicht hochgeladen";
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php");
    exit();
    die();
}
header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php");
exit();

/**
 * Created by PhpStorm.
 * User: tjard
 * Date: 16.05.18
 * Time: 17:14
 */