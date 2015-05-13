<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>iAdmin Panel</title>
    <base href="<?=SITE_URL; ?>">
    <link rel="shortcut icon" href="<?=SITE_IMAGE; ?>favicon.ico" type="image/x-icon" />
    <link href='http://fonts.googleapis.com/css?family=Ropa+Sans|Roboto|Source+Sans+Pro:900italic,400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" media="all" href="<?=SITE_CSS; ?>bootstrap.css">
    <link rel="stylesheet" type="text/css" media="all" href="<?=SITE_CSS; ?>style.css">
</head>
<body id="login-bg">
<!-- Start: login-holder -->
<div id="login-holder">
    <!-- start logo -->
    <div id="logo-login">
        <!-- a href="./"><img src="<?=SITE_IMAGE . 'cms/logo-xcms.png'; ?>" /></a -->
    </div>
    <!-- end logo -->
    <div class="clear"></div>
    <!--  start loginbox ................................................................................. -->
    <div id="loginbox">
        <!--  start login-inner -->
        <div id="login-inner">
            <form method="post" action="<?=SITE_URL.'/index/login/'; ?>" id="loginForm" name="loginForm">
                <input type="hidden" name="mm_action" id="mm_action" value="doLogin" />
                <input type="hidden" name="form_action" value="doLogin" />
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <th>Username</th>
                        <td><input type="text" class="login-inp" name="username" id="username" required /></td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td><input type="password" class="login-inp" name="password" id="password" required/></td>
                    </tr>
                    <!--tr>
                        <th></th>
                        <td valign="top"><input type="checkbox" class="checkbox-size" id="login-check" /><label class="login-check" for="login-check">Remember me</label></td>
                    </tr-->
                    <tr>
                        <th></th>
                        <td><input type="submit" class="submit-login"  /></td>
                    </tr>
                </table>
            </form>
            <div><?php echo $message; ?></div>
        </div>
        <!--  end login-inner -->
        <div class="clear"></div>
        <!--a href="" class="forgot-pwd">Forgot Password?</a -->
    </div>
    <!--  end loginbox -->
</div>
<!-- End: login-holder -->

<!-- include all js files -->
<script src="<?=SITE_JS; ?>jquery.1.10.2.min.js" type="text/javascript" ></script>
<script src="<?=SITE_JS; ?>bootstrap.js" type="text/javascript"></script>
<script src="<?=SITE_JS; ?>social.js" type="text/javascript"></script>
<script src="<?=SITE_JS; ?>functions.js" type="text/javascript"></script>
<script src="<?=SITE_JS; ?>html5shiv.js" type="text/javascript"></script>
<script src="<?=SITE_JS; ?>pngfix.js" type="text/javascript"></script>
</body>
</html>