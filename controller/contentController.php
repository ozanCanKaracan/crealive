<?php
include "../include/config.php";
$content=new Content();
if(isset($_POST["addContent"])){
    $language=C($_POST["language"]);
    $category=C($_POST["category"]);
    $title=C($_POST["title"]);
    $description=C($_POST["description"]);
    $editor=C($_POST["editor"]);

    if(!$language || !$category || !$title || !$description || !$editor){
        echo "bos";
    }else{
        $add=$content->addContent($language,$category,$title,$description,$editor);
        echo "ok";
    }
}

?>