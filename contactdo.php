<div class="container">

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

    <div class="container">

        <div class="starter-template">
        <h1>Kontaktformular</h1>
        <p> Nutzen Sie dieses Formular um mit uns in Kontakt zu treten.</p>
        <div class="row">
            <div class=""col-md-6">
            <div id=""erfolgsmeldung"></div>
            <form id="frmKontakt">
            <div class="form-group" id="frmGrpVorname">
                <label for="vorname" class="control-label">Vorname</label>
                <input type="text" class="form-control" id="vorname" placeholder="Max">
            </div>
            <div class="form-group" id="frmGrpNachname">
                <label for="Nachname" class="control-label">Nachname</label>
                <input type="text" class="form-control" id="Nachname" placeholder="Mustermann">
            </div>
            <div class="form-group" id="frmGrpEmail">
                <label for="email" class="control-label">E-Mail Adresse</label>
                <input type="text" class="form-control" id="email" placeholder="max@mustermann.de">
            </div>
            <div class="form-group" id="frmGrpTelefon">
                <label for="telefon" class="control-label">Telefonnummer</label>
                <input type="text" class="form-control" id="email" placeholder="0711 / 00000000">
            </div>

            <div class="form-group" id="frmGrpNachricht">
                <label for="nachricht" class="control-label">Ihr Nachricht an das Thunderstorm-Team</label>
                <textarea id="nachricht" class="form-control" rows="5" placeholder="Hier Ihre Nachricht schreiben..."></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Abschicken</button>
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
</div>



<script>
    // Kontrolle was eingegeben wurde (Mit #id .vorbereitete jQuery Funktion submit)
    $('#frmKontakt').submit(function() {

        // Variable in der das Ergebnis von der Formularkontrolle gespeichert werden
        var_formControl = true;

        // Jede Formgroup bekommt eine eigene Variable
        var_frmGrpVorname = $('#frmGrpVorname');
        var_frmGrpNachname = $('#frmGrpNachname');
        var_frmGrpEmail = $('#frmGrpEmail');
        var_frmGrpTelefon = $('#frmGrpTelefon');
        var_frmGrpNachricht = $('#frmGrpNachricht');



        //Klasse wird stets nach dem checken zurückgesetzt

        var_frmGrpVorname.removeClass('has-error');
        var_frmGrpNachname.removeClass('has-error');
        var_frmGrpEmail.removeClass('has-error');
        var_frmGrpTelefon.removeClass('has-error');
        var_frmGrpNachricht.removeClass('has-error');


        // Inhalte der Formularfelder mit id des Inputfelds + .val als vorgegbenen jQuery Funktion, die uns den Inhalt des Inputfelds wieder gibt und in die Variable bringt

        var vorname = $('#vorname').val();
        var nachname = $('#nachname').val();
        var email = $('#email').val();
        var telefon = $('#telefon').val();
        var nachricht = $('#nachricht').val();


        // Inhalte werden kontrolliert

        //falls hier schon kein Inhalt drin, wird formControl auf false gesetzt (Pflichtfelder!)
        if (vorname == '') {
            formControl = false;
            // Dur vordefinierte Bootstrapklasse wird das Formularfeld rot
            var_frmGrpVorname.addClass('has-error');
        }

        if (vorname == '') {
            formControl = false;
            // Durch vordefinierte Bootstrapklasse wird das Formularfeld rot
            var_frmGrpNachname.addClass('has-error');
        }

        if (vorname == '') {
            formControl = false;
            // Durch vordefinierte Bootstrapklasse wird das Formularfeld rot
            var_frmGrpEmail.addClass('has-error');
        }


        if (vorname == '') {
            formControl = false;
            // Durch vordefinierte Bootstrapklasse wird das Formularfeld rot
            var_frmGrpNachricht.addClass('has-error');
        }



        //Wenn formControl wahr ist, mache folgendes
        if(formControl) {
            $.ajax({

                //Werden mittels Post übermittelt
                type: 'POST',

                // Wo soll es hingesendet werden
                url:'contactsend.php',

                // Variablen müssen übergeben werden (Die Variable die über POST versendet wird hat den Namen vorname:Inhalt aus der JavaScript Variablen
                data: { vorname:vorname, nachname:nachname, email:email, telefon:telefon, nachricht:nachricht }
            }).done(function(message) {
                var erfolgsmeldung = $('#erfolgsmeldung');

                //Message von der PHP Datei wird übergeben
                erfolgsmeldung.html(message);

                //Die Classen Alert + Alert Sucess werden hinzugefügt
                erfolgsmeldung.addClass('alert');
                erfolgsmeldung.addClass('alert-success');

            });
        }

        return false;
    });


</script>


</body>
