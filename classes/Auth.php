<?php

class Auth{
    protected $table;
    protected $primary;

    function __construct(){
        $this->table ='users';
        $this->primary ='id';
    }
    function login($email,$encryptedPass){
        return DB::get("SELECT id FROM {$this->table} WHERE mail =? AND password=?",[$email,$encryptedPass]);
    }
    function controlEmail($email){
        return DB:: get("SELECT * FROM {$this->table} WHERE mail=?",[$email]);
    }
    function controlPhone($phone){
        return DB:: get("SELECT * FROM {$this->table} WHERE phone=?",[$phone]);
    }
    function addUser($name,$phone,$email,$encryptedPass){
        return DB::exec("INSERT INTO users (name,phone,mail,password) VALUES (?,?,?,?)",[$name,$phone,$email,$encryptedPass]);
    }
}