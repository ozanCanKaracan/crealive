<?php

class Roles
{
    protected $table;
    protected $primary;


    function __construct()
    {

        $this->table = 'roles';
        $this->primary = 'id';

    }

    function controlRole($roleName)
    {
        return DB::get("SELECT 1 FROM roles WHERE role_name=?", [$roleName]);
    }

    function addRole($roleName)
    {
        return DB::insert("INSERT INTO roles (role_name) VALUES (?)", [$roleName]);
    }

    function getRoles()
    {
        return DB::get("SELECT id,role_name FROM roles");
    }

    function deleteRoles($id)
    {
        return DB::exec("DELETE FROM roles WHERE id=?",[$id]);
    }

}