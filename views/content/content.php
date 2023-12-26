<?php
$slug = $_GET["slug"];
$data = DB::get("SELECT * FROM contents WHERE url=?", [$slug]);
$id=$data[0]->id;
?>
<script>
const id= <?php echo $id?>;
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-center ">
                    <h3 class=""><?php echo $data[0]->content_title ?></h3>
                </div>
                <div class="card-body">
                    <?php echo $data[0]->content_text ?>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-center">
                    <h4 class="mt-2"> <b>Bu içeriği beğendiniz mi ?</b></h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center" id="question">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/modules/content.js"></script>
<script>
    question(id)
</script>