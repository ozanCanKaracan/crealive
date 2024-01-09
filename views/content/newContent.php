<style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }
</style>
<?php $controlAdd = controlAdd();
if ($controlAdd) {
    ?>
    <div class="container">
        <div class="row">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-center">
                    <?php
                    $lang=$_SESSION["lang"];

                    $language=DB::getVar("SELECT id FROM languages WHERE lang_name_short=?",[$lang]);
                    $text="Yeni İçerik";
                    $translate=(language($text)) ? language($text) : $text;
                    ?>
                    <h2><b><?= $translate ?></b></h2>
                </div>
                <div class="card-body">
                    <form id="newContentForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <?php
                                    $text="Kategori";
                                    $translate=(language($text)) ? language($text) : $text;
                                    ?>
                                    <label for="categorySelect" class="form-label-lg"><b><?= $translate ?></b></label>
                                    <select class="form-select" id="categorySelect" name="categorySelect">
                                        <?php
                                        $text="Kategori Seçiniz";
                                        $translate=(language($text)) ? language($text) : $text;
                                        ?>
                                        <option value=""><?= $translate ?></option>
                                        <?php
                                        $categories = DB::get("SELECT * FROM category");
                                        foreach ($categories as $c) {
                                            ?>
                                            <option value="<?php echo $c->id ?>"> <?php echo $c->category_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <?php
                                    $text="Başlık";
                                    $translate=(language($text)) ? language($text) : $text;
                                    ?>
                                    <label for="titleContent" class="form-label-lg"><b><?= $translate ?></b></label>
                                    <input type="text" class="form-control" id="titleContent" name="titleContent">
                                </div>
                            </div>
                            <div class="col-md-6" id="tagContainer">

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <?php
                                    $text="URL Özelleştir";
                                    $translate=(language($text)) ? language($text) : $text;
                                    ?>
                                    <label for="titleContent" class="form-label-lg"><b><?= $translate ?></b></label>
                                    <input type="text" class="form-control" id="url" name="url">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php
                                $text="Otomatik URL";
                                $translate=(language($text)) ? language($text) : $text;
                                ?>
                                <h5 class="d-flex justify-content-center mt-1"><?= $translate ?></h5>
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-inline ">
                                        <input class="form-check-input category" type="checkbox" value="1" id="categoryCheckbox">
                                        <?php
                                        $text="Kategori Gözüksün";
                                        $translate=(language($text)) ? language($text) : $text;
                                        ?>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?= $translate ?>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input tag" type="checkbox" value="2" id="categoryCheckbox">
                                        <?php
                                        $text="Etiket Gözüksün";
                                        $translate=(language($text)) ? language($text) : $text;
                                        ?>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?= $translate ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p><b>İçeriğin başka bir dile çevirisini eklemek ister misiniz?</b></p>

                                <label for="titleContent" class="form-label-lg"><b>Diller</b></label>
                                <select class="form-select" id="translateSelect" name="translateSelect">
                                    <option value="">Dil Seçiniz</option>
                                    <?php
                                    $languages=DB::get("SELECT * FROM languages ORDER BY id ASC");
                                    var_dump($lang);

                                    foreach ($languages as $lg) {
                                        $disabled=($lg->id == $language) ? 'disabled' : '';
                                        ?>
                                    <option value="<?= $lg->lang_name_short ?>" <?= $disabled ?>><?=$lg->lang_name?></option>
                                    <?php }?>
                                </select>
                            </div>
                                <div class="col-md-12">
                                    <div id="editor1" style="display:none"></div>
                                    <div class="ck-reset ck-editor...">
                                        <div>
                                            <div class="... ck-editor__editable ck-editor__editable_inline ...">
                                                <?php
                                                $text="İçerik Yazısı";
                                                $translate=(language($text)) ? language($text) : $text;
                                                ?>
                                                <label for="editor" class="form-label-lg mb-1"><b><?= $translate ?></b></label>
                                                <textarea name="content" id="content"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-1 d-flex justify-content-end">
                                    <?php
                                    $text="Oluştur";
                                    $translate=(language($text)) ? language($text) : $text;
                                    ?>
                                    <button type="submit" class="btn btn-success btn-lg" tabindex="4"
                                            onclick="addContent(<?= $language ?>)">
                                        <?= $translate ?>
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->

<?php } else {

}
?>

<script src="assets/js/modules/addContent.js"></script>

