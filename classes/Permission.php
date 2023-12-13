<?php

class Permission
{
    protected $table;
    protected $primary;

    function __construct()
    {

        $this->table = 'permission';
        $this->primary = 'permission_id';
    }

    function getPermission($id)
    {
        return DB::get("SELECT * FROM permission WHERE role_id=?", [$id]);
    }

    function controlPermission($check, $role_id)
    {
        return DB::get("SELECT * FROM permission WHERE page_id=? AND role_id=?", [$check, $role_id]);
    }

    function updateAddON($check, $role_id)
    {
        return DB::exec("UPDATE permission SET permission_add = '1' WHERE page_id=? AND role_id=?", [$check, $role_id]);
    }
    function updateAddOFF($not,$role_id){
        return DB::exec("UPDATE permission SET permission_add = '0' WHERE page_id=? AND role_id=?", [$not,$role_id]);
    }

    function updateDeleteON($check, $role_id)
    {
        return DB::exec("UPDATE permission SET permission_delete = '1' WHERE page_id=? AND role_id=?", [$check, $role_id]);
    }
    function updateDeleteOFF($not,$role_id){
        return DB::exec("UPDATE permission SET permission_delete = '0' WHERE page_id=? AND role_id=?", [$not,$role_id]);
    }

    function updateEditON($check, $role_id)
    {
        return DB::exec("UPDATE permission SET permission_edit = '1' WHERE page_id=? AND role_id=?", [$check, $role_id]);
    }
    function updateEditOFF($not,$role_id){
        return DB::exec("UPDATE permission SET permission_edit = '0' WHERE page_id=? AND role_id=?", [$not,$role_id]);
    }

    function updateListON($check, $role_id)
    {
        return DB::exec("UPDATE permission SET permission_list = '1' WHERE page_id=? AND role_id=?", [$check, $role_id]);
    }
    function updateListOFF($not,$role_id){
        return DB::exec("UPDATE permission SET permission_list = '0' WHERE page_id=? AND role_id=?", [$not,$role_id]);
    }

    function updateViewON($check, $role_id)
    {
        return DB::exec("UPDATE permission SET permission_view = '1' WHERE page_id=? AND role_id=?", [$check, $role_id]);
    }
    function updateViewOFF($not,$role_id){
        return DB::exec("UPDATE permission SET permission_view = '0' WHERE page_id=? AND role_id=?", [$not,$role_id]);
    }

}