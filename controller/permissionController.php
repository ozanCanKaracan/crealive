<?php
include "../include/config.php";
$permission = new Permission();
$pages = new Pages();
if (isset($_POST["getPermissionTable"])) {
    $id = C($_POST["id"]);
    $data = $pages->getPages();
    $languages = DB::get("SELECT id,lang_name FROM languages WHERE status=1");
    $page_id = $_POST["pageID"];
    $response = [];
    $role_ID = $_SESSION["role_id"];
    if (count($data) > 0) {
        foreach ($data as $d) {
            $control = DB::get("SELECT * FROM permission WHERE page_id=? AND role_id=?", [$d->id, $id]);
            if (isset($control[0])) {
                $checkedAdd = ($control[0]->permission_add == 1) ? 'checked' : '';
                $checkedDelete = ($control[0]->permission_delete == 1) ? 'checked' : '';
                $checkedEdit = ($control[0]->permission_edit == 1) ? 'checked' : '';
                $checkedList = ($control[0]->permission_list == 1) ? 'checked' : '';
                $checkedView = ($control[0]->permission_view == 1) ? 'checked' : '';
            } else {
                $checkedAdd = '';
                $checkedDelete = '';
                $checkedEdit = '';
                $checkedList = '';
                $checkedView = '';
            }


            if ($d->page_name == "İçerik") {
                foreach ($languages as $language) {
                    $controlLanguage=DB::get("SELECT * FROM permission WHERE page_id=? AND role_id=? AND language_id=?",[$d->id,$id,$language->id]);


                    if(isset($controlLanguage[0])){
                        $checkedAddLanguage = ($controlLanguage[0]->permission_add == 1) ? 'checked' : '';
                        $checkedDeleteLanguage = ($controlLanguage[0]->permission_delete == 1) ? 'checked' : '';
                        $checkedEditLanguage = ($controlLanguage[0]->permission_edit == 1) ? 'checked' : '';
                        $checkedListLanguage = ($controlLanguage[0]->permission_list == 1) ? 'checked' : '';
                        $checkedViewLanguage = ($controlLanguage[0]->permission_view == 1) ? 'checked' : '';
                    } else {
                        $checkedAddLanguage = '';
                        $checkedDeleteLanguage = '';
                        $checkedEditLanguage = '';
                        $checkedListLanguage = '';
                        $checkedViewLanguage = '';
                    }
                    $names = $d->page_name . " " . $language->lang_name . "";
                    $parts = explode(' ',$names);
                    $firstVariable = $parts[0];
                    $secondVariable = $parts[1];
                    $translate_1 = (language($firstVariable)) ? language($firstVariable) : $firstVariable;
                    $translate_2 = (language($secondVariable)) ? language($secondVariable) : $secondVariable;

                    $response[] = [
                        "id" => $d->id,
                        "pages" => $translate_1 . " (" . $translate_2 . ")",
                        "add" => '<input type="checkbox" class="custom-control-input addCheckLanguage" id="languageAddCheckBox" value="' . $language->id . '" onclick="languageCheckbox(' . $id . ', \'add\',\'' . $d->id . '\')" ' . $checkedAddLanguage . ' >',
                        "delete" => '<input type="checkbox" class="custom-control-input deleteCheckLanguage" id="languageDeleteCheckBox" value="' . $language->id . '" onclick="languageCheckbox(' . $id . ', \'delete\',\'' . $d->id . '\')" ' . $checkedDeleteLanguage . ' >',
                        "edit" => '<input type="checkbox" class="custom-control-input editCheckLanguage" id="languageEditCheckBox" value="' . $language->id . '" onclick="languageCheckbox(' . $id . ', \'edit\',\'' . $d->id . '\')" ' . $checkedEditLanguage . '>',
                        "list" => '<input type="checkbox" class="custom-control-input listCheckLanguage" id="languageListCheckBox" value="' . $language->id . '" onclick="languageCheckbox(' . $id . ', \'list\',\'' . $d->id . '\')" ' . $checkedListLanguage . ' >',
                        "view" => '<input type="checkbox" class="custom-control-input viewCheckLanguage" id="languageViewCheckBox" value="' . $language->id . '" onclick="languageCheckbox(' . $id . ', \'view\',\'' . $d->id . '\')" ' . $checkedViewLanguage . ' >',
                    ];
                }
            } else {
                // "İçerik" sayfası dışındaki diğer sayfalar için dil döngüsünü kullanma
                $text=$d->page_name;
                $translate=(language($text)) ? language($text) : $text;
                $response[] = [
                    "id" => $d->id,
                    "pages" => $translate,
                    "add" => '<input type="checkbox" class="custom-control-input addCheck" id="addCheckBox" value="' . $d->id . '" onclick="permissionCheckbox(' . $id . ', \'add\')" ' . $checkedAdd . '>',
                    "delete" => '<input type="checkbox" class="custom-control-input deleteCheck" id="deleteCheckBox" value="' . $d->id . '" onclick="permissionCheckbox(' . $id . ', \'delete\')" ' . $checkedDelete . '>',
                    "edit" => '<input type="checkbox" class="custom-control-input editCheck" id="editCheckBox" value="' . $d->id . '" onclick="permissionCheckbox(' . $id . ', \'edit\')" ' . $checkedEdit . '>',
                    "list" => '<input type="checkbox" class="custom-control-input listCheck" id="listCheckBox" value="' . $d->id . '" onclick="permissionCheckbox(' . $id . ', \'list\')" ' . $checkedList . '>',
                    "view" => '<input type="checkbox" class="custom-control-input viewCheck" id="listCheckBox" value="' . $d->id . '" onclick="permissionCheckbox(' . $id . ', \'view\')" ' . $checkedView . '>',
                ];
            }
        }
    }

    echo json_encode(["recordsTotal" => count($data), "recordsFiltered" => count($data), "data" => $response]);
    exit();
}

if (isset($_POST["languageCheckbox"])) {
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];
    $roleID = $_POST["roleID"];
    $parentID = $_POST["parentID"];
    $type = $_POST["type"];
    $permission = 'permission_' . $type;
    if ($checkedID) {
        foreach ($checkedID as $check) {
            $control = DB::getVar("SELECT 1 FROM permission WHERE page_id=? AND role_id=? AND language_id=?", [$parentID, $roleID, $check]);
            if ($control) {
                $update = DB::exec("UPDATE permission SET $permission = 1 WHERE page_id=? AND role_id=? AND language_id=?", [$parentID, $roleID, $check]);
                echo "update";
            } else {
                $add = DB::insert("INSERT INTO permission (page_id,role_id,language_id,$permission) VALUES (?,?,?,?)", [$parentID, $roleID, $check, 1,]);
                echo "insert";
            }
        }
    }
    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = DB::exec("UPDATE permission SET $permission = 0 WHERE page_id=? AND role_id=? AND language_id=?", [$parentID, $roleID, $not]);
            echo "update not";
        }
    }
}
if (isset($_POST["permissionCheckbox"])) {
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : []; // parent_id
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : []; // parent_id
    $roleID = $_POST["roleID"];
    $type = $_POST["type"];
    $permission = 'permission_' . $type;
    if ($checkedID) {
        foreach ($checkedID as $check) {
            $control = DB::get("SELECT 1 FROM permission WHERE page_id=? AND role_id=?", [$check, $roleID]);
            if ($control) {
                $update = DB::exec("UPDATE permission SET $permission = 1 WHERE page_id=? AND role_id=?", [$check, $roleID]);
                echo "update";
            } else {
                $add = DB::insert("INSERT INTO permission (page_id,role_id,$permission) VALUES (?,?,?)", [$check, $roleID, 1]);
                echo "insert";
            }
        }
    }
    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = DB::exec("UPDATE permission SET $permission = 0 WHERE page_id=? AND role_id=?", [$not, $roleID]);
            echo "update not";
        }
    }
}
