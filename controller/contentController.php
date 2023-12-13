<?php
include "../include/config.php";
$content = new Content();
if (isset($_POST["addContent"])) {
    $language = C($_POST["language"]);
    $category = C($_POST["category"]);
    $title = C($_POST["title"]);
    $description = C($_POST["description"]);
    $editor = C($_POST["editor"]);

    if (!$language || !$category || !$title || !$description || !$editor) {
        echo "bos";
    } else {
        $add = $content->addContent($language, $category, $title, $description, $editor);
        echo "ok";
    }
}
if (isset($_POST["contentTable"])) {
    $role_id = $_SESSION["role_id"];
    $page_id = $_POST["id"];
    $data = $content->getContent();
    $controlEdit = controlEdit($page_id);
    $controlDelete = controlDeleteBack($page_id);
    $response = [];

    if (count($data) > 0) {
        foreach ($data as $d) {
            $categoryName = DB::getVar("SELECT category_name FROM category WHERE id=?", [$d->content_category]);
            $languageName = DB::getVar("SELECT lang_name_short FROM languages WHERE id=?", [$d->content_language]);
            $access = DB::getVar("SELECT $languageName FROM roles WHERE id=?", [$role_id]);

            if ($access == 1) {
                $response[] = [
                    "id" => $d->id,
                    "title" => $d->content_title,
                    "desc" => $d->content_desc,
                    "category" => $categoryName,
                    "process" => '<div class="d-flex justify-content-center">'
                        . (($controlEdit) ? '<button type="button" class="btn btn-relief-info btn-sm" onclick="editContent()">Düzenle</button><span style="margin:3px;"></span>' : '')
                        . (($controlDelete) ? '<button type="button" class="btn btn-relief-danger btn-sm" onclick="deleteContent()">Sil</button>' : '')
                        . '</div>',
                ];
            }

        }
    }

    echo json_encode(["recordsTotal" => count($data), "recordsFiltered" => count($data), "data" => $response]);
    exit();
}


?>