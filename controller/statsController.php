<?php
include "../include/config.php";

if (isset($_POST["top_5"])) {
    $lang = $_SESSION["lang"];
    $language = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$lang]);
    $text_3 = 'Görüntüle';
    $translate_3 = (language($text_3)) ? language($text_3) : $text_3;

    $data = DB::get("SELECT c.id, c.content_title, c.content_category,c.url
                    FROM stats s
                    JOIN contents c ON s.content_id = c.id
                    WHERE c.content_language = ?
                    ORDER BY s.view_count DESC
                    LIMIT 5", [$language]);

    $response = [];

    foreach ($data as $c) {
        $categoryName = DB::getVar("SELECT category_name FROM category WHERE id=?", [$c->content_category]);

        $response[] = [
            "id" => $c->id,
            "title" => $c->content_title,
            "category" => $categoryName,
            "process" => '<a href="content/' . $c->url . '"><button type="button" class="btn btn-relief-warning btn-sm " onclick="pageVisit(' . $c->id . ')">' . $translate_3 . '</button></a>',
        ];
    }

    echo json_encode(["recordsTotal" => count($response), "recordsFiltered" => count($response), "data" => $response]);
    exit();
}
