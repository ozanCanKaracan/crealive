<?php
include "../include/config.php";

if (isset($_POST["top_5"])) {
    $lang = $_SESSION["lang"];
    $language = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$lang]);
    $text_3 = 'Görüntüle';
    $translate_3 = (language($text_3)) ? language($text_3) : $text_3;

    $data = DB::get("SELECT c.id, c.content_title, c.content_category, c.url
                    FROM stats s
                    JOIN contents c ON s.content_id = c.id
                    WHERE c.content_language = ?
                    ORDER BY s.updated_date DESC, s.view_count DESC
                    LIMIT 5", [$language]);

    $response = [];
    foreach ($data as $d) {
        $categoryName = DB::getVar("SELECT category_name FROM category WHERE id=?", [$d->content_category]);
        $url = DB::getVar("SELECT url FROM contents WHERE id=?", [$d->id]);
        $response[] = [
            "id" => $d->id,
            "url" => $url,
            "title" => $d->content_title,
            "category" => $categoryName,
            "process" => [
                "text" => $translate_3,
                "button" => true,
            ],
        ];
    }

    echo json_encode(["recordsTotal" => count($response), "recordsFiltered" => count($response), "data" => $response]);
    exit();
}
if (isset($_POST["statsTable"])) {
    $filter = isset($_POST["filter"]) && is_numeric($_POST["filter"]) ? intval($_POST["filter"]) : null;
    $language = $_SESSION["lang"];
    $langID = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$language]);
    $data = DB::get("SELECT id,content_title,content_category FROM contents WHERE content_language=?", [$langID]);
    $response = [];
    $maxConversionRate = 0;
    $maxStat = 0;
    $maxConversionRateContent = null;
    $maxStatContent = null;

    foreach ($data as $d) {
        $categoryName = DB::getVar("SELECT category_name FROM category WHERE id=?", [$d->content_category]);

        $totalLikesAndDislikes = DB::getRow("SELECT content_likes, content_dislikes FROM stats WHERE content_id = ?", [$d->id]);

        if ($totalLikesAndDislikes !== false && is_object($totalLikesAndDislikes)) {
            $likeCount = $totalLikesAndDislikes->content_likes;
            $dislikeCount = $totalLikesAndDislikes->content_dislikes;
        } else {

            $totalLikesAndDislikes = null;
        }


        $stat = DB::getVar("SELECT view_count FROM stats WHERE content_id=?", [$d->id]);
        $totalVotes = $likeCount + $dislikeCount;
        $conversionRate = ($stat > 0 && $totalVotes > 0) ? ($totalVotes / $stat) * 100 : 0;
        $conversionRate = round($conversionRate, 2);

        if ($filter == 1) {
            if ($conversionRate > $maxConversionRate) {
                $maxConversionRate = $conversionRate;
                $maxConversionRateContent = [
                    "id" => $d->id,
                    "title" => $d->content_title,
                    "category" => $categoryName,
                    "like" => $likeCount,
                    "dislike" => $dislikeCount,
                    "conversion_rate" => '%' . $conversionRate,
                    "view" => $stat
                ];
            }
        } else if ($filter == 2) {
            if ($stat > $maxStat) {
                $maxStat = $stat;
                $maxStatContent = [
                    "id" => $d->id,
                    "title" => $d->content_title,
                    "category" => $categoryName,
                    "like" => $likeCount,
                    "dislike" => $dislikeCount,
                    "conversion_rate" => '%' . $conversionRate,
                    "view" => $stat
                ];
            }
        } else {
            $response[] = [
                "id" => $d->id,
                "title" => $d->content_title,
                "category" => $categoryName,
                "like" => $likeCount,
                "dislike" => $dislikeCount,
                "conversion_rate" => '%' . $conversionRate,
                "view" => $stat
            ];
        }
    }

    if ($filter == 1 && $maxConversionRateContent !== null) {
        $response[] = $maxConversionRateContent;
    } else if ($filter == 2 && $maxStatContent !== null) {
        $response[] = $maxStatContent;
    }

    echo json_encode(["recordsTotal" => count($response), "recordsFiltered" => count($response), "data" => $response]);
    exit();
}
if (isset($_POST["statsFilter"])) {
    $text_1 = "Filtrele";
    $text_2 = 'Filtre Seçin';
    $text_3 = 'En Çok Dönüşüm Alan';
    $text_4 = 'En Çok Ziyaret Edilen';
    $translate_1 = (language($text_1)) ? language($text_1) : $text_1;
    $translate_2 = (language($text_2)) ? language($text_2) : $text_2;
    $translate_3 = (language($text_3)) ? language($text_3) : $text_3;
    $translate_4 = (language($text_4)) ? language($text_4) : $text_4;

    $data = array(
        'translate_1' => $translate_1,
        'translate_2' => $translate_2,
        'translate_3' => $translate_3,
        'translate_4' => $translate_4
    );

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}
