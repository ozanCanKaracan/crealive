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
    $data = $role->getRoles();
    $response = [];
    if (count($data) > 0) {
        foreach ($data as $d) {
            $checkedTR=($d->tr == 1) ? 'checked' : '';
            $checkedENG=($d->eng == 1) ? 'checked' : '';
            $checkedGER=($d->ger == 1) ? 'checked' : '';
            $checkedFR=($d->fr == 1) ? 'checked' : '';

            $response[] = [
                "id" => $d->id,
                "role_name" => $d->role_name,
                "users" =>'<a href="userlistRole/'.$d->id.'"><button type="button" class="btn btn-relief-warning btn-sm">Kişi Listesi</button></a>',
                "pages" =>'<a href="permission/'.$d->id.'"><button type="button" class="btn btn-relief-info btn-sm">Sayfa İzinleri</button></a>',
                "TR" =>'<input type="checkbox" class="custom-control-input trCheck" id="trCheckBox" value="'.$d->id.'" onclick="trCheckBox('.$d->id.')" '.$checkedTR.'>',
                "ENG" =>'<input type="checkbox" class="custom-control-input engCheck" id="engCheckBox" value="'.$d->id.'" onclick="engCheckBox('.$d->id.')" '.$checkedENG.'>',
                "GER" =>'<input type="checkbox" class="custom-control-input gerCheck" id="gerCheckBox" value="'.$d->id.'" onclick="gerCheckBox('.$d->id.')" '.$checkedGER.'>',
                "FR" =>'<input type="checkbox" class="custom-control-input frCheck" id="frCheckBox" value="'.$d->id.'" onclick="frCheckBox('.$d->id.')" '.$checkedFR.'>',
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
if (isset($_POST["trCheckBox"])) {
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];
    $id = C($_POST["id"]);

    if ($checkedID) {
        foreach ($checkedID as $check) {
            $update = DB::exec("UPDATE roles SET tr = '1' WHERE id=?", [$check]);
            echo "1";
        }
    }

    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = DB::exec("UPDATE roles SET tr = '0' WHERE id=?", [$not]);
            echo "0";
        }
    }
}
if (isset($_POST["engCheckBox"])) {
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];
    $id = C($_POST["id"]);

    if ($checkedID) {
        foreach ($checkedID as $check) {
            $update = DB::exec("UPDATE roles SET eng = '1' WHERE id=?", [$check]);
            echo "1";
        }
    }

    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = DB::exec("UPDATE roles SET eng = '0' WHERE id=?", [$not]);
            echo "0";
        }
    }
}
if (isset($_POST["gerCheckBox"])) {
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];
    $id = C($_POST["id"]);

    if ($checkedID) {
        foreach ($checkedID as $check) {
            $update = DB::exec("UPDATE roles SET ger = '1' WHERE id=?", [$check]);
            echo "1";
        }
    }

    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = DB::exec("UPDATE roles SET ger = '0' WHERE id=?", [$not]);
            echo "0";
        }
    }
}
if (isset($_POST["frCheckBox"])) {
    $checkedID = isset($_POST["checkedID"]) ? $_POST["checkedID"] : [];
    $notCheckedID = isset($_POST["notCheckedID"]) ? $_POST["notCheckedID"] : [];
    $id = C($_POST["id"]);

    if ($checkedID) {
        foreach ($checkedID as $check) {
            $update = DB::exec("UPDATE roles SET fr = '1' WHERE id=?", [$check]);
            echo "1";
        }
    }

    if ($notCheckedID) {
        foreach ($notCheckedID as $not) {
            $update = DB::exec("UPDATE roles SET fr = '0' WHERE id=?", [$not]);
            echo "0";
        }
    }
}




