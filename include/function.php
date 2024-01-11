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
function controlDeleteBack($page_id){
    $role_id=$_SESSION["role_id"];
    $control=DB::getVar("SELECT permission_delete FROM permission WHERE page_id=? AND role_id=?",[$page_id,$role_id]);
    return $control ? true : false ;
}
function controlPageList($page_id){
    $role_id=$_SESSION["role_id"];
    $control=DB::getVar("SELECT permission_list FROM permission WHERE page_id=? AND role_id=?",[$page_id,$role_id]);
    return $control ? true : false ;
}
function controlEdit($page_id){
    $role_id=$_SESSION["role_id"];
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
function languageAcces(){

    $slug=$_GET["slug"];
    $user_id=$_SESSION["user"];
    $content_id=DB::getVar("SELECT id FROM contents WHERE url=?",[$slug]);
    $language_id=DB::getVar("SELECT content_language FROM contents WHERE id=?",[$content_id]);
    $access = DB::getVar("SELECT status FROM language_permission WHERE user_id=? AND language_id=?", [$user_id,$language_id]);
    return $access ? true : false;
}
function language($text){
    $languageName=$_SESSION["lang"];
    $languageID=DB::getVar("SELECT id FROM languages WHERE lang_name_short=?",[$languageName]);
    $text_id=DB::getVar("SELECT text_id FROM texts WHERE text=?",[$text]);
    $translated_text=DB::getVar("SELECT translated_text FROM translations WHERE text_id=? AND language_id=?",[$text_id,$languageID]);

    return $translated_text;
}
function translateText($text, $targetLanguage, $apiKey, $originalTextID, $languageID) {
    $endpoint = 'https://translation.googleapis.com/language/translate/v2';

    $queryParams = [
        'key' => $apiKey,
        'q' => $text,
        'target' => $targetLanguage,
    ];

    $url = $endpoint . '?' . http_build_query($queryParams);

    $response = file_get_contents($url);

    $data = json_decode($response, true);

    if ($data && isset($data['data']['translations'][0]['translatedText'])) {
        $translatedText = $data['data']['translations'][0]['translatedText'];

        // İşlem başarılı, ancak çeviri hakkında bir sorun olabilir
        if (isset($data['data']['translations'][0]['detectedSourceLanguage'])) {
            $detectedSourceLanguage = $data['data']['translations'][0]['detectedSourceLanguage'];
          // Log kaydı ekleme için
        }

        $insertQuery = DB::insert("INSERT INTO translations (text_id, translated_text, language_id) VALUES (?, ?, ?)",[$originalTextID,$translatedText,$languageID]);

        return "Çeviri Başarılı";
    } else {
        $errorDetails = isset($data['error']['message']) ? $data['error']['message'] : 'Çeviri Hatası';
        return 'Translation Error: ' . $errorDetails;
    }
}


?>



