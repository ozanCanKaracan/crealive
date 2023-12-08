<?php

include "../include/config.php";

/*----CLASSES----*/
$role = new Roles();
$perm= new Permission();
$user=new User();

if (isset($_POST["addRole"])) {
    $roleName = C($_POST["roleName"]);
    $controlRole = $role->controlRole($roleName);
    if (!$roleName) {
        echo "bos";
    } else if ($controlRole) {
        echo "hata";
    } else {
        $add = $role->addRole($roleName);
        $lastid=DB::lastInsertID($add);
        $add2=$perm->roleAddPermission($lastid);
        echo "ok";
        exit();
    }
}
if (isset($_POST["getRoleTable"])) {
    $data = $perm->getPermission();
    $response = [];
    if (count($data) > 0) {
        foreach ($data as $d) {
            $addCheck=($d->permission_add == '1') ? 'checked' : '';
            $deleteCheck=($d->permission_delete == '1') ? 'checked' : '';
            $editCheck=($d->permission_edit == '1') ? 'checked' : '';
            $listCheck=($d->permission_list == '1') ? 'checked' : '';
            $roleName=DB::getVar("SELECT role_name FROM roles WHERE id=?",[$d->role_id]);
            $response[] = [
                "id" => $d->permission_id,
                "role_name" => $roleName,
                "users" => '<a href="userlistRole/'.$d->role_id.'"><button type="button" class="btn btn-relief-warning btn-sm">Kişi Listesi</button></a>',
                "add" => '<input type="checkbox" class="custom-control-input add" id="addCheckBox" value="'.$d->role_id.'" onclick="addCheckBox('.$d->role_id.')" ' . $addCheck . '>',
                "delete"=>'<input type="checkbox" class="custom-control-input deleteCheck" id="deleteCheckBox" value="'.$d->role_id.'" onclick="deleteCheckBox('.$d->role_id.')" ' .$deleteCheck. '>',
                "edit"=>'<input type="checkbox" class="custom-control-input editCheck" id="editCheckBox" value="'.$d->role_id.'" onclick="editCheckBox('.$d->role_id.')" ' .$editCheck. '>',
                "list"=>'<input type="checkbox" class="custom-control-input listCheck" id="listCheckBox" value="'.$d->role_id.'" onclick="listCheckBox('.$d->role_id.')" '. $listCheck .'>',
            ];
        }
    }

    echo json_encode(["recordsTotal" => count($data), "recordsFiltered" => count($data), "data" => $response]);
    exit();
}
if (isset($_POST["getUserTable"])) {
    $id=C($_POST["id"]);
    $data = $user->getUser($id);
    $response = [];
    if (count($data) > 0) {
        foreach ($data as $d) {
            $controlTR=($d->turkish==1) ? 'checked' : '';
            $controlGER=($d->german==1) ? 'checked' : '';
            $controlENG=($d->english==1) ? 'checked' : '';
            $controlFR=($d->french==1) ? 'checked' : '';

            $response[] = [
                "id" => $d->id,
                "name" => $d->name,
                "turkish" => '<input type="checkbox" class="custom-control-input turkishCheck" id="turkish" value="'.$d->id.'" onclick="turkishCheckBox('.$d->id.')" '. $controlTR .'>',
                "german" => '<input type="checkbox" class="custom-control-input germanCheck" id="german" value="'.$d->id.'" onclick="germanCheckBox('.$d->id.')" '. $controlGER .'>',
                "english"=>'<input type="checkbox" class="custom-control-input englishCheck" id="english" value="'.$d->id.'" onclick="englishCheckBox('.$d->id.')" '. $controlENG .'>',
                "french"=>'<input type="checkbox" class="custom-control-input frenchCheck" id="french" value="'.$d->id.'" onclick="frenchCheckBox('.$d->id.')" '. $controlFR .'>',
            ];
        }
    }

    echo json_encode(["recordsTotal" => count($data), "recordsFiltered" => count($data), "data" => $response]);
    exit();
}
if (isset($_POST["getSelectBox"])) {
    $response = '
        <form id="deleteRoleForm">
            <label class="form-label-lg mb-1">Rolleri Listele</label>
            <select class="select2 form-control form-control select2-hidden-accessible" data-select2-id="1" aria-hidden="true" id="roleSelect" name="roleSelect">
                <option value="" data-select2-id="3" selected> Rol Seçiniz</option>
    ';

    $data = $role->getRoles();

    foreach ($data as $d) {
        $id=$d->id;
        $disabled = ($id == '1') ? 'disabled' : "";
        $response .= '<option value="' . $id. '" data-select2-id="3" ' . $disabled . '>' . $d->role_name . '</option>';
    }

    $response .= '</select>
                <div class="d-flex justify-content-end mt-1">
                    <button type="submit" class="btn btn-relief-success" onclick="deleteRole()">
                        <font style="vertical-align: inherit;">Kaldır</font>
                    </button>     
                </div>
            </form>
    ';

    echo $response;
}
if(isset($_POST["deleteRole"])){
    $id=C($_POST["id"]);
    if(!$id){
        echo "bos";
    }else{
        $delete=$role->deleteRoles($id);
        echo "ok";
        exit();
    }
}
if (isset($_POST["addCheckBox"])) {
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];
    $id = C($_POST["id"]);

    if ($checkedID) {
        foreach ($checkedID as $check) {
            $update = DB::exec("UPDATE permission SET permission_add = '1' WHERE role_id=?", [$check]);
        }
    }

     if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = DB::exec("UPDATE permission SET permission_add = '0' WHERE role_id=?", [$not]);
        }
    }
}
if (isset($_POST["deleteCheckBox"])) {
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];
    $id = C($_POST["id"]);

    if ($checkedID) {
        foreach ($checkedID as $check) {
            $update = DB::exec("UPDATE permission SET permission_delete = '1' WHERE role_id=?", [$check]);
        }
    }

    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = DB::exec("UPDATE permission SET permission_delete = '0' WHERE role_id=?", [$not]);
        }
    }
}
if (isset($_POST["editCheckBox"])) {
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];
    $id = C($_POST["id"]);

    if ($checkedID) {
        foreach ($checkedID as $check) {
            $update = DB::exec("UPDATE permission SET permission_edit = '1' WHERE role_id=?", [$check]);
        }
    }

    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = DB::exec("UPDATE permission SET permission_edit = '0' WHERE role_id=?", [$not]);
        }
    }
}
if (isset($_POST["listCheckBox"])) {
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];
    $id = C($_POST["id"]);

    if ($checkedID) {
        foreach ($checkedID as $check) {
            $update = DB::exec("UPDATE permission SET permission_list = '1' WHERE role_id=?", [$check]);
        }
    }

    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = DB::exec("UPDATE permission SET permission_list = '0' WHERE role_id=?", [$not]);
        }
    }
}
if (isset($_POST["turkishCheckBox"])) {
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];
    $id = C($_POST["id"]);

    if ($checkedID) {
        foreach ($checkedID as $check) {
            $update = DB::exec("UPDATE users SET turkish = '1' WHERE id=?", [$check]);
            echo "1";
        }
    }

    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = DB::exec("UPDATE permission SET turkish = '0' WHERE id=?", [$not]);
            echo "0";
        }
    }
}
if (isset($_POST["germanCheckBox"])) {
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];
    $id = C($_POST["id"]);

    if ($checkedID) {
        foreach ($checkedID as $check) {
            $update = DB::exec("UPDATE users SET german = '1' WHERE id=?", [$check]);
            echo "1";
        }
    }

    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = DB::exec("UPDATE permission SET german = '0' WHERE id=?", [$not]);
            echo "0";
        }
    }
}
if (isset($_POST["englishCheckBox"])) {
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];
    $id = C($_POST["id"]);

    if ($checkedID) {
        foreach ($checkedID as $check) {
            $update = DB::exec("UPDATE users SET english = '1' WHERE id=?", [$check]);
            echo "1";
        }
    }

    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = DB::exec("UPDATE permission SET english = '0' WHERE id=?", [$not]);
            echo "0";
        }
    }
}
if (isset($_POST["frenchCheckBox"])) {
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];
    $id = C($_POST["id"]);

    if ($checkedID) {
        foreach ($checkedID as $check) {
            $update = DB::exec("UPDATE users SET french = '1' WHERE id=?", [$check]);
            echo "1";
        }
    }

    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = DB::exec("UPDATE permission SET french = '0' WHERE id=?", [$not]);
            echo "0";
        }
    }
}











