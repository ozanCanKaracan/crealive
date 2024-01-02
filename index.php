<?php
include "include/config.php";
$hash=md5_file(__FILE__);
header('Set-Cookie: name='.$hash.' ');
var_dump($_SERVER['HTTP_IF_NONE_MATCH']);


if (isset($_SESSION['user'])) {
    ?>
    <!DOCTYPE html>
    <html class="" lang="tr" data-layout="semi-dark-layout" data-textdirection="ltr">

    <head>
        <?php include "views/partials/head.php"; ?>
    </head>

    <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
          data-menu="vertical-menu-modern" data-col="">
    <?php include "views/partials/sidebar.php"; ?>
    <?php include "views/partials/header.php"; ?>
    <div class="app-content content ">
        <?php include "get.php"; ?>
    </div>
    <?php include "views/partials/footer.php"; ?>

    </body>

    </html>
    <?php
}else if(@$_GET["target"]== "login"){
    include "views/login.php";
}else if(@$_GET["target"]== "register"){
    include "views/register.php";
}else {
    include "views/login.php";
}
?>
