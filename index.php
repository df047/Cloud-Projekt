<?php
require_once "facebooklogin.php";

$redirectURL = 'https://mars.iuk.hdm-stuttgart.de/~df047/login-callback.php';
$permissions = ['email'];
$loginUrl = $helper->getLoginUrl($redirectURL,$permissions);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thunderstorm</title>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet" />
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-logo" href="#"><img class="bild1" src="bilder/Thunderstorm_Volllogo_Ohne-Hintergrund.png">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#über">Über uns</a> </li>
                <li><a href="#register1">Registrieren</a> </li>
                <li><a href="contactdo.php">Kontakt</a></li>
                <li> </li><a href="#"><button id="loginbutton" type="button" class="btn btn-primary">Login</button></a> </li>
            </ul>
        </div>
    </div>
</nav>

<div id = "startseite">
    <div class="container">
        <div>
            <div class="col-md-4"></div>
            <div class="col-md-4" id="loginfeld">
                <form action="login_do.php" method="post" name="Login_Form" class="form-signin">
                    <img id="loginimage" src="bilder/Thunderstorm_Teillogo.png">
                    <h3 id="logintext">Your data, your cloud</h3>


                    <input type="text" class="form-control" name="username" placeholder="Benutzername"/>
                    <input type="password" class="form-control" name="password" placeholder="Passwort"/>

                    <button class="btn btn-lg btn-primary btn-block" id="loginbuttonbig"  name="Submit" value="Login" type="Submit">Login</button> <br>
                    <a href="<?php echo $loginUrl?>"> <button type="button" class="btn btn-primary btn-lg btn-block">Login mit Facebook</button></a>

                </form>
                <a href="#register1" class="btn btn-link btn-block">Registrieren</a>
                <div style="text-align:center">
                    <a id="password_forgot" href="password_forgot.html"><button class="btn btn-link">Passwort vergessen?</button></a>
                </div>

            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>

<a name="über"></a>
<div id="About">
    <div class="container">
        <div class="row">
            <div>

                <div class="col-sm-6 text-center" >
                    <img class="Leo" src="bilder/Leo.png" alt="Leo Buchet"><br>
                    <img class="Leo" src="bilder/David.png" alt="Leo Buchet"><br>
                    <img class="Leo" src="bilder/Tjard.png" alt="Leo Buchet">
                </div>

                <div class="col-sm-6 text-center">
                    <br>
                    <h2>Über Thunderstorm</h2>
                    <br>
                    <br>
                    <br>
                    <p> Thunderstorm ist eine von drei Stundenten der Hochschule der Medien entwickelte Cloud-Lösung für jedermann.
                        Ganz nach der Philosophie des Unternehmens "Thunderstorm - your data, your cloud" verhelfen wir Ihnen mit einer einfach zu bedienenden Benutzungsoberfläche,
                        den Einstieg in das Thema online Speichermöglichkeiten.
                        <br>
                        <br>

                    <p> Einmal registriert, können Sie sofort loslegen. Nicht nur Dateien hoch- & runterladen, sondern auch löschen,
                        umbenennen und ganz einfach mit anderen Kontakten Dokumente teilen.
                        <br>
                        <br>

                    <p>Thunderstorm ist somit für die kreative Zusammenarbeit optimiert. Hier können Sie umfangreiche
                        Dateien, z.B. in den Formaten PDF, JPG oder PNG für beliebige Nutzer freigeben.
                </div>
            </div>
        </div>
    </div>
</div>


<div id="register">
    <div class="container" >
        <div class="row">
            <a name="register1"></a>
            <div class="col-sm-6">
                <form action="signupdo.php" method="post" class="form-register">
                    <br>
                    <br>
                    <h1>Registrieren</h1>
                    <br>
                    <br>
                    <div class="form-group col-md-6">
                        <label class="control-label">Vorname</label>
                        <input type="text" name="vorname" class="form-control">
                    </div>


                    <div class="form-group col-md-6" id="lastname">
                        <label class="control-label">Nachname</label>
                        <input type="text" name="nachname" class="form-control">
                    </div>
                    <br>
                    <br>

                    <div class="form-group col-md-12">
                        <label class="control-label">Benutzername</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <br>
                    <br>

                    <div class="form-group col-md-6">
                        <label class="control-label">Passwort</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <br>
                    <br>

                    <div class="form-group col-md-6">
                        <label class="control-label">Passwort wiederholen</label>
                        <input type="password" name="passwordconfirm" class="form-control">
                    </div>
                    <br>
                    <br>

                    <div class="form-group col-md-12">
                        <label class="control-label">Email Adresse</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <br>
                    <br>


                    <button id="registerbutton" type="submit" class="btn btn-primary" value="Senden">Registrieren</button>
                </form>
            </div>

            <div class="col-sm-6">
                <br>
                <br>
                <h2>Nutzungsbedingungen</h2>
                <br>
                <br>
                <br>
                <p>
                    <b> Thunderstorm ist dankbar, dass Sie uns Ihre Daten anvertrauen. Im Gegenzug vertrauen wir darauf, dass Sie unsere Diese verantwortungsvoll benutzen. <br>
                        <br>
                        Mit Ihrer Registrierung auf der Thunderstorm Plattform willigen Sie den Nutzungsbedingungen der Thunderstorm GmbH ein: </b> <br>
                    <br>
                    - Verstoß gegen Sicherheits- oder Authentifizierungsmaßnahmen oder sonstiges Umgehen dieser Maßnahmen<br>
                    <br>
                    - Verschaffung von Zugang zu, Manipulation oder Verwendung von nicht öffentlichen Bereichen oder Teilen der Dienste oder gemeinsam genutzten Bereichen der Dienste, für die Sie keine Einladung erhalten haben<br>
                    <br>
                    - Stören oder Unterbrechen eines Nutzers, Hosts oder Netzwerks, zum Beispiel durch Versenden von Viren, Überlasten, Flooding, Spamming oder Mail-Bombing eines Teils der Dienste<br>
                    <br>
                    - Unaufgefordertes Versenden von Mitteilungen, Reklame, Werbung oder Spam<br>
                    <br>
                    - Veröffentlichen oder Freigeben von rechtswidrig pornographischen oder unsittlichen Inhalten oder von Inhalten, die extreme Gewalttaten enthalten<br>
                </p>


            </div>
        </div>
    </div>
</div>


<footer class="container-fluid text-center">
    <a name="bottom"></a>
    <div class="row">
        <div class="col-sm-4">
            <h3>Thunderstorm GmbH</h3> <br>
            <h5>Nobelstraße 10 </h5>
            <h5>70569 Stuttgart</h5> <br>
            <h5> Tel: +49(0)711 94545782 </h5>
            <h5> E-Mail: info.thunderstorm@mail.de</h5>
        </div>
        <div class="col-sm-4">
            <h3>Social Media</h3>
            <a href="https://www.facebook.com/Infothunderstorm-194163804553989/" class="fa fa-facebook"></a>
            <a href="https://www.twitter.com/thunderstorm_tw" class="fa fa-twitter"></a>
            <a href="https://www.instagram.com/info.thunderstorm/" class="fa fa-instagram"></a>
        </div>
        <div class="col-sm-4">
            <a href="#">
                <img id="footerimage" src="bilder/Thunderstorm_Teillogo.png">
            </a>
        </div>

    </div>
</footer>


</body>
</html>