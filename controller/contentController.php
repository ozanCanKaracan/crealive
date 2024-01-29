<?php
include "../include/config.php";
$content = new Content();
$category = new Category();

if (isset($_POST["addContent"])) {
    $checkedTag = isset($_POST["urlTag"]) && is_numeric($_POST["urlTag"]) ? (int)$_POST["urlTag"] : null;
    $checkedCategory = isset($_POST["urlCat"]) && is_numeric($_POST["urlCat"]) ? (int)$_POST["urlCat"] : null;
    $tag = isset($_POST["tag"]) && is_numeric($_POST["tag"]) ? (int)$_POST["tag"] : null;

    $specialURL = isset($_POST["specialURL"]) && is_string($_POST["specialURL"]) ? $_POST["specialURL"] : null;
    $translatedText = isset($_POST["translatedText"]) && is_string($_POST["translatedText"]) ? $_POST["translatedText"] : null;
    $translatedTitle = isset($_POST["translatedTitle"]) && is_string($_POST["translatedTitle"]) ? $_POST["translatedTitle"] : null;
    $translateLanguage = isset($_POST["translateLanguage"]) && is_string($_POST["translateLanguage"]) ? $_POST["translateLanguage"] : null;

    $lang = $_SESSION["lang"];
    $category = C($_POST["category"]);
    $title = C($_POST["title"]);
    $editor = C($_POST["editor"]);

    if ($checkedCategory || $checkedTag) {
        $autoUrl = $content->checkedFunction($checkedTag, $checkedCategory, $category, $tag);
    }
    if ($specialURL) {
        $special = $content->createUrl($specialURL);
    }
    $editorContent = stripslashes($editor);
    $url = $content->createUrl($title);
    $user_id = $_SESSION["user"];
    $language = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$lang]);
    $controlTitle = DB::getVar("SELECT content_title FROM contents WHERE content_title=?", [$title]);
    if(!$category){
        echo "categoryNull";
    }elseif(!$title){
        echo "titleNull";
    }elseif(!$editor){
        echo "editorNull";
    } else if ($controlTitle) {
        echo "title";
    } else {
        if ($special) {
            $controlSpecial = DB::getVar("SELECT url FROM contents WHERE url=?", [$special]);
            if ($controlSpecial) {
                echo "special";
            } else {

                $add = DB::insert("INSERT INTO contents (content_title, content_category, content_language, content_text, url) VALUES (?,?,?,?,?)", [$title, $category, $language, $editor, $special]);
                if (!$add) {
                    echo "Database Error" . DB::getLastError($add);
                    echo "hata";
                } else {
                    $lastID = DB::lastInsertID($add);
                    if ($translatedText) {
                        $translateLangID = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$translateLanguage]);
                        $add = DB::insert("INSERT INTO translated_contents (user_id,content_id,language_id,title,text) VALUES (?,?,?,?,?)", [$user_id, $lastID, $translateLangID, $translatedTitle, $translatedText]);
                    }
                    echo "ok";
                    exit();
                }
            }
        } else if ($autoUrl) {
            $controlAuto = DB::getVar("SELECT url FROM contents WHERE url=?", [$autoUrl]);
            if ($controlAuto) {
                echo "auto";
            } else {
                $add = DB::insert("INSERT INTO contents (content_title, content_category, content_language, content_text, url) VALUES (?,?,?,?,?)", [$title, $category, $language, $editor, $autoUrl]);
                if (!$add) {
                    echo "Database Error" . DB::getLastError($add);
                    echo "hata";
                } else {
                    $lastID = DB::lastInsertID($add);

                    DB::getLastError($add);
                    if ($translatedText) {
                        $translateLangID = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$translateLanguage]);
                        $add = DB::insert("INSERT INTO translated_contents (user_id,content_id,language_id,title,text) VALUES (?,?,?,?,?)", [$user_id, $lastID, $translateLangID, $translatedTitle, $translatedText]);
                    }
                    echo "ok";
                    exit();
                }
            }
        } else {
            $add = $content->addContent($language, $category, $title, $editorContent, $url);
            if (!$add) {
                echo "Database Error" . DB::getLastError($add);
                echo "hata";
            } else {
                $lastID = DB::lastInsertID($add);
                if ($translatedText) {
                    $translateLangID = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$translateLanguage]);
                    $add = DB::insert("INSERT INTO translated_contents (user_id,content_id,language_id,title,text) VALUES (?,?,?,?,?)", [$user_id, $lastID, $translateLangID, $translatedTitle, $translatedText]);
                }
                echo "ok";
                exit();
            }
        }
    }
}
if (isset($_POST["contentTable"])) {
    $categoryId = isset($_POST["categoryId"]) && is_numeric($_POST["categoryId"]) ? (int)$_POST["categoryId"] : null;
    $languageId = isset($_POST["languageId"]) && is_numeric($_POST["languageId"]) ? (int)$_POST["languageId"] : null;
    $user_id = $_SESSION["user"];
    $page_id = $_POST["id"];
    $lang = $_SESSION["lang"];

    $language = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$lang]);
    if ($categoryId == null || $languageId == null) {

        $firstQuery = DB::get("SELECT 'contents' as 'table', content_title, content_category, id FROM contents WHERE content_language = ?", [$language]);
        $secondQuery = DB::get("SELECT 'translate' as 'table', content_id , title as content_title, (SELECT content_category FROM contents WHERE id = content_id) AS content_category, id FROM translated_contents WHERE language_id = ?", [$language]);
        $data = array_merge($firstQuery, $secondQuery);
    }
    if ($categoryId and $languageId) {
        $data = DB::get("SELECT * FROM contents WHERE content_category=? AND content_language=?", [$categoryId, $languageId]);
    } else if ($categoryId) {
        $data = DB::get("SELECT * FROM contents WHERE content_category=?", [$categoryId]);
    } else if ($languageId) {
        $data = DB::get("SELECT * FROM contents WHERE content_language=?", [$languageId]);
    }
    $controlEdit = controlEdit($page_id,$language);
    $controlDelete = controlDeleteBack($page_id,$language);
    $controlList = controlPageList($page_id,$language);


    $response = [];

    foreach ($data as $d) {

        if(isset($d->table)){
            if ($d->table === 'translate'){
                $categoryName = DB::getVar("SELECT category_name FROM category WHERE id=?", [$d->content_category]);
                $url = DB::getVar("SELECT url FROM contents WHERE id=?",[$d->content_id]);
                $response[] = [
                    "id" => $d->content_id,
                    "url" => $url,
                    "title" => $d->content_title,
                    "category" => $categoryName,
                    "process" => [
                        "edit" => $controlEdit,
                        "delete" => $controlDelete,
                        "list" => $controlList,
                        "translate"=>true,
                    ],
                ];
            }
        }if (isset($d->table)){
            if ($d->table === 'contents'){
                $categoryName = DB::getVar("SELECT category_name FROM category WHERE id=?", [$d->content_category]);
                $url = DB::getVar("SELECT url FROM contents WHERE id=?",[$d->id]);

                $response[] = [
                    "id" => $d->id,
                    "url" => $url,
                    "title" => $d->content_title,
                    "category" => $categoryName,
                    "process" => [
                        "edit" => $controlEdit,
                        "delete" => $controlDelete,
                        "list" => $controlList,
                    ],
                ];
            }
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
if (isset($_POST["deleteTranslatedContent"])) {
    $id = C($_POST["id"]);
    $delete = DB::exec("DELETE FROM translated_contents WHERE content_id=? ",[$id]);
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
/*if (isset($_POST["languageFilter"])) {
    $data = DB::getVar("SELECT id,lang_name FROM languages");
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
}*/
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
    $categoryId = isset($_POST["categoryId"]) && is_numeric($_POST["categoryId"]) ? (int)$_POST["categoryId"] : null;
    $text = "Etiket Seç";
    $translate = (language($text)) ? language($text) : $text;
    if ($categoryId) {
        $data = DB::get("SELECT tag_id FROM tag_category WHERE category_id=?", [$categoryId]);
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
    $user_id = $_SESSION["user"];
    $cookieName = "visited_pages_user" . $user_id;

    // Eğer daha önce bir cookie varsa, değerini al, yoksa boş bir dizi oluştur
    $visitedPages = isset($_COOKIE[$cookieName]) ? json_decode($_COOKIE[$cookieName], true) : array();

    // Eğer ziyaret edilen sayfa daha önce eklenmemişse, ekle
    if (!in_array($id, $visitedPages)) {
        $visitedPages[] = $id;
        // Cookie'yi güncelle
        setcookie($cookieName, json_encode($visitedPages), time() + (86400 * 30), "/");
    }   // Stats tablosunu güncelle
    $control = DB::getVar("SELECT 1 FROM stats WHERE content_id=?", [$id]);
    if ($control == true) {
        var_dump($id);
        $process = DB::exec("UPDATE stats SET view_count = view_count + 1, updated_date = NOW() WHERE content_id=?", [$id]);
    } else {
        $process = DB::insert("INSERT INTO stats (content_id,view_count,updated_date) VALUES (?,?,NOW())", [$id, 1]);
    }
}
if (isset($_POST["question"])) {
    $question_2 = isset($_POST["number"]) && is_numeric($_POST["number"]) ? (int)$_POST["number"] : null;
    $id = $_POST["id"];
    $user_id = $_SESSION["user"];

    // Beğenme ve beğenmeme için ayrı cookie isimleri
    $likeCookieName = "liked_contents" . $user_id;
    $dislikeCookieName = "disliked_contents" . $user_id;

    // İlgili cookie'yi kontrol et ve gerekirse oluştur
    $likedContentsLike = isset($_COOKIE[$likeCookieName]) ? json_decode($_COOKIE[$likeCookieName], true) : array();
    $likedContentsDislike = isset($_COOKIE[$dislikeCookieName]) ? json_decode($_COOKIE[$dislikeCookieName], true) : array();
    $response ='';
    if (!in_array($id, $likedContentsLike) && !in_array($id, $likedContentsDislike)) {
        if ($question_2 == 1) {
            $likedContentsLike[] = $id;
            setcookie($likeCookieName, json_encode($likedContentsLike), time() + (86400 * 30), "/");
            $response = '<h3>Teşekkürler</h3>';
            $update = DB::exec("UPDATE stats SET content_likes = content_likes + 1 WHERE content_id=?",[$id]);
        } else if ($question_2 == 2) {
            $likedContentsDislike[] = $id;
            setcookie($dislikeCookieName, json_encode($likedContentsDislike), time() + (86400 * 30), "/");
            $response = '<h3>Teşekkürler</h3>';
            $update = DB::exec("UPDATE stats SET content_dislikes = content_dislikes + 1 WHERE content_id=?",[$id]);
        } else if ($question_2 === null) {
            $response = '
        <button type="button" class="btn m-1" onclick="question(1)">Evet</button>
        <button type="button" class="btn m-1" onclick="question(2)">Hayır</button>
        ';

        }

    }
    echo $response;
    exit;

}

?>
