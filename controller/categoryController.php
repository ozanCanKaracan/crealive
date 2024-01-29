<?php

include "../include/config.php";
$category = new Category();
$content = new Content();

if (isset($_POST["categoryAdd"])) {
    $categoryName = C($_POST["categoryName"]);

    $categoryControl = $category->controlAddCategory($categoryName);
    if (empty($categoryName)) {
        echo "bos";
    } else if ($categoryControl) {
        echo "hata";
    } else {
        $add = $category->addCategory($categoryName);
        echo "ok";
        exit();
    }
}
if (isset($_POST["deleteCategory"])) {
    $categoryID = C($_POST["id"]);
    if (!$categoryID) {
        echo "bos";
    } else {
        $control = $content->controlContent($categoryID);
        if ($control) {
            echo "hata";
        } else {
            $delete = $category->deleteCategory($categoryID);
            echo "ok";
        }
    }
}