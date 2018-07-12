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
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-logo" href="index.html"><img class="bild1" src="bilder/Thunderstorm_Volllogo_Ohne-Hintergrund.png">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.html#über">Über uns</a> </li>
                    <li><a href="index.html#register1">Registrieren</a> </li>
                    <li><a href="contactdo.php">Kontakt</a></li>
                    <li> </li><a href="index.html"><button id="loginbutton" type="button" class="btn btn-primary">Login</button></a> </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id = "startseite">
        <div class="container">
        <div class="kontaktfeld">
            <div class="row">
                <form id="formkontakt" action="contactsend.php" method="post">
                    <h1 class="col-lg-12">Kontaktformular</h1>
                    <p class="col-lg-12"> Nutzen Sie dieses Formular um mit uns in Kontakt zu treten.</p>
                    <div class="form-group col-lg-12">
                        <label for="vorname" class="control-label">Vorname</label>
                        <input type="text" class="form-control" name="vorname" placeholder="Max">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="Nachname" class="control-label">Nachname</label>
                        <input type="text" class="form-control" name="nachname" placeholder="Mustermann">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="email" class="control-label">E-Mail Adresse</label>
                        <input type="email" class="form-control" name="email" placeholder="max@mustermann.de">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="telefon" class="control-label">Telefonnummer</label>
                        <input type="text" class="form-control" name="telefon" placeholder="0711 / 00000000">
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="nachricht" class="control-label">Ihre Nachricht an das Thunderstorm-Team</label>
                        <textarea name="nachricht" class="form-control" rows="5" placeholder="Hier Ihre Nachricht schreiben..."></textarea>
                    </div>
                    <div class="form-group col-lg-4">
                        <button type="submit" id="loginbuttonbig" class="btn btn-primary">Abschicken</button>
                    </div>


                </form>

            </div>
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
            <a href="https://www.facebook.com/Infothunderstorm-194163804553989/" class="fa fa-facebook"></a>
            <a href="https://www.twitter.com/thunderstorm_tw" class="fa fa-twitter"></a>
            <a href="https://www.instagram.com/info.thunderstorm/" class="fa fa-instagram"></a>
        </div>
        <div class="col-sm-4">
            <a href="index.html#">
                <img id="footerimage" src="bilder/Thunderstorm_Teillogo.png">
            </a>
        </div>
    </div>
</footer>






</body>
