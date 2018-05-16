<?php
session_start();
{
    $fileName=$_FILES["uploadfile"]["name"];
    $fileType=$_FILES["uploadfile"]["type"];
    $fileSize=$_FILES["uploadfile"]["size"];
    $filepath= "mars.iuk.hdm-stuttgart.de/home/df047/public_html/dateiuploadfiles" STRING[$fileName+$fileType];

}

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$stmt = $db ->prepare("INSERT INTO files (file_id, filename, filetype, filesize, upload_date, acess_rights, filepath) VALUES('',:filename,:filetype,:filesize,CURRENT_DATE,:acess_rights,:nachname)");
$stmt ->bindParam('filename', $fileName);
$stmt ->bindParam('filetype',$fileType);
$stmt ->bindParam('filesize', $fileSize);
$stmt ->bindParam('acess_rights',$acessRight);
$stmt ->bindParam('filepath',$filepath);
$stmt ->execute();


exit();


echo "Dateiname: ".$_FILES["uploadfile"]["name"]."<br>"; if($_FILES["uploadfile"]["name"]=="")
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
if (!move_uploaded_file($_FILES["uploadfile"]["tmp_name"], "mars.iuk.hdm-stuttgart.de/home/df047/public_html/dateiuploadfiles".$_FILES["uploadfile"]["name"])) { echo "Datei nicht hochgeladen";
    die();
}


/**
 * Created by PhpStorm.
 * User: tjard
 * Date: 16.05.18
 * Time: 17:14
 */