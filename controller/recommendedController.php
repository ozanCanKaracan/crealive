<?php

include "../include/config.php";

if (isset($_POST["recommended"])) {
    $lang=$_SESSION["lang"];
    $language=DB::get("SELECT id FROM languages WHERE lang_name_short=?",[$lang]);

    $user_id = $_SESSION["user"];
    $cookieName = "visited_pages_user" . $user_id;
    $content_IDs = json_decode($_COOKIE[$cookieName]);
    $response = "";

    foreach ($content_IDs as $cID) {
        $categories = DB::getVar("SELECT content_category FROM contents WHERE id=? ", [$cID]);
        $contents = DB::get("SELECT * FROM contents WHERE content_category=?", [$categories,]);

        $response .= '<div class="row">';

        foreach ($contents as $content) {
            $stats = DB::get("SELECT * FROM (SELECT content_id, view_count FROM stats WHERE content_id=? ORDER BY view_count DESC LIMIT 3) tmp ORDER BY view_count ASC", [$content->id]);
            foreach ($stats as $stat) {
                $response .= '
                    <div class="col-md-4">
                        <div class="card shadow" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">'.$content->content_title.'</h5>
                                <p>View Count: ' . $stat->view_count . '</p>
                            </div>
                        </div>
                    </div>';
            }
        }

        $response .= '</div>';
    }

    echo $response;
    exit();
}
