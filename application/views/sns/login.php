<div class="container">

    <div class="alert alert-success" style="margin:0 auto; max-width:380px; margin-top:50px; padding:15px;">
        <form role="form" style="max-width:330px; padding:15px; margin:0 auto;" method="post" action="/login/login_action">
            <input type="text" name="userid" class="form-control" placeholder="User ID" required autofocus>
            <input type="password" name="password" class="form-control" placeholder="Password" required style="margin-top:5px;">
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

            <a href="/login/register" class="btn btn-block btn-social btn-reddit">
                <i class="glyphicon glyphicon-user"></i> Sign up with Local
            </a>

            <div style="margin-top:20px; padding-top:10px; border-top:1px solid #b2dba1;">
                <?=$btn_gg_login?>
                <?=$btn_fb_login?>
                <?=$btn_tw_login?>
                <?=$btn_kk_login?>
            </div>
        </form>
    </div>

</div> <!-- /container -->

