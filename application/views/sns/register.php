<div class="container">

    <?
    if($sns_type == "google") {
        $callout_class = "danger";
        $tit = "<span class='fa fa-google-plus'></span> Google+ ";
        $token = json_decode($_SESSION['token']);
        $token = $token->access_token;
    }else if($sns_type == "facebook") {
        $callout_class = "primary";
        $tit = "<span class='fa fa-facebook'></span> Facebook ";
        // 677307052306629 ===> facebook App ID
        $token = $_SESSION['fb_677307052306629_access_token'];
    }else if($sns_type == "twitter") {
        $callout_class = "info";
        $tit = "<span class='fa fa-twitter'></span> Twitter ";
        $token = $_SESSION['access_token'];
        $token = $token['oauth_token'];
    }else if($sns_type == "kakao") {
        $callout_class = "kakao";
        $tit = "<span class='fa fa-comment'></span> Kakao ";
        $token = $_SESSION['kakao_token'];
    }else {
        $callout_class = "default";
        $tit = "<i class='glyphicon glyphicon-user'></i> Local ";
    }
    ?>

    <div class="bs-callout bs-callout-<?=$callout_class?>" style="margin:0 auto; max-width:800px; margin-top:50px; padding:15px;">
        <h4><?=$tit?></h4>

        <p style="margin-top:15px; line-height:25px; word-break:break-all;">
            <?if($sns_type == "local") :?>
            Sign in Local member!
            <?else:?>
            <code>id :</code> <?=$sns_id?><br/>
            <code>token :</code> <?=$token?><br/>
            <code>email :</code> <?=isset($email)?$email:''?><br/>
            <code>name :</code> <?=$name?><br/>
            <code>profile_img :</code> <?=$profile_img?><br/>
            <?endif;?>
        </p>
    </div>


    <div class="alert alert-success" style="margin:0 auto; max-width:380px; margin-top:50px; padding:15px;">
        <form role="form" data-toggle="validator" style="max-width:330px; padding:15px; margin:0 auto;" method="post" action="/login/register_action">

            <input type="text" id="userid" name="userid" class="form-control" placeholder="User ID" required autofocus value="<?=isset($userid)?$userid:""?>" style="margin-top:5px;">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" data-error="That email address is invalid" required value="<?=isset($email)?$email:""?>" style="margin-top:5px;">

            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required data-toggle="validator" style="margin-top:5px;">
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" data-match="#password" required data-error="These don't match" style="margin-top:5px;">
                <div class="help-block with-errors"></div>
            </div>

            <button type="submit" class="btn btn-lg btn-primary" style="margin-top:15px; width:100%;" disabled >Register</button>

        </form>
    </div>

</div> <!-- /container -->


