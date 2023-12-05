<?php

class Auth{
    protected $table;
    protected $primary;

    function __construct(){
        $this->table ='users';
        $this->primary ='user_id';
    }
    function login($email,$encrypt){
        return DB::getVar("SELECT user_id FROM {$this->table} WHERE user_mail =? AND user_password=?",[$email,$encrypt]);
    }
    function controlEmail($email){
        return DB:: get("SELECT * FROM {$this->table} WHERE email=?",[$email]);
    }
    function controlPhone($phone){
        return DB:: get("SELECT * FROM {$this->table} WHERE phone=?",[$phone]);
    }
}