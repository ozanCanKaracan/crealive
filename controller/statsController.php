<?php
include "../include/config.php";

if(isset($_POST["top_5"])){

    $lang = $_SESSION["lang"];
    $language = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$lang]);
    $data=DB::get("SELECT * FROM stats");

    $response = [];

    foreach ($data as $d) {
        $count=DB::get("SELECT * FROM contents WHERE id=? AND content_language=?",[$d->content_id,$language]);
        foreach ($count as $c) {
            $categoryName = DB::getVar("SELECT category_name FROM category WHERE id=?", [$c->content_category]);

            $response[] = [
                "id" => $c->id,
                "title" => $c->content_title,
                "category" => $categoryName,
                "process" => '',
            ];
        }

    }

    echo json_encode(["recordsTotal" => count($response), "recordsFiltered" => count($response), "data" => $response]);
    exit();
}