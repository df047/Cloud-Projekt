<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: https://mars.iuk.hdm-stuttgart.de/~lb100/Cloudprojekt/logout.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheet1.css">
</head>
<body>
<div id="topbar">
    <ul>
        <li><a id="topbarlogo" href="https://mars.iuk.hdm-stuttgart.de/~lb100/Cloudprojekt/startseite.html"><img src="logo.png" width="165" height="85"></a></li>
        <li><a class="topbardropdown" href="#">Platzhalter</a></li>
        <li><a class="topbardropdown" href="#">Platzhalter</a></li>
        <li style= "float:right"><a class="active" href="https://mars.iuk.hdm-stuttgart.de/~lb100/Cloudprojekt/logout.php">Logout</a></li>
    </ul>

</div>
<nav id="navbar">
    <ul>
        <li><a href="https://mars.iuk.hdm-stuttgart.de/~lb100/#">Meine Ablage</a></li>
        <li><a href="https://mars.iuk.hdm-stuttgart.de/~lb100/#">Meine Bubbles</a></li>
        <li><a href="https://mars.iuk.hdm-stuttgart.de/~lb100/Cloudprojekt/showprofile.php">Mein Profil</a></li>
        <li><a href="https://mars.iuk.hdm-stuttgart.de/~lb100/#">Hilfe</a></li>
    </ul>

</nav>
<script>
    window.onscroll = function() {myFunction()};
    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;
    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }
</script>
<br><br>
<div id="backgroundcontainer">
    <div class="box">

    </div>

    <div class="box">

    </div>
</div>
<div id="footer">
    <div id="footercontainer">
        <div class="footerbox">
            <a href="index.php">Startseite</a><br>
            <a href="login.html">Login</a>
        </div>
        <div class="footerbox">
            <a href="archiv.php">Archiv</a><br>
            <a href="produkte.php">Produkte</a>
        </div>
        <div class="footerbox">
            <a href="impressum.php">Impressum</a><br>
            <a href="uebermich.php">&Uumlber Mich</a>
        </div>
    </div>
    <a href="#top"> Back to the top</a><br><br>
    <i class="fa fa-copyright" aria-hidden="true"></i> Bubbles Inc. 2018 (Fake)
</div>
</body>
</html>