<?php

    session_start()    ;

    require_once "Facebook/autoload.php";

    $fb = new Facebook\Facebook([
        'app_id' => '271763786927213', // Replace {app-id} with your app id
        'app_secret' => 'ea23440503059af7f7df60663266e0a1',
        'default_graph_version' => 'v3.0',
    ]);

    $helper = $fb->getRedirectLoginHelper();
?>