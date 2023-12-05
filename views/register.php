<!DOCTYPE html>
<html class="loading" lang="tr" data-textdirection="ltr">

<head>
    <?php include "partials/head.php" ?>

</head>

<body class="horizontal-layout horizontal-menu blank-page navbar-floating footer-static" data-open="hover"
      data-menu="horizontal-menu" data-col="blank-page">
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="auth-wrapper auth-v2">
                <div class="auth-inner row m-0">

                    <!-- Left Text-->
                    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img
                                    class="img-fluid" src="app-assets/images/pages/register-v2.svg" alt="Register V2"/>
                        </div>
                    </div>
                    <!-- /Left Text-->
                    <!-- Register-->
                    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                            <h2 class="card-title font-weight-bold mb-1">Adventure starts here 🚀</h2>
                            <p class="card-text mb-2">Make your app management easy and fun!</p>
                            <form class="auth-register-form mt-2" method="POST" id="registerForm">
                                <div class="form-group">
                                    <label class="form-label" for="register-username">Ad Soyad</label>
                                    <input class="form-control" id="name" type="text" name="name" placeholder="example"
                                           aria-describedby="register-username" autofocus="" tabindex="1"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="register-email">Telefon numarası</label>
                                    <input class="form-control" id="phone" type="text" name="phone"
                                           placeholder="__________" aria-describedby="register-phone"
                                           tabindex="2" maxlength="10"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="register-email">Email</label>
                                    <input class="form-control" id="email" type="text" name="email"
                                           placeholder="john@example.com" aria-describedby="register-email"
                                           tabindex="2"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="register-email">Email Tekrar</label>
                                    <input class="form-control" id="email2" type="text" name="email2"
                                           placeholder="john@example.com" aria-describedby="register-email"
                                           tabindex="2"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="register-password">Şifre</label>
                                    <input class="form-control form-control-merge" id="password" type="password"
                                           name="password" placeholder="············"
                                           aria-describedby="register-password" tabindex="3"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="register-password">Şifre Tekrar</label>
                                    <input class="form-control form-control-merge" id="password2" type="password"
                                           name="password2" placeholder="············"
                                           aria-describedby="register-password" tabindex="3"/>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit" onclick="register()">Kayıt
                                        Ol
                                    </button>
                                </div>

                                <p class="text-center mt-2"><span>Zaten hesabınız var mı?</span><a href=""><span>&nbsp;Giriş Yapın</span></a>
                                </p>
                            </form>
                        </div>
                        <!-- /Register-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <script>
        $(window).on('load', function () {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
</html>
<script src="assets/js/modules/auth.js"></script>
