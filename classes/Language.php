<?php

class Language
{
    protected $table;
    protected $primary;

    function __construct()
    {
        $this->table = 'language';
        $this->primary = 'id';
    }

    function controlUserLanguage($languageID)
    {
        $user_id=$_SESSION["user"];
        $access=DB::getVar("SELECT status FROM language_permission WHERE user_id=? AND language_id=?",[$user_id,$languageID]);
        return $access ? true : false;
    }
}