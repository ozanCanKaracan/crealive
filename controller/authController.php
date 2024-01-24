<?php
include "../include/config.php";

$auth = new User();

if (isset($_POST["register"])) {
    $name = C($_POST["name"]);
    $phone = C($_POST["phone"]);
    $email = C($_POST["mail"]);
    $emailConfirmation = C($_POST["mail2"]);
    $lang = C($_POST["selectLang"]);
    $pass = C($_POST["pass"]);
    $passConfirmation = C($_POST["pass2"]);
    $encryptedPass = md5(sha1(md5($pass)));
    $controlEmail = $auth->controlEmail($email);
    $controlPhone = $auth->controlPhone($phone);
    if ($controlEmail) {
        echo "email";
    } elseif ($controlPhone) {
        echo "phone";
    }
    elseif (empty($name) || empty($phone) || empty($email) || empty($emailConfirmation) || empty($lang) || empty($pass) || empty($passConfirmation)) {
        echo "bos";
    }  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "mail";
    } elseif ($email !== $emailConfirmation) {
        echo "mail2";
    }elseif (strlen($pass) < 3) {
        echo "pass";
    } elseif ($pass !== $passConfirmation) {
        echo "pass";
    } else {
        $add = $auth->addUser($name, $lang, $phone, $email, $encryptedPass);
        echo "ok";
    }
}
if (isset($_POST["login"])) {
    $email = C($_POST["email"]);
    $password = C($_POST["password"]);
    $encryptedPass = md5(sha1(md5($password)));

    $login = $auth->login($email, $encryptedPass);
    if (!$email || !$password) {
        echo "bos";
    } else if ($login) {
        $_SESSION["user"] = $login->id;
        $_SESSION["role_id"] = $login->role_id;
        echo "ok";
        exit();
    } else {
        echo "hata";
    }
}
if (isset($_POST["logout"])) {
    session_unset();
    echo "ok";
    exit();
}
if (isset($_POST["sidebarAjax"])) {
    $role_id = $_SESSION["role_id"];
    $language = $_SESSION["lang"];
    $languageID = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$language]);
    $response = '
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="navigation-header">
                <span data-i18n="Apps &amp; Pages">Sayfalar</span><i data-feather="more-horizontal"></i>
            </li>';

    $getTitle = DB::get("SELECT * FROM pages WHERE parent_id = 0");
    foreach ($getTitle as $gt) {
        $getPages = DB::get("SELECT * FROM pages WHERE parent_id = ? AND `property` != '0' ", [$gt->id]);

        $pageName = $gt->page_name;
        $translate = (language($pageName)) ? language($pageName) : $pageName;

        $response .= '
            <li class="nav-item nav-group-children">
                <a class="d-flex align-items-center">
                    <i class="' . $gt->page_icon . ' mb-1"></i>
                    <span class="menu-title text-truncate" data-i18n="Invoice">' . $translate . '</span>
                </a>
                <ul class="menu-content">';

        foreach ($getPages as $gp) {
            $pageName = $gp->page_name;
            $translate = (language($pageName)) ? language($pageName) : $pageName;
            $id = $gp->id;
            $controlView = controlView($id);
            $addID = DB::getVar("SELECT parent_id FROM pages WHERE property = 'add' ");
            $control = controlFunction($addID, $languageID, $role_id);
            if ($controlView && ($gp->property != 'add' || ($gp->property == 'add' AND $control))) {
                $response .= '
                    <li>
                        <a class="router-link-active router-link-exact-active" href="' . $gp->href . '">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="List">' . $translate . '</span>
                        </a>
                    </li>';
            }
        }
        $response .= '
                </ul>
            </li>';
    }
    $response .= '
        </ul>';
    echo $response;
    exit;
}