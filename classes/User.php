<?php

class User{
    protected $table;
    protected $primary;

    function __construct(){
        $this->table ='users';
        $this->primary ='id';
    }
    function login($email,$encryptedPass){
        return DB::getRow("SELECT id,role_id FROM {$this->table} WHERE mail =? AND password=?",[$email,$encryptedPass]);
    }
    function controlEmail($email){
        return DB:: get("SELECT * FROM {$this->table} WHERE mail=?",[$email]);
    }
    function controlPhone($phone){
        return DB:: get("SELECT * FROM {$this->table} WHERE phone=?",[$phone]);
    }
    function addUser($name,$language,$phone,$email,$encryptedPass){
        return DB::exec("INSERT INTO users (name,language_id,phone,mail,password) VALUES (?,?,?,?,?)",[$name,$language,$phone,$email,$encryptedPass]);
    }
    function getUser($id){
        return DB::get("SELECT * FROM users WHERE role_id=?",[$id]);
    }
}