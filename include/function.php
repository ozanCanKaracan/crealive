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
function controlEdit(){
    $page_url=$_GET["target"];
    $role_id=$_SESSION["role_id"];
    $page_id=DB::getVar("SELECT id FROM pages WHERE href=?",[$page_url]);
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
?>



