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
            <li class="active"><a href="https://mars.iuk.hdm-stuttgart.de/~df047/dashboard.php"><span class="glyphicon glyphicon-book"></span>&emsp;Meine Ablage</a></li>
            <li><a href="https://mars.iuk.hdm-stuttgart.de/~df047/sharedashboard.php"><span class="glyphicon glyphicon-share-alt"></span>&emsp;Für mich freigegeben</a></li>
            <li><a href="createfolder.php"><span class="glyphicon glyphicon-folder-open"></span>&emsp;Ordner</a> </li>
            <li><a href="favorite.php"><span class="glyphicon glyphicon-star"></span>&emsp;Favoriten</a></li>
            <!--<li><a href="trash.php"><span class="glyphicon glyphicon-trash"></span>&emsp;Papierkorb</a></li>-->

        </ul>
    </nav>


        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a id="sidebarCollapse" href="#"><img class="logo" src="bilder/Thunderstorm_Teillogo.png"></a>
                </div>

                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><form class="navbar-form navbar-center" action="searchdo.php">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Suche" style="width: 100%">
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
        <!--<div class="active">-->
        <div class="container">
            <div class="row">
            <div class="überschrift">
            <h2>Meine Ablage</h2>
            </div>
        </div>
        </div><br>
        <div class="container">
            <div class="row">
        <?php
        $owner=$_SESSION["user_id"];

        require_once "logindaten.php";

        try
        {
            $db= new PDO ($dsn,$dbuser,$dbpass);
        }
        catch (PDOException $p) {
            echo("Fehler bei Aufbau der Datenbankverbindung.");
        }
        $sql = "SELECT * FROM files WHERE owner=$owner";
        $query  = $db ->prepare($sql);
        $query ->execute();
        while ($zeile = $query->fetchObject()) {
            $file = $zeile->file_id;
            echo("<div class='dropdown'>
                    <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>");
            echo("$zeile->filename"."."."$zeile->filetype");
            echo("<span class='caret'></span></button>
                    <ul class='dropdown-menu'>
                        <li>");
            echo("<a href='https://mars.iuk.hdm-stuttgart.de/~df047/download.php?filename=");
            echo("$zeile->filename"."."."$owner"."."."$zeile->filetype");
            echo("&fileid=");
            echo("$zeile->file_id"."'>");
            echo("Download</a>");
            echo ("<a href='#' data-toggle='modal' data-target='#deletemodal"."$zeile->file_id"."'".">Löschen</a>");

            if ($zeile->favorite == $owner){

            }
            else{
                echo("<a href='https://mars.iuk.hdm-stuttgart.de/~df047/favoritedo.php?fileid=");
                echo("$zeile->file_id"."'>");
                echo("Favorisieren");
                echo("</a>");
            }

            echo("<li><a href='https://mars.iuk.hdm-stuttgart.de/~df047/accesswrite.php?fileid=".$zeile->file_id."'>Freigeben für...</a>");
            echo("<li><a href='#' id='details' data-toggle='modal' data-target='#modal"."$zeile->file_id"."'".">Details</a>");
            echo("</ul></div><br>");
            echo ("<div class='modal fade' id='deletemodal"."$zeile->file_id"."'"." role='dialog'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                        <h4 class='modal-title'>Bist du sicher, dass du die Datei löschen möchtest?</h4>
                    </div>
                    <div class='modal-footer'>
                    <form action='delete_file.php' method='post'>
                          <input hidden type='text' name='filename' value='".$zeile->filename."'>
                           <input hidden type='text' name='filetype' value='".$zeile->filetype."'>
                          <input hidden type='text' name='fileid' value='".$zeile->file_id."'>
                          <input hidden type='text' name='owner' value='".$zeile->owner."'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>Nein</button>
                            <input type='submit' role='button' class='btn btn-primary' value='Ja'>
                            </form>
                            
                    </div>
                </div>
            </div>
        </div> 
        <script>
                 $('#deletemodal"."$zeile->file_id"."').appendTo('body');
                 </script>
       ");
            echo("<!-- Modal -->
                    <div id=");
            echo("'modal"."$zeile->file_id' "."class='modal fade' role='dialog'>");
            echo("<div class='modal-dialog'>

                    <!-- Modal content-->
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                            <h4 class='modal-title'>");
            echo("Details zu "."$zeile->filename."."$zeile->filetype");
            echo("</h4>
            </div>
            <div class='modal-body'>
                Dateigröße:"."$zeile->filesize<br>"."
                Freigegeben für:<br><br>Thunderstorm-Nutzer<br><br> ");
            $accesscode=$zeile->access_rights;
            $userarray=explode(".",$accesscode);
            $i=0;
            foreach($userarray as $value){
                require_once "logindaten.php";

                try
                {
                    $db= new PDO ($dsn,$dbuser,$dbpass);
                }
                catch (PDOException $p) {
                    echo("Fehler bei Aufbau der Datenbankverbindung.");
                }

                $sql2 = "SELECT * FROM users WHERE id='$value'";
                $query2  = $db ->prepare($sql2);
                $query2 ->execute();

                while ($zeile2 = $query2->fetchObject()) {
                    echo ($zeile2->username." - "."<button id='question".$i."' type='button' class='btn btn-primary'>Entfernen</button><br>");

                    echo("<div hidden class='alert alert-danger' id='accessdeletebox".$i."'>
                          <strong>Achtung</strong> Wollen sie diese Freigabe wirklich löschen?
                          <form action='accessdeletedo.php' method='post'>
                          <input hidden type='text' name='usertodelete' value='".$i."'>
                          <input hidden type='text' name='fileid' value='".$zeile->file_id."'>
                          <input type='submit' value='JA'>
                          
                        </form>
                        </div>
                        ");
                    echo("<script>
                $(document).ready(function () {
                        $('#question".$i."').click(function(){
                            $('#accessdeletebox".$i."').toggle();
                        })});</script>");
                    $i++;
                }
                }
                echo("Für nicht registrierte Nutzer:<br>");
            $sharedsql = "SELECT * FROM sharing WHERE file='$file'";
            $sharedquery  = $db ->prepare($sharedsql);
            $sharedquery ->execute();
            $y=1;
            while ($sharedzeile = $sharedquery->fetchObject()) {
                echo ($sharedzeile->non_user." - "."<button id='nuquestion".$y."' type='button' class='btn btn-primary'>Entfernen</button><br>");

                echo("<div style='display:none;' class='alert alert-danger' id='nuaccessdeletebox".$y."'>
                          <strong>Achtung</strong> Wollen sie diese Freigabe wirklich löschen?
                          <a href='https://mars.iuk.hdm-stuttgart.de/~df047/externaldelete.php?shareid=");
                echo($sharedzeile->share_id);
                echo("' class='btn btn-danger'>Ja</a>
                       </div>
                        ");
                echo("<script>
                $(document).ready(function () {
                        $('#nuquestion".$y."').click(function(){
                            $('#nuaccessdeletebox".$y."').toggle();
                        })});</script>");
                $y++;
            }



            echo("
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Schließen</button>
            </div>
            
        </div>   
    </div>
</div>
<script>
                 $('#modal"."$zeile->file_id"."').appendTo('body');
                 </script>");

        }

        ?></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="überschrift">
                    <h2>Meine Ordner <button id="ordnerbutton" class="btn btn-primary" data-toggle="modal" data-target="#createfolder" type="button">+</button></h2>
                </div>
            </div>
        </div><br>

            <div class="modal fade" id="createfolder" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Neuer Ordner</h4>
                        </div>
                        <div class="modal-body">
                            <form id="createfolder" action="createfolderdo.php" method="post">
                                <input type="text" name="foldername" placeholder="Ordnername">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                                    <button class="btn btn-primary" type="submit" value="Erstellen">Erstellen</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <div class="container">
            <div class="row">
            <?php
            $owner=$_SESSION["user_id"];

            require_once "logindaten.php";

            try
            {
            $db= new PDO ($dsn,$dbuser,$dbpass);
            }
            catch (PDOException $p) {
            echo("Fehler bei Aufbau der Datenbankverbindung.");
            }
            $sql3 = "SELECT * FROM folders WHERE owner=$owner";
            $query3  = $db ->prepare($sql3);
            $query3 ->execute();
            while ($zeile3 = $query3->fetchObject()) {
            echo("<div class='dropdown'>
                <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>");
                    echo ("<span class='glyphicon glyphicon-folder-close'>&emsp;</span>");
                    echo("$zeile3->folder_name");
                    echo("<span class='caret'></span></button>
                <ul class='dropdown-menu'>
                    ");
                echo("<li><a href='#' data-toggle='modal' data-target='#deletemodal"."$zeile3->folder_id"."'".">Löschen</a></li>");
                echo ("
                <div class='modal fade' id='deletemodal"."$zeile3->folder_id"."'"." role='dialog'>
                
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                        <h4 class='modal-title'>Bist du sicher, dass du den Ordner löschen möchtest?</h4>
                                    </div>
                                    
                                    <div class='modal-footer'>
                                        <form action='deletefolder.php' method='post'>
                                              <input hidden type='text' name='folderid' value='".$zeile3->folder_id."'>
                                              <button type='button' class='btn btn-default' data-dismiss='modal'>Nein</button>
                                              <input type='submit' role='button' class='btn btn-primary' value='Ja'>
                                        </form>     
                                    </div>
                                    
                                </div>
                            </div>
                </div>
                 <script>
                 $('#deletemodal"."$zeile3->folder_id"."').appendTo('body')
                 </script>");
                        echo("<li><a href='https://mars.iuk.hdm-stuttgart.de/~df047/showfolder.php?folderid="."$zeile3->folder_id"."'>Anzeigen</a></li>");
                    echo("</ul></div><br>");}

            ?></div>
        </div>
            </div>


<script>
$("#upload").click(function(){
    $("#dateihochladen").toggle();
});

$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#sidebar2').toggleClass('active');

    });

});
$('#uploadmodal').appendTo("body");
$('#createfolder').appendTo("body");

</script>
</body>
</html>