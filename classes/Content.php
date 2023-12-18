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

    function addContent($language,$category,$title,$editor)
    {
        return DB::insert("INSERT INTO contents (content_title, content_category, content_language, content_text) VALUES (?,?,?,?)",[$title,$category,$language,$editor]);
    }
    function controlContent($categoryID){
        return DB::get("SELECT * FROM contents WHERE content_category=?",[$categoryID]);
    }
    function deleteContent($id){
        return DB::exec("DELETE FROM contents WHERE id=?",[$id]);
    }
    function updateContent($category, $language, $title, $description, $editorContent, $id){
        return DB::exec("UPDATE contents SET content_category=?, content_language=?,content_title=?, content_desc=?, content_text=? WHERE id=?", [$category, $language, $title, $description, $editorContent, $id]);
    }
    function createUrl($title){
        $title = str_replace(['ç', 'ğ', 'ı', 'ö', 'ş', 'ü'], ['c', 'g', 'i', 'o', 's', 'u'], $title);
        $title = str_replace(' ', '-', $title);
        $title = strtolower($title);
        return $title;

    }
}