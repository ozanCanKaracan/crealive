<?php

if (!$_GET) {
    include('views/index.php');
} else {

    switch (@$_GET['target']) {

        case '' :
            include('views/index.php');
            break;
        case 'roles' :
            $access = access($_GET["target"]);

            if ($access) {
                include('views/roles/roles.php');
                break;
            } else {
                include('views/404/404.php');
                break;
            }
        case 'editRole' :
            $access = access($_GET["target"]);

            if ($access) {
                include('views/roles/editRole.php');
                break;
            } else {
                include('views/404/404.php');
                break;
            }
        case 'userlistRole' :
            $access = access($_GET["target"]);
            if ($access) {
                include('views/roles/userlistRole.php');
                break;
            } else {
                include('views/404/404.php');
                break;
            }

        case 'newContent' :
            $access = access($_GET["target"]);

            if ($access) {
                include('views/content/newContent.php');
                break;
            } else {
                include('views/404/404.php');
                break;
            }
        case 'editCategory' :
            $access = access($_GET["target"]);

            if ($access) {
                include('views/category/editCategory.php');
                break;
            } else {
                include('views/404/404.php');
                break;
            }
        case 'permission' :
            $access = access($_GET["target"]);
            if ($access) {
                include('views/permission/permission.php');
                break;
            } else {
                include('views/404/404.php');
                break;
            }

        case 'contents' :
            $access = access($_GET["target"]);
            if ($access) {
                include('views/content/contents.php');
                break;
            } else {
                include('views/404/404.php');
                break;
            }

        case 'editContent' :
            $access = languageAcces();
            if ($access) {
                include('views/content/editContent.php');
                break;
            } else {
                include('views/404/404.php');
                break;
            }
    }
}
//	 include('views/index.php');
//}else{
//    if( file_exists("views/{$_GET['target']}.php")){
//        include ("views/{$_GET['target']}.php");
//    }else{
//        include('views/404/404.php');
//    }
//}