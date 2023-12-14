<?php
$id = $_GET["id"];
$getName = DB::getVar("SELECT role_name FROM roles WHERE id=?", [$id]);
$page_url=$_GET["target"];
$page_id=DB::getVar("SELECT id FROM pages WHERE href=?",[$page_url]);

?>
<div class="container">
    <div class="row">
        <?php
        $edit=controlEdit($page_id);
        if($edit){
        ?>
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <div class="card-body">
                        <div class="card-title">
                            <h4 class="d-flex justify-content-center mb-2"><?php echo $getName; ?> Yetki Kontrol
                                Paneli</h4>
                        </div>
                        <table class="table-bordered table datatables-basic table dataTable no-footer dtr-column"
                               id="permissionTable">
                            <thead>
                            <tr class="fw-semibold fs-6 text-gray-800">
                                <th scope="col" class="d-none"></th>
                                <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                    style="width: 300px;"><b>Rol Adı</b>
                                </th>
                                <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                    style="width: 50px;"><b>Ekleme </b></th>
                                <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                    style="width: 50px;"><b>Silme</b></th>
                                <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                    style="width: 50px;"><b>Düzenleme</b></th>
                                <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                    style="width: 50px;"><b>Listeleme</b></th>
                                <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                    style="width: 50px;"><b>Görüntüleme</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
        } else{
        }

        ?>
    </div>
</div>

<script src="assets/js/modules/permission.js"></script>
<script>
    getPermissionTable(<?php echo $id;?>)
</script>

