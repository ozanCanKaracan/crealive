<?php

include "../include/config.php";
$languageClass = new Language();
if (isset($_POST["languageTable"])) {
    $data = DB::get("SELECT * FROM languages WHERE status = 1 ");
    $response = [];
    if (count($data) > 0) {
        foreach ($data as $d) {
            $shortName = strtoupper($d->lang_name_short);
            $languageShort = $d->lang_name_short;
            $languageShort = ($languageShort == 'en') ? 'us' : $languageShort;
            $shortName = ($shortName == 'en') ? 'us' : $shortName;
            $text = $d->lang_name;
            $translate = (language($text)) ? language($text) : $text;
            $d_noneShortTag= ($languageShort == 'en') ? 'us' : $languageShort;
            $response[] = [
                "id" => $d->id,
                "lang_dnone" =>$translate,
                "lang_short_dnone" => $d_noneShortTag,
                "lang_name" => [
                    "flag"=>true,
                ],
                "lang_short" => $shortName,
                "process" => [
                    "button" => true,
                ],
            ];
        }
    }
    echo json_encode(["recordsTotal" => count($response), "recordsFiltered" => count($response), "data" => $response]);
    exit();
}
if (isset($_POST["addLangPackage"])) {
    $id = $_POST["selectedLang"];
    $apiKey = "AIzaSyBdH8gjaAKplDXc_rxfTAHI9wCjxTO_U70";
    $targetLanguage = DB::getVar("SELECT lang_name_short FROM languages WHERE id=?", [$id]);

    $statusChange = DB::exec("UPDATE languages SET status = 1 WHERE id=?", [$id]);
    if (empty($id)) {
        echo "empty";
    } else {
        $texts = DB::get("SELECT text_id,text FROM texts");
        foreach ($texts as $text) {
            $untranslatedText = $text->text;
            $originalTextID = $text->text_id;
            $translatedText = translateText($untranslatedText, $targetLanguage, $apiKey, $originalTextID, $id);
        }
        echo "ok";
    }
}
if (isset($_POST["selectLanguage"])) {
    if (@$_GET['lang']) {
        $selectedLanguage = $_GET['lang'];
        $_SESSION['lang'] = $selectedLanguage;
    } elseif ($_SESSION['lang']) {
        //url'de yoksa sessionda var ise bunu çalıştır
        $selectedLanguage = $_SESSION['lang'];
    } else {
        // kullanıcı tarayıcı dili
        $browserLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $result = substr($browserLanguage, 0, 2);
        $selectedLanguage = DB::getVar("SELECT lang_name_short FROM languages WHERE lang_name_short=?", [$result]);
        $_SESSION['lang'] = $selectedLanguage;
    }

    $fullName = DB::getVar("SELECT lang_name FROM languages WHERE lang_name_short=?", [$selectedLanguage]);
    $translate = (language($fullName)) ? language($fullName) : $fullName;
    $allLanguages = DB::get("SELECT id,lang_name,lang_name_short FROM languages WHERE status = 1 ORDER BY id ASC");
    $response = [];

    foreach ($allLanguages as $language) {
        $langName = $language->lang_name;
        $translate = (language($langName)) ? language($langName) : $langName;
        $languageShort = $language->lang_name_short;
        $isActive = ($selectedLanguage == $languageShort) ? 'active' : '';
        $control = $languageClass->controlUserLanguage($language->id);

        if ($control === true) {
            $languageFlag = ($languageShort == "en") ? "us" : $languageShort;

            $response[] = [
                'isActive' => $isActive,
                'lang_name_short' => $languageShort,
                'translate' => $translate,
                'languageFlag' => $languageFlag,
            ];
        }
    }

    echo json_encode($response);
    exit;
}

if (isset($_POST["removeLanguage"])) {
    $id = C($_POST["id"]);
    $selectedLanguage = $_SESSION["lang"];
    $langID = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$selectedLanguage]);

    if ($id == $langID) {
        echo "error";
    } else {
        $update = DB::exec("UPDATE languages SET status=0 WHERE id=?", [$id]);
        echo "ok";
    }

}