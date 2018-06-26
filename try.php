<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheet1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<button id="question1">1</button><br>
<div id="accessdeletebox1">
    toggleding1
</div>
<script>
    $('#question1').click(function(){
        $('#accessdeletebox1').toggle();
    });
</script>
<button id="question2">2</button>
<div id="accessdeletebox2">
    toggleding2
</div>
<script>
    $('#question2').click(function(){
        $('#accessdeletebox2').toggle();
    });
</script>
</body>
</html>