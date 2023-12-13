<?php

Class Pages{
    protected $table;
    protected $primary;

    function __construct()
    {
        $this->table= 'pages';
        $this->primary= 'id';
    }
    function getPages(){
        return DB::get("SELECT * FROM pages WHERE parent_id > 0 ");
    }
}