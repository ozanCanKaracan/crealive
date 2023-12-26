<?php
$slug=$_GET["slug"];
$data=DB::get("SELECT * FROM contents WHERE url=?",[$slug]);

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-center ">
                    <h3 class=""><?php echo $data[0]->content_title ?></h3>
                </div>
                <div class="card-body">
                    <?php echo $data[0]->content_text?>
                </div>
            </div>
        </div>
    </div>
</div>