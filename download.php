<?php

require_once('sys_class/db_connect.php');

$database = new database();
$db = $database->get_db();
$db_connect = $db;


$file_id = $_GET['file_id'];
$user_id = $_GET['user_id'];

$get_file = $db_connect->prepare("SELECT * FROM tbl_files WHERE file_id = :file_id");
$get_file->bindparam(':file_id', $file_id);		
$get_file->execute();
			
$download_file = $get_file->fetch();

if($download_file['file_state'] == 'public'){

	// Die Datei soll geladen werden
	$downloadfile = 'file_storage/'.$user_id.'/user_files/'.$file_id.'.'.$download_file['file_type'];	

	// Filename einer Variable zuweisen
	$filename = $download_file['file_name'];
		
	// Filesize einer Variable zuweisen
	$filesize = $download_file['file_size'];
	
	// Browser Infos übergeben zur Datei - mit Werten aus den zuvor definierten Variablen
	header("Content-Disposition: attachment; filename='$filename'"); 
	header("Content-Length: $filesize");
		
	// Downloaden
	readfile($downloadfile);
		
	// Fertig
	exit;
	
}

else { exit; }

















		
		
		

?>