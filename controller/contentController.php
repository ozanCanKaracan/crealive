<?php
include "../include/config.php";
$content = new Content();
$category = new Category();

if (isset($_POST["addContent"])) {
    $specialURL = isset($_POST["specialURL"]) ? $_POST["specialURL"] : null;
    $tag = $_POST["tag"];
    $language = C($_POST["language"]);
    $category = C($_POST["category"]);
    $title = C($_POST["title"]);
    $editor = C($_POST["editor"]);
    $editorContent = stripslashes($editor);
    $special = $content->createUrl($specialURL);
    $url = $content->createUrl($title);

    if (!$language || !$category || !$title || !$editor) {
        echo "bos";
    } else {
        $add = $content->addContent($language, $category, $title, $editorContent);
        echo "ok";
    }
}
if (isset($_POST["contentTable"])) {
    $categoryId = isset($_POST["categoryId"]) ? $_POST["categoryId"] : null;
    $languageId = isset($_POST["languageId"]) ? $_POST["languageId"] : null;
    $role_id = $_SESSION["role_id"];
    $page_id = $_POST["id"];

    if ($categoryId == null || $languageId == null) {
        $data = DB::get("SELECT * FROM contents");
    }
    if ($categoryId and $languageId) {
        $data = DB::get("SELECT * FROM contents WHERE content_category=? AND content_language=?", [$categoryId, $languageId]);
    } else if ($categoryId) {
        $data = DB::get("SELECT * FROM contents WHERE content_category=?", [$categoryId]);
    } else if ($languageId) {
        $data = DB::get("SELECT * FROM contents WHERE content_language=?", [$languageId]);
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
if (isset($_POST["languageFilter"])) {
    $data = DB::get("SELECT * FROM languages");
    $response = "";
    $response .= '
     <label class="form-label-lg "><b>Dile Göre Filtrele :</b></label>
     <select class="select2 form-control form-control select2-hidden-accessible" data-select2-id="1" aria-hidden="true" id="languageFilter" name="categoryFilter">
         <option value="" data-select2-id="3" selected=""> Dil Seçiniz</option> ';
    foreach ($data as $d) {
        $response .= '   <option value="' . $d->id . '" data-select2-id="3" >' . $d->lang_name . '</option>';
    }
    $response .= '</select>';
    echo $response;
    exit();
}
if (isset($_FILES['upload']['name'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $data = [];
    $file_name = basename($_FILES['upload']['name']);
    $file_path = '../uploads/' . $file_name;
    $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    $file_pathORG = 'uploads/' . $file_name;
    // İzin verilen dosya uzantıları
    $allowed_extensions = ['jpg', 'jpeg', 'png'];

    // Dosya uzantısı ve format kontrolü
    if (in_array($file_extension, $allowed_extensions) && exif_imagetype($_FILES['upload']['tmp_name'])) {
        // Dosya varlığını kontrol etme
        if (file_exists($_FILES['upload']['tmp_name'])) {
            // Dosyayı güvenli bir şekilde taşıma
            if (move_uploaded_file($_FILES['upload']['tmp_name'], $file_path)) {
                $data['file'] = $file_name;
                $data['url'] = $file_pathORG;
                $data['uploaded'] = 1;
            } else {
                $data['uploaded'] = 0;
                $data['error']['message'] = 'Hata! Dosya yüklenemedi';
            }
        } else {
            $data['uploaded'] = 0;
            $data['error']['message'] = 'Dosya bulunamadı';
        }
    } else {
        $data['uploaded'] = 0;
        $data['error']['message'] = 'Geçersiz dosya uzantısı veya dosya formatı';
    }

    echo json_encode($data);
}
if (isset($_POST["editContent"])) {
    $id = C($_POST["id"]);
    $language = C($_POST["language"]);
    $category = C($_POST["category"]);
    $title = C($_POST["title"]);
    $description = C($_POST["description"]);
    $editor = C($_POST["editor"]);
    $editorContent = stripslashes($editor);

    if (!$language || !$category || !$title || !$description || !$editor) {
        echo "bos";
    } else {
        $update = $content->updateContent($category, $language, $title, $description, $editorContent, $id);
        echo "ok";
    }
}
if (isset($_POST["tagSelect"])) {
    $categoryId = isset($_POST["categoryId"]) ? $_POST["categoryId"] : null;
    if ($categoryId) {
        $data = DB::get("SELECT * FROM tag_category WHERE category_id=?", [$categoryId]);
        $response = '
      <label for="tag" class="form-label-lg"><b>Etiket Seçimi</b></label>
        <select class="form-select" id="tag" multiple="multiple">';
        foreach ($data as $d) {
            $tagName=DB::getVar("SELECT tag_name FROM tag WHERE id=?",[$d->tag_id]);
            $response .= '<option value="' . $d->id . '">' . $tagName . '</option>';
        }
        $response.='</select >';
    }
}
?>
