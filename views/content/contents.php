<?php
$target=$_GET["target"];
$lang=$_SESSION["lang"];
$language=DB::getVar("SELECT id FROM languages WHERE lang_name_short=?",[$lang]);
$page_name = $_GET["target"];
$page_id = DB::getVar("SELECT id FROM pages WHERE href=?", [$page_name]);
?>
<script>
    const lang = '<?php echo $language?>';
    const id = '<?php echo $page_id ?>';
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <div class="card-body">
                        <div class="card-title">
                            <?php
                            $text = 'İçerikler';
                            $translate = (language($text)) ? language($text) : $text;
                            ?>
                            <h2 class="d-flex justify-content-center mb-2"><?= $translate ?></h2>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mt-5" id="filterByCategory">

                            </div>
<!--                            <div class="col-md-3 mt-5" id="filterByLanguage">-->
<!---->
<!--                            </div>-->
                        </div>
                        <?php
                        $controlList = controlList($target);
                        if ($controlList) {
                            ?>
                            <table class="table-bordered table datatables-basic table dataTable no-footer dtr-column "
                                   id="contentTable">
                                <thead>
                                <tr class="fw-semibold fs-6 text-gray-800">
                                    <th scope="col" class="d-none"></th>
                                    <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                        style="width: 100px;"><b> <?php
                                            $text = 'Başlık';
                                            $translate = (language($text)) ? language($text) : $text;?>
                                            <?= $translate?></b></th>
                                    <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                        style="width: 200px;"><b><?php
                                            $text = 'Kategori';
                                            $translate = (language($text)) ? language($text) : $text;?>
                                            <?= $translate?></b></th></b></th>
                                    <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                        style="width: 50px;"><b><?php
                                            $text = 'İşlemler';
                                            $translate = (language($text)) ? language($text) : $text;?>
                                            <?= $translate?></b></th></b></th>
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
    contentTable(id, lang);
</script>
