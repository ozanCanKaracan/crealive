<?php

include "../include/config.php";
$role = new Roles();
if (isset($_POST["addRole"])) {
    $roleName = C($_POST["roleName"]);
    $controlRole = $role->controlRole($roleName);
    if (!$roleName) {
        echo "bos";
    } else if ($controlRole) {
        echo "hata";
    } else {
        $add = $role->addRole($roleName);
        echo "ok";
        exit();
    }
}
if (isset($_POST["getRoleTable"])){
    $data = $role->getRoles();
    $response = [];
    if (count($data) > 0) {
        foreach ($data as $d) {
            $response[] = [
                "id" => $d->id,
                "role_name" => $d->role_name,
                "process" => '',
            ];
        }
    }

    echo json_encode(["recordsTotal" => count($data), "recordsFiltered" => count($data), "data" => $response]);
    exit();
}