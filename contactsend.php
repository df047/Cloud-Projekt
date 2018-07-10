<?php

$vorname = $_POST ('vorname');
$nachname = $_POST ('nachname');
$email = $_POST ('email');
$telefon = $_POST ('telefon');
$nachricht = $_POST ('nachricht');



$empfänger = "info.thunderstorm@mail.de";
$absendername = "Kontaktformular";
$absenderemail = $email;
$betreff = "Neue Nachricht über Kontaktformular";
$text = "Es ist eine neue Nachricht über das Kontaktformular eingetroffen. Folgende Daten wurden übermittelt:

Name, Vorname: ".$nachname.", ".$vorname."
E-Mail: ".$email."
Telefonnummer: ".telefon."
Nachricht:
".nachricht.;
mail($empfänger, $betreff, $text, "From: $absender <$ansemdermail>");


echo('Vielen Dank! Das Thunderstorm-Team meldet sich schnellstmöglich bei Ihnen');

/**
 * Created by PhpStorm.
 * User: Tjard
 * Date: 11.07.18
 * Time: 00:15
 */