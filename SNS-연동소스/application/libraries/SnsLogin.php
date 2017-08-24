<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class SnsLogin{

    private $ci;


	public function __construct() {
         $this->ci = &get_instance();
    }

    
    
    public function facebook_login() {

        include_once realpath(dirname(__FILE__)).'/SNS_OAuth/facebook_oauth.php';

        $user = $facebook->getUser();

        if ($user) {
            try {
                $facebook_data = $facebook->api('/me');
            } catch (FacebookApiException $e) {
                error_log($e);
                $user = null;
            }
        }

        if ($user) {
            $fb_button_url = $facebook->getLogoutUrl();
            // goto. menu

        } else {
            $params = array(
                'scope' => 'read_stream, friends_likes',
                'redirect_uri' => $fb['login_ck']
            );
            $fb_button_url = $facebook->getLoginUrl($params);
        }

        $ButtonHTML = "<a href='".$fb_button_url."' class='btn btn-block btn-social btn-facebook'>";
        $ButtonHTML .= "<i class='fa fa-facebook'></i>Sign in with Facebook</a>";

        return $ButtonHTML;
    }



    public function twitter_login() {

        include_once realpath(dirname(__FILE__)).'/SNS_OAuth/twitter_oauth.php';

        if (empty($_SESSION['access_token']) 
            || empty($_SESSION['access_token']['oauth_token']) 
            || empty($_SESSION['access_token']['oauth_token_secret'])) {


            if (CONSUMER_KEY === '' || CONSUMER_SECRET === '') {
                echo 'You need a consumer key and secret to test the sample code.';
                exit;
            }

            $tw_button_url = "/login/twitter_redirect";

        }else {
            $access_token = $_SESSION['access_token'];
            $connection = new TwitterOAuth(
                CONSUMER_KEY, 
                CONSUMER_SECRET, 
                $access_token['oauth_token'], 
                $access_token['oauth_token_secret']);

            $content = $connection->get('account/verify_credentials');
            $tw_button_url = "/login/menu";
        }

        $ButtonHTML = "<a href='".$tw_button_url."' class='btn btn-block btn-social btn-twitter'>";
        $ButtonHTML .= "<i class='fa fa-twitter'></i>Sign in with Twitter</a>";

        return $ButtonHTML;
    }



    public function google_login() {

        include_once realpath(dirname(__FILE__)).'/SNS_OAuth/google_oauth.php';
        
        if (isset($_SESSION['token'])) { 
            $gClient->setAccessToken($_SESSION['token']);
        }


        if ($gClient->getAccessToken()) {
            //Get user details if user is logged in
            $user 				= $google_oauthV2->userinfo->get();
            $user_id 		    = $user['id'];
            $user_name 			= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
            $email 				= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
            $profile_url 		= filter_var($user['link'], FILTER_VALIDATE_URL);
            $profile_image_url 	= filter_var($user['picture'], FILTER_VALIDATE_URL);
            $personMarkup 		= "$email<div><img src='$profile_image_url?sz=50'></div>";
            $_SESSION['token'] 	= $gClient->getAccessToken();

        }else {
            //get google login url
            $authUrl = $gClient->createAuthUrl();
        }


        //user is not logged in, show login button
        if(isset($authUrl)) {
            $gg_button_url = $authUrl;
        // user logged in
        } else {
            $gg_button_url = "/login/menu";
        }

        $ButtonHTML = "<a href='".$gg_button_url."' class='btn btn-block btn-social btn-google-plus'>";
        $ButtonHTML .= "<i class='fa fa-google-plus'></i>Sign in with Google</a>";

        return $ButtonHTML;
    }



    public function kakao_login() {

        include_once realpath(dirname(__FILE__)).'/SNS_OAuth/kakao_oauth.php';

        $btn_url = 'https://kauth.kakao.com/oauth/authorize';
        $btn_url .= '?client_id='.$kakao_api.'&redirect_uri='.$kakao_redirect.'&response_type=code';

        $ButtonHTML = "<a href='".$btn_url."' class='btn btn-block btn-social btn-kakao'>";
        $ButtonHTML .= "<i class='fa fa-comment'></i>Sign in with Kakao</a>";

        return $ButtonHTML;
    }
}
