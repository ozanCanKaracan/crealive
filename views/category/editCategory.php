<div class="container">
    <div class="row">
        <div class="col-md-6 ">
            <?php
            $controlAdd = controlAdd();
            if ($controlAdd) {
                ?>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="col-md-12">

                            <div class="card ">
                                <div class="card-title">
                                    <p>Yeni Kategori</p>
                                    <div class="card-body ">
                                        <form id="addCategoryForm">
                                            <div class="">
                                                <label class="form-label-lg mb-1">Kategori Adı</label>
                                                <input type="text" class="form-control " id="categoryName"
                                                       name="categoryName" maxlength="35">
                                            </div>
                                            <div class="d-flex justify-content-end mt-1">
                                                <button type="submit" class="btn btn-relief-success"
                                                        onclick="addCategory()"><font
                                                            style="vertical-align: inherit;"><font
                                                                style="vertical-align: inherit;">Oluştur</font></font>
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
        $controlDelete = controlDelete();
        if ($controlDelete){
        ?>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-title">
                                <p>Kategori Kaldır</p>
                                <div class="card-body">
                                    <div class="" id="selectBoxCategory">
                                    </div>
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
        }else{
}?>
<script src="assets/js/modules/category.js"></script>
<script>
    getCategorySelectBox();
</script>
