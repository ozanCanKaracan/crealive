<?php

include "../include/config.php";
$role = new Roles();
$perm= new Permission();
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
                "add" => '<input type="checkbox" class="custom-control-input check" id="addCheckBox" value="'.$d->role_id.'" onclick="addCheckBox('.$d->role_id.')" ' . $addCheck . '>',
                "delete"=>'<input type="checkbox" class="custom-control-input deleteCheck" id="deleteCheckBox" value="'.$d->id.'" onclick="deleteCheckBox('.$d->role_id.')" ' .$deleteCheck. '>',
                "edit"=>'<input type="checkbox" class="custom-control-input editCheck" id="editCheckBox" value="'.$d->id.'" onclick="editCheckBox('.$d->role_id.')" ' .$editCheck. '>',
                "list"=>'<input type="checkbox" class="custom-control-input listCheck" id="listCheckBox" value="'.$d->id.'" onclick="listCheckBox('.$d->role_id.')" '. $listCheck .'>',
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

    $data = DB::get("SELECT * FROM roles");

    foreach ($data as $d) {
        $selected=$d->id;
        $disabled = ($d->id == '1') ? 'disabled' : "";
        $response .= '<option value="' . $selected. '" data-select2-id="3" ' . $disabled . '>' . $d->role_name . '</option>';
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
if(isset($_POST["addCheckBox"])){
  $checked=$_POST["checkedID"];
  $id=C($_POST["id"]);

  if($checked){
      $update=DB::exec("UPDATE permission SET permission_add = '1' WHERE role_id=?",[$id]);
      echo "1";
  }else{
      $update=DB::exec("UPDATE permission SET permission_add = '0' WHERE role_id=?",[$id]);
      echo "0";
  }
}
if(isset($_POST["deleteCheckBox"])){
    $checked=$_POST["checkedID"];
    $id=C($_POST["id"]);

    if($checked){
        $update=DB::exec("UPDATE permission SET permission_delete = '1' WHERE role_id=?",[$id]);
        echo "1";
    }else{
        $update=DB::exec("UPDATE permission SET permission_delete = '0' WHERE role_id=?",[$id]);
        echo "0";
    }
}
if(isset($_POST["editCheckBox"])){
    $checked=$_POST["checkedID"];
    $id=C($_POST["id"]);

    if($checked){
        $update=DB::exec("UPDATE permission SET permission_edit = '1' WHERE role_id=?",[$id]);
        echo "1";
    }else{
        $update=DB::exec("UPDATE permission SET permission_edit = '0' WHERE role_id=?",[$id]);
        echo "0";
    }
}
if(isset($_POST["listCheckBox"])){
    $checked=$_POST["checkedID"];
    $id=C($_POST["id"]);

    if($checked){
        $update=DB::exec("UPDATE permission SET permission_list = '1' WHERE role_id=?",[$id]);
        echo "1";
    }else{
        $update=DB::exec("UPDATE permission SET permission_list = '0' WHERE role_id=?",[$id]);
        echo "0";
    }
}





