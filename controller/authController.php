<?php
include "../include/config.php";

$auth=new Auth();
if(isset($_POST["login"])){

}
if(isset($_POST["register"])){
    $name = C($_POST["name"]);
    $phone = C($_POST["phone"]);
    $email = C($_POST["email"]);
    $email2 = C($_POST["email2"]);
    $pass = C($_POST["pass"]);
    $pass2 = C($_POST["pass2"]);
    $encryptedPass = password_hash($pass, PASSWORD_BCRYPT);
    $controlEmail=$auth->controlEmail($email);
    $controlPhone=$auth->controlPhone($phone);
    if(!$name || !$phone || !$email || !$email2 || !$pass || !$pass2){
        echo "bos";
    }else if($email =! $email2){
        echo "mail2";
    }else if($controlEmail){
        echo "mail";
    }
}