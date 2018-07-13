<?php

require_once "facebooklogin.php";

$helper = $fb->getRedirectLoginHelper();
try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (isset($accessToken)) {

    $_SESSION['facebook_access_token'] = header("Location:mars.iuk.hdm-stuttgart.de/~df047/dashboard.php"). $accessToken;


} elseif ($helper->getError()) {

    exit;
}

?>