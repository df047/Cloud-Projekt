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

<nav class="navbar navbar-default navbar-fixed-top">
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
        <div class="loginfeld">
        <?php
require_once "logindaten.php";


// Datenbankverbindung

try
{
    $db= new PDO ($dsn,$dbuser,$dbpass);
}
catch (PDOException $p) {
    echo("Fehler bei Aufbau der Datenbankverbindung.");
}

// Hier wird zunächst überprüft, ob die user_id und passwortcode übergeben wurde
$user_id=$_GET['userid'];
$passwortcode=$_GET['code'];

//Hier wird überprüft, ob der Link zum zurücksetzten des Passworts Inhalt in user_id und in passwortcode hat

if($user_id === NULL || $passwortcode=== NULL){
    echo "Nutzer hat kein Passwortcode angefordert";
    die();
}

// die beendet die Skriptausführung


// Abfrage des Nutzers
try {

    // $stmt = $db->prepare("SELECT * FROM users WHERE id = :user_id"); // Datenbankabfrage Verbereitung wird in $stmt gespeichert
    // $stmt->bindParam(':user_id', $user_id);
    // $stmt->execute(); // Abfrage wird ausführen
    // $row = $stmt->fetch(PDO::FETCH_ASSOC); // Ergebnisabfrage wird in einem Array abgespeichert

    $statement = $db->prepare("SELECT id,passwortcode,passwortcode_time FROM users WHERE id = :user_id");
    $result = $statement->execute(array('user_id' => $user_id));
    $resArray = $statement->fetchAll();
}

catch(PDOException $e) {
    echo "Error: ". $e->getMessage();
}


if($resArray != null){
  $resPasswortcode = $resArray{0}{1};
  $resPasswortcode_time = $resArray{0}{2};
  if(sha1($passwortcode) === $resPasswortcode){
    if($resPasswortcode_time != null && strtotime($resPasswortcode_time) > (time()-24*3600) ){


        echo "

        <form action=\"password_renew.php\" method=\"post\" name=\"Login_Form\" class=\"form-signin\">
        <img id=\"loginimage\" src=\"bilder/Thunderstorm_Teillogo.png\">
        <h3 id=\"password_text\">Passwort zurücksetzten</h3>
        <p> Setzten Sie hier ihr neues Passwort ein </p>

        <input type='hidden' value='". $user_id ."' name='id'>
        <input type=\"password\" class=\"form-control\" name=\"password\" placeholder=\"Neues Passwort\" required=\"\"/>
        <input type=\"password\" class=\"form-control\" name=\"password_2\" placeholder=\"Neues Passwort wiederholen\" required=\"\"/>
        <button type=\"Submit\" class=\"btn btn-lg btn-primary btn-block\" name=\"Submit\" id=\"password_renew\" value=\"Send\" >Zurücksetzen</button> <br>


    </form>
    
    

  
      ";
    }else echo "Dein Code ist leider abgelaufen.";
  }else echo "Dein Passwortcode ist leider falsch.";
}else echo "Der Benutzer konnte nicht gefunden werden.";


//
// if($passwortcode===$row['passwortcode']){
//         echo "
//             <form method='post' action='password_renew.php'>
//                 <input type='hidden' value='". $row['user_id'] ."' name='id'>
//                 <p>Neues Passwort eingeben:</p>
//                 <input type='password' name='password'> <br> <br>
//                 <p>Passwort wiederholen:</p>
//                 <input type='password' name='password_2'> <br> <br>
//                 <input type='submit' value='Zurücksetzen'>
//              </form>
//         ";
//
//
//
// }else{
//     echo "<html><h3>sha1(passwordcode)</h1><br/>";
//     echo sha1($passwortcode);
//     echo "<br/><h3>row passwordcode</h3><br/>";
//     echo $user['passwortcode'];
//     echo "<br/><h3>row</h3><br/>";
//     echo "</html> ";
//   }


        ?>
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
            <img id="footerimage" src="bilder/Thunderstorm_Teillogo.png">
        </div>
    </div>
</footer>



</body>
</html>




