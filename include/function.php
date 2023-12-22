<?php

function C($text)
{
    return trim(strip_tags(htmlspecialchars(addslashes($text))));
}

function controlAdd(){
    $page_url=$_GET["target"];
    $role_id=$_SESSION["role_id"];
    $page_id=DB::getVar("SELECT id FROM pages WHERE href=?",[$page_url]);
    $control=DB::getVar("SELECT permission_add FROM permission WHERE page_id=? AND role_id=?",[$page_id,$role_id]);
    return $control ? true : false ;
}
function controlDelete(){
    $page_url=$_GET["target"];
    $role_id=$_SESSION["role_id"];
    $page_id=DB::getVar("SELECT id FROM pages WHERE href=?",[$page_url]);
    $control=DB::getVar("SELECT permission_delete FROM permission WHERE page_id=? AND role_id=?",[$page_id,$role_id]);
    return $control ? true : false ;
}
function controlDeleteBack($page_id){
    $role_id=$_SESSION["role_id"];
    $control=DB::getVar("SELECT permission_delete FROM permission WHERE page_id=? AND role_id=?",[$page_id,$role_id]);
    return $control ? true : false ;
}
function controlEdit($page_id){
    $role_id=$_SESSION["role_id"];
    $control=DB::getVar("SELECT permission_edit FROM permission WHERE page_id=? AND role_id=?",[$page_id,$role_id]);
    return $control ? true : false ;
}
function controlList(){
    $page_url=$_GET["target"];
    $role_id=$_SESSION["role_id"];
    $page_id=DB::getVar("SELECT id FROM pages WHERE href=?",[$page_url]);
    $control=DB::getVar("SELECT permission_list FROM permission WHERE page_id=? AND role_id=?",[$page_id,$role_id]);
    return $control ? true : false ;
}
function controlView($page_id){

    $role_id=$_SESSION["role_id"];
    $control=DB::getVar("SELECT permission_view FROM permission WHERE page_id=? AND role_id=?",[$page_id,$role_id]);
    return $control ? true : false ;
}

function access($href)
{
    $role_id=$_SESSION["role_id"];
    $page_id=DB::getVar("SELECT id FROM pages WHERE href=?",[$href]);
    $control=DB::getVar("SELECT permission_view FROM permission WHERE page_id=? AND role_id=?",[$page_id, $role_id]);

    return $control ? true : false;

}
function languageAcces(){
    $slug=$_GET["slug"];
    $role_id=$_SESSION["role_id"];
    $id=DB::getVar("SELECT id FROM contents WHERE url=?",[$slug]);
    $content=DB::getVar("SELECT content_language FROM contents WHERE id=?",[$id]);
    $languageName = DB::getVar("SELECT lang_name_short FROM languages WHERE id=?", [$content]);
    $access = DB::getVar("SELECT $languageName FROM roles WHERE id=?", [$role_id]);

    return $access ? true : false;
}
function language($text){
    $languageName=$_SESSION["lang"];
    $languageID=DB::getVar("SELECT id FROM languages WHERE lang_name_short=?",[$languageName]);
    $text_id=DB::getVar("SELECT text_id FROM texts WHERE text=?",[$text]);
    $translated_text=DB::getVar("SELECT translated_text FROM translations WHERE text_id=? AND language_id=?",[$text_id,$languageID]);

    return $translated_text;
}
?>



