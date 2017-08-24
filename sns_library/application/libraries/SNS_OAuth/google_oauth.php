<?

// Generate Your Key =>  https://code.google.com/apis/console/
$google_ApplicationName = 'INPUT YOUR PROJECT NAME';
$google_client_id       = 'INPUT YOUR CLIENT ID';
$google_client_secret   = 'INPUT YOUR CLIENT SCRET';
$google_redirect_url    = 'http://YOUR DOMAIN/login/google_login_action';
$google_developer_key   = 'INPUT YOUR API KEY';


include_once realpath(dirname(__FILE__).'/../../../assets/lib/SNS_Login/google/src/').'/Google_Client.php';
include_once realpath(dirname(__FILE__).'/../../../assets/lib/SNS_Login/google/src/').'/contrib/Google_Oauth2Service.php';


$gClient = new Google_Client();
$gClient->setApplicationName($google_ApplicationName);
$gClient->setClientId($google_client_id);
$gClient->setClientSecret($google_client_secret);
$gClient->setRedirectUri($google_redirect_url);
$gClient->setDeveloperKey($google_developer_key);
        
$google_oauthV2 = new Google_Oauth2Service($gClient);
?>
