<?
// Generate Your App Key => https://developers.facebook.com/apps
$appid = 'INPUT YOUR APPID';
$secret = 'INPUT YOUR APP SECRET';
$fb['login_ck'] = 'http://YOUR DOMAIN/login/facebook_login_action';

include_once realpath(dirname(__FILE__).'/../../../assets/lib/SNS_Login/facebook/src/').'/facebook.php';

$facebook = new Facebook(array(
    'appId'  => $appid,
    'secret' => $secret,
));
?>
