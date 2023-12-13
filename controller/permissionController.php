<?php
include "../include/config.php";
$permission=new Permission();
$pages=new Pages();
if(isset($_POST["getPermissionTable"])){
    $id=C($_POST["id"]);
    $data=$pages->getPages();
    $response = [];
    if (count($data) > 0) {
        foreach ($data as $d) {
            $control=DB::get("SELECT * FROM permission WHERE page_id=? AND role_id=?",[$d->id,$id]);
            $checkedAdd = ($control[0]->permission_add == 1) ? 'checked' : '';
            $checkedDelete = ($control[0]->permission_delete == 1) ? 'checked' : '';
            $checkedEdit= ($control[0]->permission_edit == 1) ? 'checked' : '';
            $checkedList= ($control[0]->permission_list == 1) ? 'checked' : '';
            $checkedView= ($control[0]->permission_view == 1) ? 'checked' : '';


            $response[] = [
                "id" => $d->id,
                "pages" => $d->page_name,
                "add" => '<input type="checkbox" class="custom-control-input addCheck" id="addCheckBox" value="'.$d->id.'" onclick="addCheckBox('.$id.')" ' . $checkedAdd . '>',
                "delete"=>'<input type="checkbox" class="custom-control-input deleteCheck" id="deleteCheckBox" value="'.$d->id.'" onclick="deleteCheckBox('.$id.')" ' . $checkedDelete . '>',
                "edit"=>'<input type="checkbox" class="custom-control-input editCheck" id="editCheckBox" value="'.$d->id.'" onclick="editCheckBox('.$id.')" ' . $checkedEdit . '>',
                "list"=>'<input type="checkbox" class="custom-control-input listCheck" id="listCheckBox" value="'.$d->id.'" onclick="listCheckBox('.$id.')" ' . $checkedList . '>',
                "view"=>'<input type="checkbox" class="custom-control-input viewCheck" id="listCheckBox" value="'.$d->id.'" onclick="viewCheckBox('.$id.')" ' . $checkedView . '>',


            ];
        }
    }

    echo json_encode(["recordsTotal" => count($data), "recordsFiltered" => count($data), "data" => $response]);
    exit();
}
if (isset($_POST["addCheckBox"])) {
    $role_id=$_POST["role_id"];
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];

    if ($checkedID) {
        foreach ($checkedID as $check) {
            $control=$permission->controlPermission($check,$role_id);
            if($control){
                $update = $permission->updateAddON($check,$role_id);
                echo "update";

            }else{
                $add=DB::insert("INSERT INTO permission (page_id,role_id,permission_add,permission_delete,permission_edit,permission_list) VALUES (?,?,?,?,?,?)",[$check,$role_id,1,0,0,0]);
                echo "insert";
            }
        }
    }

    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = $permission->updateAddOFF($not,$role_id);
        }
    }
}
if (isset($_POST["deleteCheckBox"])) {
    $role_id=$_POST["role_id"];
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];

    if ($checkedID) {
        foreach ($checkedID as $check) {
            $control=$permission->controlPermission($check,$role_id);
            if($control){
                $update = $permission->updateDeleteON($check,$role_id);
                echo "update";

            }else{
                $add=DB::insert("INSERT INTO permission (page_id,role_id,permission_add,permission_delete,permission_edit,permission_list) VALUES (?,?,?,?,?,?)",[$check,$role_id,0,1,0,0]);
                echo "insert";
            }
        }
    }
    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = $permission->updateDeleteOFF($not,$role_id);
        }
    }
}
if (isset($_POST["editCheckBox"])) {
    $role_id=$_POST["role_id"];
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];

    if ($checkedID) {
        foreach ($checkedID as $check) {
            $control=$permission->controlPermission($check,$role_id);
            if($control){
                $update =$permission->updateEditON($check,$role_id);
                echo "update";

            }else{
                $add=DB::insert("INSERT INTO permission (page_id,role_id,permission_add,permission_delete,permission_edit,permission_list) VALUES (?,?,?,?,?,?)",[$check,$role_id,0,0,1,0]);
                echo "insert";
            }
        }
    }

    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = $permission->updateEditOFF($not,$role_id);
        }
    }
}
if (isset($_POST["listCheckBox"])) {
    $role_id=$_POST["role_id"];
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];

    if ($checkedID) {
        foreach ($checkedID as $check) {
            $control=$permission->controlPermission($check,$role_id);
            if($control){
                $update = $permission->updateListON($check,$role_id);
                echo "update";

            }else{
                $add=DB::insert("INSERT INTO permission (page_id,role_id,permission_add,permission_delete,permission_edit,permission_list) VALUES (?,?,?,?,?,?)",[$check,$role_id,0,0,0,1]);
                echo "insert";
            }
        }
    }

    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update =$permission->updateListOFF($not,$role_id);
        }
    }
}
if (isset($_POST["viewCheckBox"])) {
    $role_id=$_POST["role_id"];
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];

    if ($checkedID) {
        foreach ($checkedID as $check) {
            $control=$permission->controlPermission($check,$role_id);
            if($control){
                $update = $permission->updateViewON($check,$role_id);
                echo "update";

            }else{
                $add=DB::insert("INSERT INTO permission (page_id,role_id,permission_add,permission_delete,permission_edit,permission_list,permission_view) VALUES (?,?,?,?,?,?,?)",[$check,$role_id,0,0,0,0,1]);
                echo "insert";
            }
        }
    }

    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = $permission->updateViewOFF($not,$role_id);
        }
    }
}