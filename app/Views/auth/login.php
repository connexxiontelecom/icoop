<!doctype html>
<html lang="en">

<head>
    <title>ICOOP | Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Qubes Bootstrap 4x admin is super flexible, powerful, clean &amp; modern responsive admin dashboard with unlimited possibilities.">
    <meta name="author" content="GetBootstrap, design by: puffintheme.com">

    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/vendor/animate-css/vivify.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/assets/css/site.min.css">

</head>

<body class="theme-blue">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><i class="fa fa-cube font-25"></i></div>
        <p>Please wait...</p>
    </div>
</div>
<!-- Overlay For Sidebars -->

<div class="auth-main">
    <div class="auth_div">
        <div class="card">
            <div class="auth_brand">
                <a class="navbar-brand" href="javascript:void(0);"><i class="fa fa-cube font-25"></i> iCoop</a>
            </div>
            <div class="body">
                <p class="lead">Login to your account</p>

                <?php if(isset($validation)) : ?>
                    <div class="text-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif ?>

                <form class="form-auth-small m-t-20" method="post" action=" ">
                    <div class="form-group">
                        <label for="signin-email" class="control-label sr-only">Email</label>
                        <input type="email" name="email" value="<?= set_value('email') ?>"  class="form-control round" id="signin-email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="signin-password" class="control-label sr-only">Password</label>
                        <input type="password" name="password" class="form-control round" id="signin-password"  placeholder="Password">
                    </div>
                    <?= csrf_field() ?>
                    <div class="form-group clearfix">
                        <label class="fancy-checkbox element-left">
                            <input type="checkbox">
                            <span>Remember me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-round btn-block">LOGIN</button>
                    <div class="bottom">
                        <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="#">Forgot password?</a></span>
                        <span>Don't have an account? <a href="#">Register</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="auth_right">
        <div id="slider2" class="carousel slide" data-ride="carousel" data-interval="3000">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner pb-5">
                <div class="carousel-item active">
                    <img src="/assets/images/login-slide1.png" class="img-fluid" alt="login page" />
                    <div class="px-4">
                        <h2>Highly Customizable</h2>
                        <p>Cooperative Automation to Suit your Needs</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/assets/images/login-slide2.png" class="img-fluid" alt="login page" />
                    <div class="px-4">
                        <h2>100% Secure</h2>
                        <p>Deployed with best Technology and Practices</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/assets/images/login-slide2.png" class="img-fluid" alt="login page" />
                    <div class="px-4">
                        <h2>Saving Time</h2>
                        <p>Save as much time as you can.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END WRAPPER -->

<!-- Latest jQuery -->
<script src="/assets/vendor/jquery/jquery-3.3.1.min.js"></script>

<!-- Bootstrap 4x JS  -->
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="/assets/bundles/vendorscripts.bundle.js"></script>
<script src="/assets/js/common.js"></script>
</body>
</html>

