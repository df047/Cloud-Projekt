<?php

// require_once(' php datei für Datenbankverbindung ');
$database = new database();
$db = $database->get_db();
$db_connect = $db;


// $file_id = $_GET[' Name von der File ID?']; --> hier file_id
// $user_id = $_GET[' Name von der User ID?']; --> hier user_id

$get_file = $db_connect->prepare("SELECT * FROM ? WHERE file_id = :file_id");
$get_file->bindparam(':file_id', $file_id);
$get_file->execute();

$download_file = $get_file->fetch();

    if($download_file['file_status?'] == 'public')

        {

            // Datei soll heruntergeladen werden
            $downloadfile = '?file_storage?/'.$user_id.'/user_files/'.$file_id.'.'.$download_file['?file_type?'];

            // Dateiname einer Variablen zuweisen
            $filename = $download_file['?file_name?'];

            // Dateigröße einer Variable zuweisen
            $filesize = $download_file['file_size'];

            // Browser Informationen über Datei geben
            header("Content-Disposition: attachment; file_name='$filename'");
            header("Content-Length: $filesize");

            // Herunterladen
            readfile($downloadfile);

            // Final
            exit;

}

else { exit; }