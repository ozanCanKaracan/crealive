<style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }
</style>
<?php
$href=$_GET["target"];
$page_id=DB::getVar("SELECT id FROM pages WHERE href=?",[$href]);
$id=$_GET["id"];
$data=DB::getRow("SELECT * FROM contents WHERE id=?",[$id]);
$slug=$_GET["slug"];
var_dump($slug);
?>
<?php $controlAdd = controlEdit($page_id);
if ($controlAdd) {
?>
<div class="container">
        <div class="row">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-center">
                    <h2><b>İçerik Düzenle</b></h2>
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
                                            $selected=($data->content_language == $l->id) ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $l->id ?>" <?=$selected?>> <?php echo $l->lang_name; ?></option>

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
                                            $selected=($data->content_category == $c->id) ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $c->id ?>" <?=$selected?> > <?php echo $c->category_name; ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="titleContent" class="form-label-lg"><b>Başlık</b></label>
                                    <input type="text" class="form-control" id="titleContent" name="titleContent" value="<?=$data->content_title?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="titleContent" class="form-label-lg"><b>Açıklama</b></label>
                                    <input type="text" class="form-control" id="contentDescription"
                                           name="contentDescription" value="<?=$data->content_desc?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="editor1" style="display:none"></div>
                                <div class="ck-reset ck-editor...">
                                    <div>
                                        <div class="... ck-editor__editable ck-editor__editable_inline ...">
                                            <label for="editor" class="form-label-lg mb-1"><b>İçerik Yazısı</b></label>
                                            <textarea name="content" id="content"><?php echo $data->content_text?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="m-1 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success btn-lg" tabindex="4"
                                        onclick="editContent(<?=$id?>)">
                                    Düzenle
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}else {

}
?>

<script src="assets/js/modules/addContent.js"></script>
