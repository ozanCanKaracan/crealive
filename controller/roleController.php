<?php

include "../include/config.php";

/*----CLASSES----*/
$role = new Roles();
$perm = new Permission();
$user = new User();

if (isset($_POST["addRole"])) {
    $roleName = C($_POST["roleName"]);
    $controlRole = $role->controlRole($roleName);
    if (!$roleName) {
        echo "bos";
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
            $checkedTR = ($d->tr == 1) ? 'checked' : '';
            $checkedENG = ($d->us == 1) ? 'checked' : '';
            $checkedGER = ($d->de == 1) ? 'checked' : '';
            $checkedFR = ($d->fr == 1) ? 'checked' : '';
            $text_1 = "Kişi Listesi";
            $language_1 = (language($text_1)) ? language($text_1) : $text_1;
            $text_2 = "Sayfa izinleri";
            $language_2 = (language($text_2)) ? language($text_2) : $text_2;

            $response[] = [
                "id" => $d->id,
                "role_name" => $d->role_name,
                "users" => '<a href="userlistRole/' . $d->id . '"><button type="button" class="btn btn-relief-warning btn-sm">' . $language_1 . '</button></a>',
                "pages" => '<a href="permission/' . $d->id . '"><button type="button" class="btn btn-relief-info btn-sm">' . $language_2 . '</button></a>',

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
            $languages = DB::get("SELECT * FROM languages");

            $userData = [
                "id" => $d->id,
                "name" => $d->name,
            ];

            foreach ($languages as $lg) {
                $checkedControl=DB::getVar("SELECT status FROM language_permission WHERE user_id=? AND language_id=?",[$d->id , $lg->id]);
                $checked= ($checkedControl == 1) ? 'checked' : '';
                $userData[$lg->lang_name_short] = '<input type="checkbox" class="custom-control-input ' . $lg->lang_name_short . 'Check" 
                id="' . $lg->lang_name_short . 'CheckBox" value="' . $lg->id . '" onclick="langCheckBox(' . $lg->id . ',\'' . $lg->lang_name_short . '\',' . $d->id . ')" '.$checked.'>';
            }

            $response[] = $userData;
        }
    }

    echo json_encode(["recordsTotal" => count($data), "recordsFiltered" => count($data), "data" => $response]);
    exit();
}
if (isset($_POST["getSelectBox"])) {
    $text_1 = "Rol Seçiniz";
    $language_1 = (language($text_1)) ? language($text_1) : $text_1;
    $text_2 = "Kaldır";
    $language_2 = (language($text_2)) ? language($text_2) : $text_2;
    $lang = $_SESSION["lang"];
    $language = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$lang]);

    $response = '
        <form id="deleteRoleForm">
            <label class="form-label-lg mb-1">Rolleri Listele</label>
            <select class="select2 form-control form-control select2-hidden-accessible" data-select2-id="1" aria-hidden="true" id="roleSelect" name="roleSelect">
                <option value="" data-select2-id="3" selected> ' . $language_1 . ' </option>
    ';

    $data = $role->getRoles();

    foreach ($data as $d) {
        $id = $d->id;
        $disabled = ($id == '1') ? 'disabled' : "";
        $response .= '<option value="' . $id . '" data-select2-id="3" ' . $disabled . '>' . $d->role_name . '</option>';
    }

    $response .= '</select>
                <div class="d-flex justify-content-end mt-1">
                    <button type="submit" class="btn btn-relief-success" onclick="deleteRole(' . $language . ')">
                        <font style="vertical-align: inherit;">' . $language_2 . '</font>
                    </button>     
                </div>
            </form>
    ';

    echo $response;
}
if (isset($_POST["deleteRole"])) {
    $id = C($_POST["id"]);
    if (!$id) {
        echo "bos";
    } else {
        $delete = $role->deleteRoles($id);
        echo "ok";
        exit();
    }
}
if (isset($_POST["langCheckBox"])) {
    $id = $_POST["id"];
    $userID = $_POST["userID"];
    $langName = $_POST["langName"];
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];
    if ($checkedID) {
        foreach ($checkedID as $checked) {

            $control = DB::getVar("SELECT 1 FROM language_permission WHERE user_id=? AND language_id=?", [$userID, $checked]);
            if ($control) {
                $update = DB::exec("UPDATE language_permission SET status = 1 WHERE user_id=? AND language_id=?", [$userID, $checked]);
                echo "update işlemi";
            } else {
                $add = DB::insert("INSERT INTO language_permission (user_id,language_id,status) VALUES (?,?,?)", [$userID, $checked, 1]);
                echo "insert işlemi";
            }
        }
    }if ($notCheckedID) {
        foreach ($notCheckedID as $notChecked) {
            $update = DB::exec("UPDATE language_permission SET status = 0 WHERE user_id=? AND language_id=?", [$userID, $notChecked]);
            echo "update işlemi not";
        }
    }
}

