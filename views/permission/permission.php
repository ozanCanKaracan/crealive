<?php

$id = $_GET["slug"];
$getName = DB::getVar("SELECT role_name FROM roles WHERE id=?", [$id]);
$page_url = $_GET["target"];
$page_id = DB::getVar("SELECT id FROM pages WHERE href=?", [$page_url]);
$lang=$_SESSION["lang"];
$language=DB::getVar("SELECT id FROM languages WHERE lang_name_short=?",[$lang]);
?>
<div class="container">
    <div class="row">

            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="card-body">
                            <div class="card-title">
                                <?php
                                $text = 'Yetki Kontrol Paneli';
                                $translate = (language($text)) ? language($text) : $text;
                                ?>
                                <h4 class="d-flex justify-content-center mb-2"><?php echo $getName; ?> <?= $translate ?> </h4>
                            </div>
                            <table class="table-bordered table datatables-basic table dataTable no-footer dtr-column"
                                   id="permissionTable">
                                <thead>
                                <tr class="fw-semibold fs-6 text-gray-800">
                                    <th scope="col" class="d-none"></th>
                                    <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                        style="width: 300px;"><b>
                                            <?php
                                            $text = 'Rol Adı';
                                            $translate = (language($text)) ? language($text) : $text;
                                            ?><?= $translate ?></b>
                                    </th>
                                    <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                        style="width: 50px;"><b>
                                            <?php
                                            $text = 'Ekleme';
                                            $translate = (language($text)) ? language($text) : $text;
                                            ?><?= $translate ?></b></th>
                                    <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                        style="width: 50px;"><b>
                                            <?php
                                            $text = 'Silme';
                                            $translate = (language($text)) ? language($text) : $text;
                                            ?><?= $translate ?></b></th>
                                    <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                        style="width: 50px;"><b> <?php
                                            $text = 'Düzenleme';
                                            $translate = (language($text)) ? language($text) : $text;
                                            ?><?= $translate ?></b></th>
                                    <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                        style="width: 50px;"><b><?php
                                            $text = 'Listeleme';
                                            $translate = (language($text)) ? language($text) : $text;
                                            ?><?= $translate ?></b></th>
                                    <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                        style="width: 50px;"><b><?php
                                            $text = 'Görüntüleme';
                                            $translate = (language($text)) ? language($text) : $text;
                                            ?><?= $translate ?></b></th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>

<script src="assets/js/modules/permission.js"></script>
<script>
    const pageID=<?php echo $page_id?>;
    const langID= <?php echo $language?>;
    getPermissionTable(<?php echo $id;?>,langID,pageID)
</script>

