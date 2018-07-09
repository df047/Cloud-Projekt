<!DOCTYPE html>
<html>
<head>
    <title>Thunderstorm</title>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet" />
</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-main">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html#"><img class="bild1" src="bilder/Thunderstorm_Volllogo_Ohne-Hintergrund.png">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.html#über">Über</a> </li>
                <li><a href="index.html#bottom">Kontakt</a></li>
                <li><a href="index.html#register1">Registrieren</a> </li>
                <a href="index.html#"><button id="loginbutton" type="button" class="btn btn-primary">Login</button></a>
            </ul>
        </div>
    </div>
</nav>

<div id = "home">
    <div class="wrapper">
        <div class="loginfeld" id="downloadarea">
<?php
require_once "logindaten.php";

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}
$string= $_GET["code"];
$sql = "SELECT * FROM sharing WHERE random_string='$string'";
$query  = $db ->prepare($sql);
$query ->execute();

    while ($zeile = $query->fetchObject()) {
        $check = $zeile->share_id;
        $file = $zeile->file;
    }
        if ($check !="") {
        echo("Ihnen wurde diese Datei freigegeben:<br><br>");
        $sql2 = "SELECT * FROM files WHERE file_id='$file'";
        $query2 = $db->prepare($sql2);
        $query2->execute();
        while ($zeile2 = $query2->fetchObject()) {
            echo("<a class='btn btn-primary btn-lg' href='https://mars.iuk.hdm-stuttgart.de/~df047/download.php?filename=");
            echo("$zeile2->filename" . "." . "$zeile2->owner" . "." . "$zeile2->filetype");
            echo("&fileid=");
            echo("$zeile2->file_id" . "'>");
            echo("$zeile2->filename" . "." . "$zeile2->filetype");
            echo("</a><br><br>");
            echo("Besitzer dieser Datei ist: ");
            $owner = $zeile2->owner;
            $sql3 = "SELECT * FROM users WHERE id='$owner'";
            $query3 = $db->prepare($sql3);
            $query3->execute();
            while ($zeile3 = $query3->fetchObject()) {
                echo($zeile3->vorname . " " . $zeile3->nachname . "<br><br>");
            }
        }

    echo("Hier können Sie sich auch bei <a href='https://mars.iuk.hdm-stuttgart.de/~df047/#register1'>Thunderstorm registrieren</a>, damit Sie immer und überall auf Ihre Dateien zugreifen können!");

}
else{
    echo ("Ihre Download-Freigabe ist erloschen oder der Besitzer hat Ihnen den Download verwehrt. <br> Bitte fordern Sie einen neuen Link an.");
    }

?>
        </div>
    </div>
</div>




<footer class="container-fluid text-center">
    <a name="bottom"></a>
    <div class="row">
        <div class="col-sm-4">
            <h3>Thunderstorm GmbH</h3> <br>
            <h4>Nobelstraße 10 </h4>
            <h4>70569 Stuttgart</h4> <br>
            <h4> Tel: +49(0)711 94545782 </h4>
            <h4> E-Mail: info.thunderstorm@mail.de</h4>
        </div>
        <div class="col-sm-4">
            <h3>Social Media</h3>
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-google"></a>
            <a href="#" class="fa fa-instagram"></a>
        </div>
        <div class="col-sm-4">
            <img id="footerimage" src="bilder/Thunderstorm_Teillogo.png">
        </div>
    </div>
</footer>



</body>
</html>

