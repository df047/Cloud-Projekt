<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/logout.php");
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
    <link href="dashboard3style.css" rel="stylesheet">
</head>

<body>
<nav id="sidebar">
    <div class="sidebar-header">
        <button type="button" class="btn btn-outline-primary" id="upload" data-toggle="modal" data-target="#uploadmodal"><span class="glyphicon glyphicon-cloud-upload"></span>&emsp;Datei hochladen</button>
    </div>

    <div class="modal fade" id="uploadmodal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Datei auswählen:</h4>
                </div>
                <div class="modal-body">
                    <form  hidden id="dateihochladen" action="uploaddo.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="uploadfile" id="uploadfile">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                            <button class="btn btn-primary" type="submit" name="submit">Datei hochladen</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <ul class="list-group">
        <li><a href="https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php"><span class="glyphicon glyphicon-book"></span>&emsp;Meine Ablage</a></li>
        <li><a href="https://mars.iuk.hdm-stuttgart.de/~df047/sharedashboard.php"><span class="glyphicon glyphicon-share-alt"></span>&emsp;Für mich freigegeben</a></li>
        <li><a href="createfolder.php"><span class="glyphicon glyphicon-folder-open"></span>&emsp;Ordner</a> </li>
        <li class="active"><a href="favorite.php"><span class="glyphicon glyphicon-star"></span>&emsp;Favoriten</a></li>
        <!--<li><a href="trash.php"><span class="glyphicon glyphicon-trash"></span>&emsp;Papierkorb</a></li>-->

    </ul>
</nav>


<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a id="sidebarCollapse" href="#"><img class="logo" src="bilder/Thunderstorm_Teillogo.png"></a>
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
    <div class="active">

        <h1><strong>FEHLER BEIM DATEIUPLOAD</strong></h1>
        <br>
        <?php
        echo("Der Dateiname ist ungültig. Bitte keine Punkte im Dateinamen. <br><br><br>");
        echo("<a class='btn btn-primary' href='https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php'>Zurück zum Dashboard</a>");
        ?>

    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">sergqer</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
    <script>
        $("#upload").click(function(){
            $("#dateihochladen").toggle();
        });

        $(document).ready(function () {

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
            });

        });
        $('#uploadmodal').appendTo("body");
    </script>
</body>
</html>
/**
* Created by PhpStorm.
* User: tjard
* Date: 12.07.18
* Time: 09:58
*/
/**
* Created by PhpStorm.
* User: tjard
* Date: 12.07.18
* Time: 10:07
*/