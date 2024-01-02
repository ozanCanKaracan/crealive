<?php
include "../include/config.php";

$auth = new User();

if (isset($_POST["register"])) {
    $name = C($_POST["name"]);
    $phone = C($_POST["phone"]);
    $email = C($_POST["mail"]);
    $email2 = C($_POST["mail2"]);
    $lang = C($_POST["selectLang"]);
    $pass = C($_POST["pass"]);
    $pass2 = C($_POST["pass2"]);
    $encryptedPass = md5(sha1(md5($pass)));
    $controlEmail = $auth->controlEmail($email);
    $controlPhone = $auth->controlPhone($phone);
    if (!$name || !$phone || !$email || !$email2 || !$lang || !$pass || !$pass2) {
        echo "bos";
    } else if ($controlPhone) {
        echo "phone";
    } else if ($email != $email2) {
        echo "mail2";
    } else if ($controlEmail) {
        echo "mail";
    } else if ($pass != $pass2) {
        echo "pass";
    } else {
        $add = $auth->addUser($name, $lang, $phone, $email2, $encryptedPass);
        echo "ok";
        exit();
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
if (isset($_POST["selectLanguage"])) {
    if ($_GET['lang']) {
        $selectedLanguage = $_GET['lang'];
        $_SESSION['lang'] = $selectedLanguage;
    } elseif ($_SESSION['lang']) {
        //url'de yoksa sessionda var ise bunu çallıştır
        $selectedLanguage = $_SESSION['lang'];
    } else {
        // kullanıcı tarayıcı dili
        $browserLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $result = substr($browserLanguage, 0, 2);
        $selectedLanguage = DB::getVar("SELECT lang_name_short FROM languages WHERE lang_name_short=?", [$result]);
        $_SESSION['lang'] = $selectedLanguage;

    }
    $fullName = DB::getVar("SELECT lang_name FROM languages WHERE lang_name_short=?", [$selectedLanguage]);
    $translate = (language($fullName)) ? language($fullName) : $fullName;
    $allLanguages = DB::get("SELECT * FROM languages");
    $response = '';

    foreach ($allLanguages as $language) {
        $langName = $language->lang_name;
        $translate = (language($langName)) ? language($langName) : $langName;
        $languageShort = $language->lang_name_short;
        $isActive = ($selectedLanguage == $languageShort) ? 'active' : '';

        $response .= '
    <a class="dropdown-item  '.$isActive. '" href="?lang='.$languageShort.' ">
        <i class="flag-icon flag-icon-' . $languageShort . ' " "></i> ' . $translate . '
    </a>';
    }

    echo $response;
    exit;
}