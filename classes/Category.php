<?php

class Category
{
    protected $table;
    protected $primary;


    function __construct()
    {

        $this->table = 'category';
        $this->primary = 'id';

    }

    function getCategory()
    {
        return DB::get("SELECT * FROM category");
    }

    function addCategory($categoryName)
    {
        return DB::insert("INSERT INTO category (category_name) VALUES (?)", [$categoryName]);
    }

    function controlAddCategory($categoryName)
    {
    return DB::get("SELECT * FROM category WHERE category_name=?",[$categoryName]);
    }
    function deleteCategory($categoryID){
        return DB::exec("DELETE FROM category WHERE id=? ",[$categoryID]);
    }


}