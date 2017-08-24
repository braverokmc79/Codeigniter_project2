<?
// GENERATE KEY => https://dev.twitter.com/
define("CONSUMER_KEY", "INPUT YOUR APIKEY");
define("CONSUMER_SECRET", "INPUT YOUR API SCRET");
define("OAUTH_CALLBACK", "http://YOUR DOMAIN/login/twitter_login_action");

include_once realpath(dirname(__FILE__).'/../../../assets/lib/SNS_Login/twitter/twitteroauth/').'/twitteroauth.php';
?>
