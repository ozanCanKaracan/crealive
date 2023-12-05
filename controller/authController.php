<?php
include "../include/config.php";

$auth=new Auth();

if(isset($_POST["register"])){
    $name = C($_POST["name"]);
    $phone = C($_POST["phone"]);
    $email = C($_POST["mail"]);
    $email2 = C($_POST["mail2"]);
    $pass = C($_POST["pass"]);
    $pass2 = C($_POST["pass2"]);
    $encryptedPass = md5(sha1(md5($pass)));
    $controlEmail=$auth->controlEmail($email);
    $controlPhone=$auth->controlPhone($phone);
    if(!$name || !$phone || !$email || !$email2 || !$pass || !$pass2){
        echo "bos";
    }else if($controlPhone){
        echo "phone";
    }else if($email != $email2){
        echo "mail2";
    }else if($controlEmail){
        echo "mail";
    }else if ($pass != $pass2){
        echo "pass";
    }else{
        $add=$auth->addUser($name,$phone,$email2,$encryptedPass);
        echo "ok";
        exit();
    }
}
if(isset($_POST["login"])){
    $email=C($_POST["email"]);
    $password=C($_POST["password"]);
    $encryptedPass = md5(sha1(md5($password)));

    $login=$auth->login($email,$encryptedPass);
    if(!$email || !$password){
        echo "bos";
    }else if($login){
        $_SESSION["user"]=$login;
        echo "ok";
        exit();
    }else{
        echo "hata";
    }
}
if(isset($_POST["logout"])){
    session_unset();
    echo "ok";
    exit();

}