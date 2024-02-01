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

    function addContent($language, $category, $title, $editor, $url)
    {
        return DB::insert("INSERT INTO contents (content_title, content_category, content_language, content_text, url) VALUES (?,?,?,?,?)", [$title, $category, $language, $editor, $url]);
    }

    function controlContent($categoryID)
    {
        return DB::get("SELECT 1 FROM contents WHERE content_category=?", [$categoryID]);
    }

    function deleteContent($id)
    {
        return DB::exec("DELETE FROM contents WHERE id=?", [$id]);
    }

    function updateContent($category, $language, $title, $description, $editorContent, $id)
    {
        return DB::exec("UPDATE contents SET content_category=?, content_language=?,content_title=?, content_desc=?, content_text=? WHERE id=?", [$category, $language, $title, $description, $editorContent, $id]);
    }

    function createUrl($title)
    {
        $title = str_replace(['ç', 'ğ', 'ı', 'ö', 'ş', 'ü'], ['c', 'g', 'i', 'o', 's', 'u'], $title);
        $title = str_replace(' ', '-', $title);
        $title = strtolower($title);
        return $title;
    }

    function checkedFunction($checkedTag, $checkedCategory, $category, $tag)
    {
        $categoryName = DB::getVar("SELECT category_name FROM category WHERE id=?", [$category]);
        $categoryName = strtolower($categoryName);

        $tagArray = is_array($tag) ? $tag : [$tag];

        $placeholders = implode(',', array_fill(0, count($tagArray), '?'));

        $tagObjects = DB::get("SELECT tag_name FROM tag WHERE id IN ($placeholders)", $tagArray);

        $tagNames = array_map(function ($tagObject) {
            return $tagObject->tag_name;
        }, $tagObjects);
        $result = strtolower(implode('-', $tagNames));

        if ($checkedTag && $checkedCategory) {
            $baseResult = $result;
            $counter = 1;
            do {
                $timestamp = time();
                $result = $categoryName . "-" . $baseResult . "-" . $timestamp . "-" . $counter; // Sayıyı $result'a ekle
                $controlAuto = DB::getVar("SELECT url FROM contents WHERE url=?", [$result]);
                $counter++; // Sayıcıyı artır
            } while ($controlAuto); // Eğer $controlAuto'dan veri geldiyse döngüyü tekrarla

            return $result;

        } else if ($checkedCategory) {
            $counter=1;
            do {
                $timestamp = time();
                $result = $categoryName . "-" . $timestamp . "-". $counter;
                $controlAuto = DB::getVar("SELECT url FROM contents WHERE url=?", [$result]);
                $counter++;
            }while($controlAuto);
                var_dump($result);
                exit();
            return $categoryName;
        }
    }
}
// PHP TIMER
// SQL TRANSACTION