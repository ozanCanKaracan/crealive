<?php
$user_id=$_SESSION['user'];

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="d-flex justify-content-center mb-4"><?php $text = 'Sizin İçin Önerilenler';
                $translate = (language($text)) ? language($text) : $text;
                ?><?= $translate ?>
                </h3>
             <div id="recommendedForU">
            </div>
        </div>
    </div>
</div>
<script src="assets/js/modules/recommended.js"></script>