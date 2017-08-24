# README #

This README would normally document whatever steps are necessary to get your application up and running. Setting your files.

### Facebook ###

*file : /_application/libraries/SNS_OAuth/facebook_oauth.php*
 
* $appid = 'INPUT YOUR APPID';
* $secret = 'INPUT YOUR APP SECRET';
* $fb['login_ck'] = 'YOUR DOMAIN/login/facebook_login_action';


### Google ###

*file : /_application/libraries/SNS_OAuth/google_oauth.php*
 
* $google_ApplicationName = 'INPUT YOUR PROJECT NAME';
* $google_client_id       = 'INPUT YOUR CLIENT ID';
* $google_client_secret   = 'INPUT YOUR CLIENT SCRET';
* $google_redirect_url    = 'YOUR DOMAIN/login/google_login_action';
* $google_developer_key   = 'INPUT YOUR API KEY';

### Twitter ###

*file : /_application/libraries/SNS_OAuth/twitter_oauth.php*
 
* define("CONSUMER_KEY", "INPUT YOUR APIKEY");
* define("CONSUMER_SECRET", "INPUT YOUR API SCRET");
* define("OAUTH_CALLBACK", "YOUR DOMAIN/login/twitter_login_action");

 
### Kakao ###

*file : /_application/libraries/SNS_OAuth/kakao_oauth.php*
 
* $kakao_api = 'INPUY YOUR APIKEY';
* $kakao_redirect = 'http://auth.joong.co.kr/login/kakao_login_action';


# DEMO #
http://auth.joong.co.kr/
![login.png](https://bitbucket.org/repo/yMxpzE/images/562792154-login.png)