<?php
include "../include/config.php";
$content = new Content();
$category = new Category();

if (isset($_POST["addContent"])) {
    $specialURL = isset($_POST["specialURL"]) ? $_POST["specialURL"] : null;
    $checkedTag = isset($_POST["urlTag"]) ? $_POST["urlTag"] : null;
    $checkedCategory = isset($_POST["urlCat"]) ? $_POST["urlCat"] : null;
    $tag = $_POST["tag"];
    $lang = $_SESSION["lang"];
    $category = C($_POST["category"]);
    $title = C($_POST["title"]);
    $editor = C($_POST["editor"]);
    $editorContent = stripslashes($editor);
    $special = $content->createUrl($specialURL);
    $autoUrl = $content->checkedFunction($checkedTag, $checkedCategory, $category, $tag);
    $url = $content->createUrl($title);
    $language = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$lang]);
    $controlTitle = DB::get("SELECT * FROM contents WHERE content_title=?", [$title]);
    if (!$language || !$category || !$title || !$editor) {
        echo "bos";
    } else if ($controlTitle) {
        echo "title";
    } else {
        if ($special) {
            $controlSpecial = DB::get("SELECT * FROM contents WHERE url=?", [$special]);

            if ($controlSpecial) {
                echo "special";
            } else {
                $add = DB::insert("INSERT INTO contents (content_title, content_category, content_language, content_text, url) VALUES (?,?,?,?,?)", [$title, $category, $language, $editor, $special]);
                echo "ok";
                exit;
            }

        } else if ($autoUrl) {
            $controlAuto = DB::get("SELECT * FROM contents WHERE url=?", [$autoUrl]);

            if ($controlAuto) {
                echo "auto";
            } else {
                $add = DB::insert("INSERT INTO contents (content_title, content_category, content_language, content_text, url) VALUES (?,?,?,?,?)", [$title, $category, $language, $editor, $autoUrl]);
                echo "ok";
                exit();
            }

        } else {
            $add = $content->addContent($language, $category, $title, $editorContent, $url);
            echo "ok";
            exit();

        }
    }
}
if (isset($_POST["contentTable"])) {
    $categoryId = isset($_POST["categoryId"]) ? $_POST["categoryId"] : null;
    $languageId = isset($_POST["languageId"]) ? $_POST["languageId"] : null;
    $role_id = $_SESSION["role_id"];
    $page_id = $_POST["id"];
    $lang = $_SESSION["lang"];
    $language = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$lang]);

    if ($categoryId == null || $languageId == null) {
        $data = DB::get("SELECT * FROM contents WHERE content_language=?", [$language]);
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
    $controlList = controlPageList($page_id);


    $response = [];

    foreach ($data as $d) {
        $categoryName = DB::getVar("SELECT category_name FROM category WHERE id=?", [$d->content_category]);
        $languageName = DB::getVar("SELECT lang_name_short FROM languages WHERE id=?", [$d->content_language]);
        $access = DB::getVar("SELECT $languageName FROM roles WHERE id=?", [$role_id]);
        $text_1 = 'Düzenle';
        $text_2 = 'Kaldır';
        $text_3 = 'Görüntüle';
        $translate_1 = (language($text_1)) ? language($text_1) : $text_1;
        $translate_2 = (language($text_2)) ? language($text_2) : $text_2;
        $translate_3 = (language($text_3)) ? language($text_3) : $text_3;

        if ($access == 1) {
            $response[] = [
                "id" => $d->id,
                "title" => $d->content_title,
                "category" => $categoryName,
                "process" => '<div class="d-flex justify-content-center">'
                    . ($controlEdit ? '<a href="editContent/' . $d->url . '"><button type="button" class="btn btn-relief-info btn-sm ">' . $translate_1 . '</button></a><span style="margin:3px;"></span>' : '')
                    . ($controlDelete ? '<button type="button" class="btn btn-relief-danger btn-sm " onclick="deleteContent(' . $d->id . ')"> ' . $translate_2 . ' </button><span style="margin:3px;"></span>' : '')
                    . ($controlList ? '<a href="content/' . $d->url . '"><button type="button" class="btn btn-relief-warning btn-sm " onclick="pageVisit(' . $d->id . ')">' . $translate_3 . '</button></a>' : '')
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
    $text = 'Kategoriye Göre Filtrele ';
    $translate = (language($text)) ? language($text) : $text;
    $text_2 = 'Kategori Seçiniz';
    $translate_2 = (language($text_2)) ? language($text_2) : $text_2;
    $response = "";
    $response .= '
     <label class="form-label-lg "><b> ' . $translate . ' :</b></label>
     <select class="select2 form-control form-control select2-hidden-accessible" data-select2-id="1" aria-hidden="true" id="categoryFilter" name="categoryFilter">
         <option value="" data-select2-id="3" selected="">  ' . $translate_2 . ' </option> ';
    foreach ($data as $d) {
        $response .= '   <option value="' . $d->id . '" data-select2-id="3" >' . $d->category_name . '</option>';
    }
    $response .= '</select>';
    echo $response;
    exit();

}
if (isset($_POST["languageFilter"])) {
    $data = DB::get("SELECT * FROM languages");
    $text = 'Dile Göre Filtrele ';
    $text_2 = 'Dil Seçiniz';
    $translate_2 = (language($text_2)) ? language($text_2) : $text_2;
    $translate = (language($text)) ? language($text) : $text;
    $response = "";
    $response .= '
     <label class="form-label-lg "><b>' . $translate . ' :</b></label>
     <select class="select2 form-control form-control select2-hidden-accessible" data-select2-id="1" aria-hidden="true" id="languageFilter" name="categoryFilter">
         <option value="" data-select2-id="3" selected=""> ' . $translate_2 . ' </option> ';
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
    $allowed_extensions = ['jpg', 'jpeg', 'png'];

    if (in_array($file_extension, $allowed_extensions) && exif_imagetype($_FILES['upload']['tmp_name'])) {
        if (file_exists($_FILES['upload']['tmp_name'])) {
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
    $text = "Etiket Seç";
    $translate = (language($text)) ? language($text) : $text;
    if ($categoryId) {
        $data = DB::get("SELECT * FROM tag_category WHERE category_id=?", [$categoryId]);

        $response = '
      <label for="tag" class="form-label-lg"><b>' . $translate . '</b></label>
        <select class="form-select" id="tag" multiple="multiple">';
        foreach ($data as $d) {
            $tagName = DB::getVar("SELECT tag_name FROM tag WHERE id=?", [$d->tag_id]);
            $response .= '<option value="' . $d->tag_id . '">' . $tagName . '</option>';
        }
        $response .= '</select >';
    } else {
        $response = "";
        $response .= '
            <label for="tag" class="form-label-lg"><b>' . $translate . '</b></label>
            <select class="form-select" id="tag" multiple="multiple">
            </select>';
    }
    echo $response;
    exit;
}
if (isset($_POST["pageVisit"])) {
    $id = C($_POST["id"]);
    $control = DB::get("SELECT * FROM stats WHERE content_id=?", [$id]);
    if ($control) {
        $process = DB::exec("UPDATE stats SET view_count = view_count + 1 WHERE content_id=?", [$id]);
    } else {
        $process = DB::insert("INSERT INTO stats (content_id,view_count) VALUES (?,?)", [$id, 1]);
    }
}
if (isset($_POST["question"])) {
    $question_2 = isset($_POST["number"]) ? $_POST["number"] : null;
    $id=$_POST["id"];
    $user_id=$_SESSION["user"];
    $control=DB::get("SELECT * FROM content_likes WHERE user_id=? AND content_id=?",[$user_id,$id]);
    if ($question_2 == 1) {
        $response = '<h3>Teşekkürler</h3>';
            $insert=DB::insert("INSERT INTO content_likes (user_id,content_id,content_like) VALUES (?,?,?)",[$user_id,$id,1]);
    }else if($question_2 == 2){
        $response = '<h3>Teşekkürler</h3>';
        $insert=DB::insert("INSERT INTO content_likes (user_id,content_id,content_dislike) VALUES (?,?,?)",[$user_id,$id,1]);

    }else if($control){
        $response = '<h3>Teşekkürler</h3>';
    } else if ($question_2 === null) {
        $response = '
        <button type="button" class="btn m-1" onclick="question(1)">Evet</button>
        <button type="button" class="btn m-1" onclick="question(2)">Hayır</button>
        ';
    }

    echo $response;
    exit;
}



?>
