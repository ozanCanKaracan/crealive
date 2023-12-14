<?php

class Content
{
    protected $table;
    protected $primary;


    function __construct()
    {
        $this->table = 'content';
        $this->primary = 'id';
    }

    function addContent($language,$category,$title,$description,$editor)
    {
        return DB::insert("INSERT INTO contents (content_title, content_category, content_language, content_desc, content_text) VALUES (?,?,?,?,?)",[$title,$category,$language,$description,$editor]);
    }
    /*function getContent($categoryID){
        if($categoryID == null){
            return DB::get("SELECT * FROM contents");

        }
        else if($categoryID !== null){
            return DB::get("SELECT * FROM contents WHERE content_category=?",[$categoryID]);
        }
    }*/
    function controlContent($categoryID){
        return DB::get("SELECT * FROM contents WHERE content_category=?",[$categoryID]);
    }
    function deleteContent($id){
        return DB::exec("DELETE FROM contents WHERE id=?",[$id]);
    }

}