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
if (isset($_POST["statsTable"])) {
    $filter = isset($_POST["filter"]) ? $_POST["filter"] : null;
    $data = DB::get("SELECT * FROM contents");
    $response = [];
    $maxConversionRate = 0;
    $maxStat = 0;
    $maxConversionRateContent = null;
    $maxStatContent = null;

    foreach ($data as $d) {
        $categoryName = DB::getVar("SELECT category_name FROM category WHERE id=?", [$d->content_category]);
        $likeCount = DB::getVar("SELECT COUNT(*) FROM content_likes WHERE content_id=? AND content_like = '1'", [$d->id]);
        $dislikeCount = DB::getVar("SELECT COUNT(*) FROM content_likes WHERE content_id=? AND content_dislike = '1'", [$d->id]);
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
                    "view"=> $stat
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
                    "view"=> $stat
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
                "view"=> $stat
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

    $response = '
      <label for="tag" class="form-label-lg"><b>'.$translate_1.' :</b></label>
        <select class="form-select" id="filterSelect">
            <option value="">' . $translate_2 . '</option>
            <option value="1">'.$translate_3.'</option>
            <option value="2">'.$translate_4.'</option>
        </select>';


    echo $response;
    exit;

}
