<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: https://mars.iuk.hdm-stuttgart.de/~lb100/Cloudprojekt/logout.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Thunderstorm</title>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="dashboard3style.css" rel="stylesheet" />
</head>

<body>
<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
        <button type="button" class="btn btn-outline-primary" id="upload" href="#">Datei hochladen</button>
        </div>

        <ul class="list-group">
            <li>
                    <form  hidden id="dateihochladen" action="upload.php" method="post" enctype="multipart/form-data">
    Datei auswählen:
                    <input type="file" name="uploadfile" id="uploadfile"><br>
                    <input type="submit" value="Dateihochladen" name="submit">
                </form>
            </li>
            <li class="active"><a href="https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php">Meine Ablage</a></li>
            <li><a href="#">Für mich freigegeben</a></li>
            <li><a href="#">Zuletzt verwendet</a></li>
            <li><a href="#">Favoriten</a></li>
        </ul>
    </nav>


        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">

                <div class="navbar-header">
                    <a class="navbar-brand" href="https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php"><img class="logo" src="bilder/Thunderstorm_weiß.png"></a>
                </div>

                <div class="collapse navbar-collapse" id="navbar">

                    <ul class="nav navbar-nav navbar-right">
                        <li><form class="navbar-form navbar-center" action="searchdo.php">
                            <div class="input-group col-md-12">
                                <input type="text" name="search" class="form-control" placeholder="Search" style="width: 100%">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form></li>
                        <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Einstellungen</a></li>
                        <li><a href="https://mars.iuk.hdm-stuttgart.de/~df047/showprofile.php"><img width=20px height=20px class="profilepicture-icon" src="https://mars.iuk.hdm-stuttgart.de/~df047/profilepictures/<?php
                                require_once "logindaten.php";

                                try
                                {
                                    $db= new PDO ($dsn,$dbuser,$dbpass);
                                }
                                catch (PDOException $p) {
                                    echo("Fehler bei Aufbau der Datenbankverbindung.");
                                }
                                $identificator= $_SESSION['user_id'];
                                $sql = "SELECT * FROM users WHERE id='$identificator'";
                                $query  = $db ->prepare($sql);
                                $query ->execute();
                                while ($zeile = $query->fetchObject()) {
                                    echo("$zeile->profilepicture");
                                }
                                ?>">Profil </a></li>
                        <li><a href="https://mars.iuk.hdm-stuttgart.de/~df047/logout.php"><span class="glyphicon glyphicon-log-out"></span> Abmelden</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    <div id="content">
        <div class="list-group">
            <?php
            $searchphrase=$_GET["search"];

            require_once "logindaten.php";

            try
            {
                $db= new PDO ($dsn,$dbuser,$dbpass);
            }
            catch (PDOException $p) {
                echo("Fehler bei Aufbau der Datenbankverbindung.");
            }
            $sql = "SELECT * FROM files WHERE filename LIKE '%$searchphrase%'";
            $query  = $db ->prepare($sql);
            $query ->execute();
            while ($zeile = $query->fetchObject()) {
                echo("<a href='#'");
                echo("class='list-group-item'>");
                echo("$zeile->filename"."$zeile->filetype");
                echo("</a>");
            }
            ?>
        </div>
    </div>
</div>
<script>
$("#upload").click(function(){
    $("#dateihochladen").toggle();
});
</script>
</body>
</html>
