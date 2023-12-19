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
                    <h2><b>Yeni İçerik</b></h2>
                </div>
                <div class="card-body">
                    <form id="newContentForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="categorySelect" class="form-label-lg"><b>İçerik Dili</b></label>

                                    <select class="form-select" id="languageSelect" name="languageSelect">
                                        <option value="">Dil seçiniz</option>

                                        <?php
                                        $languages = DB::get("SELECT * FROM languages");

                                        foreach ($languages as $l) {
                                            ?>
                                            <option value="<?php echo $l->id ?>"> <?php echo $l->lang_name; ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="categorySelect" class="form-label-lg"><b>Kategori</b></label>
                                    <select class="form-select" id="categorySelect" name="categorySelect">
                                        <option value="">Kategori seçiniz</option>
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
                                    <label for="titleContent" class="form-label-lg"><b>Başlık</b></label>
                                    <input type="text" class="form-control" id="titleContent" name="titleContent">
                                </div>
                            </div>
                            <div class="col-md-6" id="tagContainer">

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="titleContent" class="form-label-lg"><b>URL Özelleştir</b></label>
                                    <input type="text" class="form-control" id="url" name="url">
                                </div>
                            </div>
                            <div class="col-md-1 mt-2"><h6><b>Yada</h6></b></div>
                            <div class="col-md-5">
                                <h5 class="d-flex justify-content-center mt-1">Otomatik URL</h5>
                                <div class="d-flex justify-content-center">
                                    <div class="form-check form-check-inline ">
                                        <input class="form-check-input category" type="checkbox" value="1" id="categoryCheckbox">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Kategori Gözüksün
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="flexCheckChecked"></label>
                                        <input class="form-check-input tag" type="checkbox" value="2" id="tagCheckbox">
                                        Etiket Gözüksün
                                        </label>
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-12">
                                    <div id="editor1" style="display:none"></div>
                                    <div class="ck-reset ck-editor...">
                                        <div>
                                            <div class="... ck-editor__editable ck-editor__editable_inline ...">
                                                <label for="editor" class="form-label-lg mb-1"><b>İçerik
                                                        Yazısı</b></label>
                                                <textarea name="content" id="content"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-1 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success btn-lg" tabindex="4"
                                            onclick="addContent()">
                                        Oluştur
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
<!-- Button trigger modal -->
