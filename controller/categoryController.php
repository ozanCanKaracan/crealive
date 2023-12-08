<?php

include "../include/config.php";
$category = new Category();

if (isset($_POST["getCategorySelectBox"])) {
    $response = '
        <form id="deleteCategoryForm">
            <label class="form-label-lg mb-1">Kategorileri Listele</label>
            <select class="select2 form-control form-control select2-hidden-accessible" data-select2-id="1" aria-hidden="true" id="categorySelect" name="categorySelect">
                <option value="" data-select2-id="3" selected> Kategori Seçiniz</option>
    ';
    $data = $category->getCategory();
    foreach ($data as $d) {
        $id = $d->id;
        $response .= '<option value="' . $id . '" data-select2-id="3" >' . $d->category_name . '</option>';
    }
    $response .= '</select>
                <div class="d-flex justify-content-end mt-1">
                    <button type="submit" class="btn btn-relief-success" onclick="deleteCategory()">
                        <font style="vertical-align: inherit;">Kaldır</font>
                    </button>     
                </div>
            </form>
    ';
    echo $response;
}

if (isset($_POST["categoryAdd"])) {
    $categoryName = C($_POST["categoryName"]);

    $categoryControl = $category->controlAddCategory($categoryName);
    if (empty($categoryName)) {
        echo "bos";
    } else if ($categoryControl) {
        echo "hata";
    } else {
        $add = $category->addCategory($categoryName);
        echo "ok";
        exit();
    }
}

if (isset($_POST["deleteCategory"])) {
    $categoryID = C($_POST["id"]);
    //$control=DB::get("SELECT * FROM contents WHERE category_id=?",[$categoryID]);
    if (!$categoryID) {
        echo "bos";
    //}else if($control){
      //  echo "hata";
    }else{
        $delete=$category->deleteCategory($categoryID);
        echo "ok";
    }

}