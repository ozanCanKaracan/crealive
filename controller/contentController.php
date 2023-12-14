<?php
include "../include/config.php";
$content = new Content();
$category = new Category();
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
    $categoryId = $_POST["categoryID"];
    $role_id = $_SESSION["role_id"];
    $page_id = $_POST["id"];

    if ($categoryId == null) {
        $data = DB::get("SELECT * FROM contents");
    } else {
        $data = DB::get("SELECT * FROM contents WHERE content_category=?", [$categoryId]);
    }

    $controlEdit = controlEdit($page_id);
    $controlDelete = controlDeleteBack($page_id);
    $response = [];

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
                    . ($controlEdit ? '<a href="editContent/' . $d->id . '"><button type="button" class="btn btn-relief-info btn-sm" onclick="editContent()">Düzenle</button></a><span style="margin:3px;"></span>' : '')
                    . ($controlDelete ? '<button type="button" class="btn btn-relief-danger btn-sm" onclick="deleteContent(' . $d->id . ')">Sil</button>' : '')
                    . '</div>',
            ];
        }
    }

    echo json_encode(["recordsTotal" => count($response), "recordsFiltered" => count($response), "data" => $response]);
    exit();
}

if (isset($_POST["deleteContent"])) {
    $id = C($_POST["id"]);
    $delete = $content->deleteContent($id);
    echo "ok";
    exit();
}
if (isset($_POST["categoryFilter"])) {
    $data = $category->getCategory();
    $response = "";
    $response .= '
     <label class="form-label-lg "><b>Kategoriye Göre Filtrele :</b></label>
     <select class="select2 form-control form-control select2-hidden-accessible" data-select2-id="1" aria-hidden="true" id="categoryFilter" name="categoryFilter">
         <option value="" data-select2-id="3" selected=""> Kategori Seçiniz</option> ';
    foreach ($data as $d) {
        $response .= '   <option value="' . $d->id . '" data-select2-id="3" >' . $d->category_name . '</option>';
    }
    $response .= '</select>';
    echo $response;
    exit();

}
?>