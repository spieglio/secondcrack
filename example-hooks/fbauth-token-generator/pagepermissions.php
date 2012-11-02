<?php
//-- Facebook API --//
//-- https://github.com/facebook/facebook-php-sdk --//
require_once 'facebook-php-sdk/src/facebook.php';

//-- App Information --//
$app_id     = '132752243539886';
$app_secret = '1f42faab074130d83a240fb7000120bd';

// Create Facebook Instance
$facebook = new Facebook(array(
    'appId' => $app_id,
    'secret' => $app_secret,
    'cookie' => true
));

//-- To Facebook (Notice we ask for offline access) --//
if (empty($_REQUEST))
{
    $loginUrl = $facebook->getLoginUrl(array(
        'canvas' => 1,
        'fbconnect' => 0,
        'scope' => 'manage_pages,offline_access,publish_stream'
    ));
    header('Location:'.$loginUrl );
}
//-- From Facebook --//
else
{
    $user = $facebook->getUser();
    if($user)
    {
        $access_token = $facebook->getAccessToken();
        echo "Your access token is: <br><br>$access_token";
    }
}
?>