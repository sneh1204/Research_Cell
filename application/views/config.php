<?php
    $client = new Google_Client();
    $client->setClientId("333397590788-47u2s7ej1l3kapa1gge6lf3go1sijram.apps.googleusercontent.com");
    $client->setClientSecret("Fbr79MR-RYtL9zqOy1Z932sF");
    $client->setApplicationName("Research");
    $client->setRedirectUri(base_url() . "index.php/Ctrl_tform/callback");
    $client->addScope("email");
    $client->addScope("profile");
    $loginurl = $client->createAuthUrl();
?>