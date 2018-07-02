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
          <form method='post' action='password_renew.php'>
              <input type='hidden' value='". $user_id ."' name='id'>
              <p>Neues Passwort eingeben:</p>
              <input type='password' name='password'> <br> <br>
              <p>Passwort wiederholen:</p>
              <input type='password' name='password_2'> <br> <br>
              <input type='submit' value='Zurücksetzen'>
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
