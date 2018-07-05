<?php
//https://mars.iuk.hdm-stuttgart.de/~gurzki/dl/download2.php?filename=bild.jpg
$directory= "/home/df047/public_html/uploadfiles";
            require_once "logindaten.php";

            try
            {
                $db= new PDO ($dsn,$dbuser,$dbpass);
            }
            catch (PDOException $p) {
                echo("Fehler bei Aufbau der Datenbankverbindung.");
            }


            $file=$_GET["fileid"];
            $sql="SELECT * FROM files WHERE file_id='$file'";
            $query=$db->prepare($sql);
            $query->execute();
            while ($zeile=$query->fetchObject()) {
                $mimetype=$zeile->mimetype;
            }



if ($_GET["favorite"]="1")
    {
        echo " Sie haben diese Datei bereits favorisiert";
        die();
    }
else
    {
        $favorite = $i + 1;
    }





