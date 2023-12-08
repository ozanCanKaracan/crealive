<style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }
</style>
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
                                    <option value="1">Kategori 1</option>
                                    <option value="2">Kategori 2</option>
                                    <option value="3">Kategori 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="categorySelect" class="form-label-lg"><b>Kategori</b></label>
                                <select class="form-select" id="categorySelect" name="categorySelect">
                                    <option value="1">Kategori 1</option>
                                    <option value="2">Kategori 2</option>
                                    <option value="3">Kategori 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="titleContent" class="form-label-lg"><b>Başlık</b></label>
                                <input type="text" class="form-control" id="titleContent" name="titleContent">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="titleContent" class="form-label-lg"><b>Açıklama</b></label>
                                <input type="text" class="form-control" id="contentDescription" name="contentDescription">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="editor1" style="display:none"></div>
                            <div class="ck-reset ck-editor...">
                                <div>
                                    <div class="... ck-editor__editable ck-editor__editable_inline ...">
                                        <label for="editor" class="form-label-lg mb-1"><b>İçerik Oluştur</b></label>
                                        <textarea name="content" id="content"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="m-1 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success btn-lg" tabindex="4" onclick="addContent()">
                                Oluştur
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/modules/content.js"></script>
