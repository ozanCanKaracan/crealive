<?php
$slug = $_GET["slug"];
$id=DB::getVar("SELECT id FROM contents WHERE url=?",[$slug]);
$data = DB::get("SELECT text,title FROM translated_contents WHERE content_id=?", [$id]);
$user_id = $_SESSION["user"];
$text=$data[0]->text;
$text = htmlspecialchars_decode($text);

?>
<script>
    const id = <?php echo $id?>;
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-center ">
                    <h3 class=""><?php echo $data[0]->title ?></h3>
                </div>
                <div class="card-body">
                    <?php echo $text ?>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>

        <?php
        $user_id = $_SESSION["user"];
        $likeCookieName = "liked_contents" . $user_id;
        $dislikeCookieName = "disliked_contents" . $user_id;

        $cookieLikeResult = isset($_COOKIE[$likeCookieName]) ? json_decode($_COOKIE[$likeCookieName]) : array();
        $cookieDislikeResult = isset($_COOKIE[$dislikeCookieName]) ? json_decode($_COOKIE[$dislikeCookieName]) : array();

        $liked = false;
        $disliked = false;

        foreach ($cookieLikeResult as $likeCookie) {
            if ($likeCookie == $id) {
                $liked = true;
                break;
            }
        }

        foreach ($cookieDislikeResult as $dislikeCookie) {
            if ($dislikeCookie == $id) {
                $disliked = true;
                break;
            }
        }

        if ($liked) {

        } else if ($disliked) {

        } else {
            ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        <h4 class="mt-2"><b>Bu içeriği beğendiniz mi ?</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center" id="question">
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>


    </div>
</div>
<script src="assets/js/modules/content.js"></script>
<script>
    question()
    takeID(id)
</script>