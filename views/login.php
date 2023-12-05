<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="tr" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <?php include "partials/head.php"; ?>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" data-open="click"
      data-menu="vertical-menu-modern" data-col="blank-page">
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="auth-wrapper auth-cover">
                <div class="auth-inner row m-0">
                    <!-- Brand logo-->

                    <!-- /Brand logo-->
                    <!-- Left Text-->
                    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img
                                    class="img-fluid" src="app-assets/images/pages/login-v2.svg" alt="Login V2"/></div>
                    </div>
                    <!-- /Left Text-->
                    <!-- Login-->
                    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                            <h2 class="card-title fw-bold mb-1">Hoş geldin 👋</h2>
                            <p class="card-text mb-2">Lütfen giriş yap ve kullanmaya başla !</p>
                            <form class="auth-login-form mt-2" action="" method="POST" id="loginForm">
                                <div class="mb-1">
                                    <label class="form-label" for="login-email">Email</label>
                                    <input class="form-control" id="email" type="text" name="email"
                                           placeholder="john@example.com" aria-describedby="login-email" autofocus=""
                                           tabindex="1"/>
                                </div>
                                <div class="mb-1">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="login-password">Password</label>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input class="form-control form-control-merge" id="password" type="password"
                                               name="password" placeholder="············"
                                               aria-describedby="login-password" tabindex="2"/>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100" tabindex="4" onclick="login()">Giriş
                                    Yap
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- /Login-->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END: Content-->

<script>
    $(document).ready(function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    });
</script>

</body>
<!-- END: Body-->

</html>
<script src="assets/js/modules/auth.js"></script>

