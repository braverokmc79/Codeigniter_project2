<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {


    function __construct() {
        parent::__construct();
        $this->load->library(array('script', 'common', 'session'));

        //session_start();
    }       
   


    // Member Login Veiw Page
    public function index() {
        session_destroy();
        $this->load->library('SnsLogin');

        $assign_data['btn_gg_login'] = $this->snslogin->google_login();
        $assign_data['btn_fb_login'] = $this->snslogin->facebook_login();
        $assign_data['btn_tw_login'] = $this->snslogin->twitter_login();
        $assign_data['btn_kk_login'] = $this->snslogin->kakao_login();
        
        $this->_view('sns/login', $assign_data);
    } 



    // Member Register View Page
    public function register() {

        $post_data = $this->input->post();

        $assign_data['sns_id'] = $post_data['sns_id'];
        $assign_data['sns_type'] = isset($post_data['sns_type'])?$post_data['sns_type']:"local";
        $assign_data['profile_img'] = $post_data['profile_img'];
        $assign_data['name'] =  $post_data['name'];

        if(isset($post_data['email'])) {
            $assign_data['email'] =  $post_data['email'];
            $tmp_data = explode("@", $post_data['email']);
            $assign_data['userid'] = $tmp_data[0];  
        }

        if(isset($post_data['screen_name'])) {
            $assign_data['userid'] = $post_data['screen_name'];  
        }

		$this->_view('sns/register', $assign_data);
    }


    
    // Register Action Process
    public function register_action() {
        
        // Member Register in Your Code.
        echo "Member DB Table Register In Code.";

    }

 
 
    // Google Login Action Process
    public function google_login_action() {

        if (isset($_GET['code'])) { 

            $this->load->library('SnsLogin');

            require_once realpath(dirname(__FILE__).'/../libraries/SNS_OAuth/').'/google_oauth.php';

            $gClient->authenticate($_GET['code']);
            $_SESSION['token'] = $gClient->getAccessToken();

            if ($gClient->getAccessToken()) {
                $user               = $google_oauthV2->userinfo->get();
                $user_id            = $user['id'];
                $user_name          = filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
                $email              = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
                $profile_url        = filter_var($user['link'], FILTER_VALIDATE_URL);
                $profile_image_url  = filter_var($user['picture'], FILTER_VALIDATE_URL);
                $personMarkup       = "$email<div><img src='$profile_image_url?sz=50'></div>";
                $_SESSION['token']  = $gClient->getAccessToken();

                
                // Add Code :: Valid Member
                // if exists member -> go main
                    
                echo "<form method='post' name='submit_form' action='/login/register'>";
                echo "<input type='hidden' name='sns_id' value='".$user_id."'>";
                echo "<input type='hidden' name='sns_type' value='google'>";
                echo "<input type='hidden' name='name' value='".$user_name."'>";
                echo "<input type='hidden' name='email' value='".$email."'>";
                echo "<input type='hidden' name='profile_img' value='".$profile_image_url."'>";
                echo "</form>";
                echo "<script>document.submit_form.submit();</script>";

            }else {
                $this->script->alert("Google Token Access Fail.");
                $this->script->locationhref('sns/login');
            }
        }else {
            $this->script->alert("Invailed Access.");
            $this->script->locationhref('sns/login');
        }
    }




    // Facebook Login Action Process
    public function facebook_login_action() {

        require_once realpath(dirname(__FILE__).'/../libraries/SNS_OAuth/').'/facebook_oauth.php';

        $user = $facebook->getUser();
        if ($user) {
            try {
                $facebook_data = $facebook->api('/me');
            } catch (FacebookApiException $e) {
                error_log($e);
                $user = null;
            }
        }

        if ($user){

            // Add Code :: Valid Member
            // if exists member -> go main
             
            $profile_img = "http://graph.facebook.com/".$facebook_data['id']."/picture?type=square";

            echo "<form method='post' name='submit_form' action='/login/register'>";
            echo "<input type='hidden' name='sns_id' value='".$facebook_data['id']."'>";
            echo "<input type='hidden' name='sns_type' value='facebook'>";
            echo "<input type='hidden' name='name' value='".$facebook_data['name']."'>";
            echo "<input type='hidden' name='profile_img' value='".$profile_img."'>";
            echo "</form>";
            echo "<script>document.submit_form.submit();</script>";

        }else{
            $this->script->alert("Invailed Access.");
            $this->script->locationhref('sns/login');
        
        }
    }



    // Twitter Redirect URL
    public function twitter_redirect() {
        
        require_once realpath(dirname(__FILE__).'/../libraries/SNS_OAuth/').'/twitter_oauth.php';

        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
        $request_token = $connection->getRequestToken(OAUTH_CALLBACK);

        $_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
         
        switch ($connection->http_code) {
            case 200:
                $url = $connection->getAuthorizeURL($token);
                header('Location: ' . $url); 
                break;
            default:
                echo 'Could not connect to Twitter. Refresh the page or try again later.';
        }
    }


    // Twitter Login Action Process
    public function twitter_login_action() {

        require_once realpath(dirname(__FILE__).'/../libraries/SNS_OAuth/').'/twitter_oauth.php';

        if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
            $this->script->alert("Invalid OAuth Token.");
            $this->script->locationhref('sns/login');
        }

        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
        $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

        $_SESSION['access_token'] = $access_token;

        unset($_SESSION['oauth_token']);
        unset($_SESSION['oauth_token_secret']);

        if (200 == $connection->http_code) {

            $_SESSION['status'] = 'verified';

            $content = $connection->get('account/verify_credentials');

            // Add Code :: Valid Member
            // if exists member -> go main
        
            echo "<form method='post' name='submit_form' action='/login/register'>";
            echo "<input type='hidden' name='sns_id' value='".$content->id."'>";
            echo "<input type='hidden' name='sns_type' value='twitter'>";
            echo "<input type='hidden' name='name' value='".$content->name."'>";
            echo "<input type='hidden' name='screen_name' value='".$content->screen_name."'>";
            echo "<input type='hidden' name='profile_img' value='".$content->profile_image_url."'>";
            echo "</form>";
            echo "<script>document.submit_form.submit();</script>";

        } else {
            $this->script->alert("Invailed Access.");
            $this->script->locationhref('sns/login');
        }
    }


    public function kakao_login_action() {

        if (isset($_GET['code'])) {

            require_once realpath(dirname(__FILE__).'/../libraries/SNS_OAuth/').'/kakao_oauth.php';

            $url = "https://kauth.kakao.com/oauth/token";
            
            $param = "grant_type=authorization_code";
            $param .= "&client_id=".$kakao_api;
            $param .= "&redirect_url=".$kakao_redirect;
            $param .= "&code=".$_GET['code'];

            // Get Aeccess Token Value
            $auth_data = $this->common->restful_curl($url, $param, 'POST');
            $auth_data = json_decode($auth_data);

            if($auth_data->access_token) {

                $_SESSION['kakao_token'] = $auth_data->access_token;
                
                $url = "https://kapi.kakao.com/v1/user/me";
                $param = "";
                $header = array("Authorization: Bearer " .$auth_data->access_token);


                // Get User Info
                $user_data = $this->common->restful_curl($url, $param, 'POST', $header);
                $user_data = json_decode($user_data);
                $properties = $user_data->properties;


                // Add Code :: Valid Member
                // if exists member -> go main
                echo "<form method='post' name='submit_form' action='/login/register'>";
                echo "<input type='hidden' name='sns_id' value='".$user_data->id."'>";
                echo "<input type='hidden' name='sns_type' value='kakao'>";
                echo "<input type='hidden' name='name' value='".$properties->nickname."'>";
                echo "<input type='hidden' name='profile_img' value='".$properties->thumbnail_image."'>";
                echo "</form>";
                echo "<script>document.submit_form.submit();</script>";

            }else {
                $this->script->alert("Kakao Token Access Fail.");
                $this->script->locationhref('sns/login');
            }

        }else {
            $this->script->alert("Invailed Access.");
            $this->script->locationhref('sns/login');
        } 
    }

 
    // View Router 
	public function _view($view_name, $data=array()) {

		$this->load->view('sns/inc_header');
		$this->load->view($view_name, $data);
		$this->load->view('sns/inc_footer');
	}
}


/*README

sns 연동시 수정 사항

This README would normally document whatever steps are necessary to get your application up and running. Setting your files.


Facebook
file : /_application/libraries/SNS_OAuth/facebook_oauth.php
$appid = 'INPUT YOUR APPID';
$secret = 'INPUT YOUR APP SECRET';
$fb['login_ck'] = 'YOUR DOMAIN/login/facebook_login_action';


Google
file : /_application/libraries/SNS_OAuth/google_oauth.php
$google_ApplicationName = 'INPUT YOUR PROJECT NAME';
$google_client_id = 'INPUT YOUR CLIENT ID';
$google_client_secret = 'INPUT YOUR CLIENT SCRET';
$google_redirect_url = 'YOUR DOMAIN/login/google_login_action';
$google_developer_key = 'INPUT YOUR API KEY';


Twitter
file : /_application/libraries/SNS_OAuth/twitter_oauth.php
define("CONSUMER_KEY", "INPUT YOUR APIKEY");
define("CONSUMER_SECRET", "INPUT YOUR API SCRET");
define("OAUTH_CALLBACK", "YOUR DOMAIN/login/twitter_login_action");


Kakao
file : /_application/libraries/SNS_OAuth/kakao_oauth.php
$kakao_api = 'INPUY YOUR APIKEY';
$kakao_redirect = 'http://auth.joong.co.kr/login/kakao_login_action';*/