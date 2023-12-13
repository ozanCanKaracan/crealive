<?php
$page_name = $_GET["target"];
$page_id = DB::getVar("SELECT id FROM pages WHERE href=?", [$page_name]);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <div class="card-body">
                        <div class="card-title">
                            <h2 class="d-flex justify-content-center mb-2">İçerikler</h2>
                        </div>
                        <?php
                        $controlList = controlList();
                        if ($controlList) {
                            ?>
                            <table class="table-bordered table datatables-basic table dataTable no-footer dtr-column "
                                   id="contentTable">
                                <thead>
                                <tr class="fw-semibold fs-6 text-gray-800">
                                    <th scope="col" class="d-none"></th>
                                    <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                        style="width: 100px;"><b>Başlık</b></th>
                                    <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                        style="width: 200px;"><b>Açıklama</b></th>
                                    <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                        style="width: 200px;"><b>Kategori</b></th>
                                    <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                        style="width: 50px;"><b>İşlemler</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        <?php } else {

                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="assets/js/modules/contents.js"></script>
<script>
    contentTable(<?php echo $page_id ?>);

</script>
