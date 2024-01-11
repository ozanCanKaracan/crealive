<?php

include "../include/config.php";
if (isset($_POST["languageTable"])) {
    $data = DB::get("SELECT * FROM languages WHERE status = 1 ");
    $response = [];
    if (count($data) > 0) {
        foreach ($data as $d) {
    $shortName= strtoupper($d->lang_name_short);
            $response[] = [
                "id" => $d->id,
                "lang_name" => $d->lang_name . '       <i class="flag-icon flag-icon-'.$d->lang_name_short.'"></i>',
                "lang_short" => $shortName,
                "process" => '<button type="button" class="btn btn-danger btn-sm">Kaldır</button>',
            ];
        }
    }

    echo json_encode(["recordsTotal" => count($data), "recordsFiltered" => count($data), "data" => $response]);
    exit();
}
if(isset($_POST["addLangPackage"])){
    $id = $_POST["selectedLang"];
    $apiKey = "AIzaSyBdH8gjaAKplDXc_rxfTAHI9wCjxTO_U70";
    $targetLanguage = DB::getVar("SELECT lang_name_short FROM languages WHERE id=?", [$id]);

    $statusChange=DB::exec("UPDATE languages SET status = 1 WHERE id=?",[$id]);

    $texts = DB::get("SELECT * FROM texts");
    foreach ($texts as $text) {
        $untranslatedText=$text->text;
        $originalTextID=$text->text_id;
        $translatedText = translateText($untranslatedText, $targetLanguage, $apiKey, $originalTextID, $id);

     echo $translatedText;

    }
}

