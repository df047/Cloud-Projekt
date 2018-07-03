<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: https://mars.iuk.hdm-stuttgart.de/~df047/logout.php");
    exit();
}
$folderid=$_GET["folderid"];
$identificator= $_SESSION['user_id'];
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
<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <button type="button" class="btn btn-outline-primary" id="upload" href="#">Datei hochladen</button>
        </div>

        <ul class="list-group">
            <li>
                <form  hidden id="dateihochladen" action="uploaddo.php" method="post" enctype="multipart/form-data">
                    Datei auswählen:
                    <input type="file" name="uploadfile" id="uploadfile"><br>
                    <input type="submit" value="Dateihochladen" name="submit">
                </form>
            </li>
            <li class="active"><a href="https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php">Meine Ablage</a></li>
            <li><a href="https://mars.iuk.hdm-stuttgart.de/~df047/dashboardfreigegeben.php">Für mich freigegeben</a></li>
            <li><a href="createfolder.php">Zuletzt verwendet (Ordner erstellen)</a></li>
            <li><a href="#">Favoriten</a></li>
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
                <a id="sidebarCollapse" href="#"><img class="logo" src="bilder/Thunderstorm_weiss.png"></a>
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

            <?php
            require_once "logindaten.php";

            try
            {
                $db= new PDO ($dsn,$dbuser,$dbpass);
            }
            catch (PDOException $p) {
                echo("Fehler bei Aufbau der Datenbankverbindung.");
            }
            $sql2 = "SELECT * FROM folders WHERE folder_id='$folderid'";
            $query2  = $db ->prepare($sql2);
            $query2 ->execute();
            while ($zeile2 = $query2->fetchObject()) {
                echo("<h1>" . "$zeile2->folder_name" . "</h1><br>");
                echo("<button type='button' class='btn' id='newfilebutton' data-toggle='modal' data-target='#newfile'>+</button><br>");
                $filearray = explode(".", $zeile2->file_code);
                $i = 0;
                foreach ($filearray as $value) {
                    require_once "logindaten.php";

                    try {
                        $db = new PDO ($dsn, $dbuser, $dbpass);
                    } catch (PDOException $p) {
                        echo("Fehler bei Aufbau der Datenbankverbindung.");
                    }

                    $sql4 = "SELECT * FROM files WHERE file_id='$value'";
                    $query4 = $db->prepare($sql4);
                    $query4->execute();

                    while ($zeile4 = $query4->fetchObject()) {
                        echo("<div class='dropdown'>
                                <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>");
                        echo("$zeile4->filename"."."."$zeile4->filetype");
                        echo("<span class='caret'></span></button>
                                <ul class='dropdown-menu'>
                        <li>");
                        echo("<a href='https://mars.iuk.hdm-stuttgart.de/~df047/download.php?filename=");
                        echo("$zeile4->filename"."."."$zeile4->filetype");
                        echo("&fileid=");
                        echo("$zeile4->file_id"."'>");
                        echo("Download");
                        echo("</a></li>");
                        echo("<li><a id='movefile' href='#' data-toggle='modal' data-target='#movefilemodal".$i."'>");
                        echo("in Ordner verschieben");
                        echo("</a></li>");
                        echo("<li><a href='#' id='question" . $i . "'>Entfernen</a></li></ul></div>");
                        echo("<div hidden class='alert alert-danger' id='accessdeletebox" . $i . "'>
                          <strong>Achtung</strong> Wollen Sie diese Datei wirklich aus dem Ordner entfernen?<br>
                          (Die Datei wird nur aus dem Ordner entfernt aber befindet sich weiterhin in Ihrer Ablage.<br>
                          Wenn Sie Datei vollständig löschen wollen, tun sie dies bitte in <a style='color:blue' href='https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php'>Ihrer Ablage</a>!
                          <form action='deletefilefromfolder.php' method='post'>
                          <input hidden type='text' name='filetodelete' value='" . $i . "'>
                          <input hidden type='text' name='folderid' value='" . $zeile2->folder_id . "'>
                          <input type='submit' value='JA'>
                        </form>
                        <button id='no".$i."'>Nein</button>
                        </div>
                        ");
                        echo("<div id='movefilemodal".$i."' class='modal fade' role='dialog'>
                                <div class='modal-dialog'>
                
                                    <!-- Modal content-->
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                            <h4 class='modal-title'>In welchen Ordner möchtest du die Datei verschieben?</h4>
                                        </div>
                                        <div class='modal-body'>
                                            <p>Ornder auswählen:</p>");
                        $sql5 = "SELECT * FROM folders WHERE owner='$identificator' AND NOT folder_id='$folderid'";
                        $query5 = $db->prepare($sql5);
                        $query5->execute();
                            while ($zeile5 = $query5->fetchObject()) {
                                echo("<a class='btn btn-primary' href='https://mars.iuk.hdm-stuttgart.de/~df047/movefiletofolder.php?fileid=");
                                echo($zeile4->file_id . "&filetodelete=");
                                echo($i . "&currentfolder=");
                                echo($zeile2->folder_id . "&newfolder=");
                                echo($zeile5->folder_id . "'>" . $zeile5->folder_name . "</a><br>");
                            }



                       echo("           </div>
                                    <div class='modal-footer'>
                                    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                    </div>
                                </div>
        
                               </div>
                            </div>");
                        echo("<script>
                        $('#question" . $i . "').click(function(){
                            $('#accessdeletebox" . $i . "').toggle();
                        });</script>");
                        echo("<script>
                        $('#no" . $i . "').click(function(){
                            $('#accessdeletebox" . $i . "').toggle();
                        });</script>");
                        $i++;
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

            <!-- Modal -->
            <div id="newfile" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Deine Ablage</h4>
                        </div>
                        <div class="modal-body">
                            <p>Some text in the modal.</p>
                            <?php
                            require_once "logindaten.php";

                            try
                            {
                                $db= new PDO ($dsn,$dbuser,$dbpass);
                            }
                            catch (PDOException $p) {
                                echo("Fehler bei Aufbau der Datenbankverbindung.");
                            }
                            $sql3 = "SELECT * FROM files WHERE owner='$identificator'";
                            $query3  = $db ->prepare($sql3);
                            $query3 ->execute();
                            while ($zeile3 = $query3->fetchObject()) {
                                echo("<a class='btn btn-primary' href='https://mars.iuk.hdm-stuttgart.de/~df047/addfiletofolder.php?filetoadd=".$zeile3->file_id."&folderid=$folderid'>$zeile3->filename".".$zeile3->filetype</a><br>");
                            }
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
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
            </script>
</body>
</html>