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

    function addContent($language,$category,$title,$editor,$url)
    {
        return DB::insert("INSERT INTO contents (content_title, content_category, content_language, content_text, url) VALUES (?,?,?,?,?)",[$title,$category,$language,$editor,$url]);
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
    function checkedFunction($checkedTag, $checkedCategory, $category, $tag){

        $categoryName = DB::getVar("SELECT category_name FROM category WHERE id=?", [$category]);
        $categoryName = strtolower($categoryName);
        $combinedTags = [];

        foreach ($tag as $t) {

            $tagName = DB::getVar("SELECT tag_name FROM tag WHERE id=?", [$t]);
            $combinedTags[] = $tagName;
        }

        $result = implode('-', $combinedTags);

        if ($checkedTag && $checkedCategory) {
            return $categoryName . "/" . $result;
        } else if ($checkedTag) {
            return $result;
        } else if ($checkedCategory) {
            return $categoryName;
        }
    }
}