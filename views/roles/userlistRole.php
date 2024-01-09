<?php
$id = $_GET["slug"];
$roleName = DB::getVar("SELECT role_name FROM roles WHERE id=?", [$id]);
$lang = $_SESSION["lang"];
$languageID = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$lang]);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <div class="card-body">
                        <div class="card-title">
                            <?php
                            $text = 'Listesi';
                            $translate = (language($text)) ? (language($text)) : $text;
                            ?>
                            <h4 class="d-flex justify-content-center mb-2"><?php echo $roleName; ?> <?= $translate ?></h4>
                        </div>
                        <table class="table-bordered table datatables-basic table dataTable no-footer dtr-column "
                               id="userlistRoleTable">
                            <thead>

                            <tr class="fw-semibold fs-6 text-gray-800">
                                <th scope="col" class="d-none"></th>
                                <?php
                                $text = 'Ad Soyad';
                                $translate = (language($text)) ? (language($text)) : $text;
                                ?>
                                <th tabindex="0" aria-controls="DataTables_Table_2"><?= $translate ?></th>
                                <?php
                                $languages = DB::get("SELECT * FROM languages ORDER BY id ASC");
                                $datatableColumns = [];
                                foreach ($languages as $language) {
                                    $datatableColumns[] = "{ 'data': '" . $language->lang_name_short . "' }";
                                }
                                $datatableColumnsString = implode(", ", $datatableColumns);
                                foreach ($languages as $language) {
                                    $text=$language->lang_name;
                                    $translate = (language($text)) ? (language($text)) : $text;
                                    ?>
                                    <th tabindex="0" aria-controls="DataTables_Table_2"><?= $translate?></th>
                                <?php } ?>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/modules/userlistRole.js"></script>
<script>
    const columns = [<?= $datatableColumnsString ?>];
    const langID =<?php echo $languageID?>;
    getUserTable(<?php echo $id ?>, langID,columns);
</script>
