<?php
    require_once 'assets/plugins/google-login-api/vendor/autoload.php';
    require_once 'partials/config.php';

    $client = new Google_Client();
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($recirect_url);
    $client->addScope("email");
    $client->addScope("profile");

    if(isset($_GET['code']))
    {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);    

        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email = $google_account_info->email;
        $name = $google_account_info->name;    

        echo $email .'<br>';
        echo $name ;
    
    } 
?> 