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
    function getPermission(){
        return DB::get("SELECT * FROM permission");
    }
      function roleAddPermission($lastid){
        return DB::insert("INSERT INTO permission (page_id,role_id,permission_add,permission_edit,permission_list,permission_delete) VALUES(?, ?, ?, ?, ?, ?)",[2,$lastid,0,0,0,0]);
    }

}