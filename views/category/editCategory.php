<div class="container">
    <div class="row">
        <div class="col-md-6 ">
            <?php
            $lang = $_SESSION["lang"];
            $language = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$lang]);
            $target = $_GET["target"];
            $controlAdd = controlAdd($target);
            if ($controlAdd) {
                ?>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-title">
                                    <p><?php
                                        $text = 'Kategori Oluştur';
                                        $translate = (language($text)) ? language($text) : $text;
                                        ?><?= $translate ?></p>
                                    <div class="card-body ">
                                        <form id="addCategoryForm">
                                            <div class="">
                                                <?php
                                                $text = 'Kategori Adı';
                                                $translate = (language($text)) ? language($text) : $text;
                                                ?>
                                                <label class="form-label-lg mb-1"><?= $translate ?></label>
                                                <input type="text" class="form-control " id="categoryName"
                                                       name="categoryName" maxlength="35">
                                            </div>
                                            <div class="d-flex justify-content-end mt-1">
                                                <button type="submit" class="btn btn-relief-success"
                                                        onclick="addCategory(<?= $language ?>)"><font
                                                            style="vertical-align: inherit;"><font
                                                                style="vertical-align: inherit;"> <?php
                                                            $text = 'Oluştur';
                                                            $translate = (language($text)) ? language($text) : $text;
                                                            ?><?= $translate ?></font></font>
                                                </button>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
        $controlDelete = controlDelete($target);
        if ($controlDelete){
        ?>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-title">
                                <p><?php
                                    $text_1 = 'Kategori Listele';
                                    $translate_1 = (language($text_1)) ? language($text_1) : $text_1;
                                    $text_2 = 'Kategori Seçiniz';
                                    $translate_2 = (language($text_2)) ? language($text_2) : $text_2;
                                    $text_3 = 'Kaldır';
                                    $translate_3 = (language($text_3)) ? language($text_3) : $text_3;
                                    $text = 'Kategori Kaldır';
                                    $translate = (language($text)) ? language($text) : $text;
                                    ?><?= $translate ?></p>
                                <div class="card-body">
                                    <form id="deleteCategoryForm">
                                        <label class="form-label-lg mb-1"><?= $translate_1?></label>
                                        <select class="select2 form-control form-control select2-hidden-accessible"
                                                data-select2-id="1" aria-hidden="true" id="categorySelect"
                                                name="categorySelect">
                                            <option value="" data-select2-id="3" selected><?= $translate_2 ?></option>
                                            <?php
                                            $data = DB::get("SELECT id,category_name FROM category");
                                            foreach ($data as $d) {
                                                $id = $d->id; ?>
                                                <option value="<?= $id ?>"
                                                        data-select2-id="3"><?= $d->category_name ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="d-flex justify-content-end mt-1">
                                            <button type="submit" class="btn btn-relief-success"
                                                    onclick="deleteCategory()">
                                                <font style="vertical-align: inherit;"><?= $translate_3 ?></font>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
} else {
} ?>
<script src="assets/js/modules/category.js"></script>
