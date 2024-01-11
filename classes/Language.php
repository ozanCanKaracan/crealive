<?php

Class Language{
    protected $table;
    protected $primary;

    function __construct()
    {
        $this->table= 'language';
        $this->primary= 'id';
    }

}