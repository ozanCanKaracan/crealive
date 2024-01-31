<?php

include "../include/config.php";

/*----CLASSES----*/
$role = new Roles();
$perm = new Permission();
$user = new User();

if (isset($_POST["addRole"])) {
    $roleName = C($_POST["roleName"]);
    $controlRole = $role->controlRole($roleName);
    $regexControl = (preg_match("/[0-9]/", $roleName));
    if (!$roleName) {
        echo "bos";
    }elseif($regexControl){
        echo "regex";
    } else if ($controlRole) {
        echo "hata";
    } else {
        $add = $role->addRole($roleName);
        $lastid = DB::lastInsertID($add);
        echo "ok";
        exit();
    }
}
if (isset($_POST["getRoleTable"])) {
    $data = $role->getRoles();
    $response = [];
    if (count($data) > 0) {
        foreach ($data as $d) {

            $text_1 = "Kişi Listesi";
            $language_1 = (language($text_1)) ? language($text_1) : $text_1;
            $text_2 = "Sayfa izinleri";
            $language_2 = (language($text_2)) ? language($text_2) : $text_2;

            $response[] = [
                "id" => $d->id,
                "d_noneListName" => $language_1,
                "d_nonePageName" => $language_2,
                "role_name" => $d->role_name,
                "users" => [
                    "button" =>true,
                ],
                "pages" => [
                    "button" => true,
                ],
            ];
        }
    }

    echo json_encode(["recordsTotal" => count($data), "recordsFiltered" => count($data), "data" => $response]);
    exit();
}
if (isset($_POST["getUserTable"])) {
    $id = C($_POST["id"]);
    $data = $user->getUser($id);
    $response = [];

    if (count($data) > 0) {
        foreach ($data as $d) {
            $languages = DB::get("SELECT id,lang_name_short FROM languages");

            $userData = [
                "id" => $d->id,
                "name" => $d->name,
            ];

            foreach ($languages as $lg) {
                $checkedControl = DB::getVar("SELECT status FROM language_permission WHERE user_id=? AND language_id=?", [$d->id, $lg->id]);
                $checked = ($checkedControl == 1) ? 'checked' : '';

                $userData['languages'][] = [
                    "lang_name_short" => $lg->lang_name_short,
                    "check" => true,
                    "lgID" => $lg->id,
                    "checked" => $checked,
                ];
            }

            $response[] = $userData;
        }
    }

    echo json_encode(["recordsTotal" => count($data), "recordsFiltered" => count($data), "data" => $response]);
    exit();
}


if (isset($_POST["deleteRole"])) {
    $id = C($_POST["id"]);
    if (!$id) {
        echo "bos";
    } else {
        $control=DB::getVar("SELECT 1 FROM users WHERE role_id=?",[$id]);
        if($control){
            echo "error";
        }
       else{
           $delete = $role->deleteRoles($id);
           echo "ok";
            exit();
        }
    }
}
if (isset($_POST["langCheckBox"])) {
    $id = $_POST["id"];
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : []; // user_id var
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];// user_id var
    var_dump($checkedID);
    if ($checkedID) {
        foreach ($checkedID as $checked) {
            $control = DB::get("SELECT * FROM language_permission WHERE user_id=? AND language_id=?", [$checked, $id]);
            if ($control) {
                $update = DB::exec("UPDATE language_permission SET status = 1 WHERE user_id=? AND language_id=?", [$checked, $id]);
                echo "update işlemi";
            } else {
                $add = DB::insert("INSERT INTO language_permission (user_id,language_id,status) VALUES (?,?,?)", [$checked, $id, 1]);
                echo "insert işlemi";
            }
        }
    }if ($notCheckedID) {
        foreach ($notCheckedID as $notChecked) {
            $update = DB::exec("UPDATE language_permission SET status = 0 WHERE user_id=? AND language_id=?", [$notChecked, $id]);
            echo "update işlemi not";
        }
    }
}

