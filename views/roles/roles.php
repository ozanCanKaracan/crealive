
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <div class="card-body">
                        <div class="card-title">
                            <?php
                            $lang=$_SESSION["lang"];
                            $language=DB::getVar("SELECT id FROM languages WHERE lang_name_short=?",[$lang]);
                            $text = 'Rol Kontrol Paneli';
                            $translate = (language($text)) ? language($text) : $text;
                            ?>
                            <h4 class="d-flex justify-content-center mb-2">
                                <?php echo $translate; ?>
                            </h4>
                        </div>

                        <?php
                        $target=$_GET["target"];
                        $controlList = controlList($target);
                        if ($controlList) {
                            ?>
                            <table class="table-bordered table datatables-basic table dataTable no-footer dtr-column "
                                   id="roleTable">
                                <thead>
                                <tr class="fw-semibold fs-6 text-gray-800">
                                    <th scope="col" class="d-none"></th>
                                    <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                        style="width: 300px;"><?php $text = 'Rol Adı';
                                        $translate = (language($text)) ? language($text) : $text;
                                        ?><?= $translate ?></th>
                                    <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                        style="width: 50px;"><b><?php $text = 'Kullanıcılar';
                                            $translate = (language($text)) ? language($text) : $text;
                                            ?><?= $translate ?></b></th>
                                    <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"
                                        style="width: 50px;"><b><?php $text = 'İzinler';
                                            $translate = (language($text)) ? language($text) : $text;
                                            ?><?= $translate ?></b></th>
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
<script src="assets/js/modules/roles.js"></script>

<script>
    const langID = <?php echo $language?>;
    getRoleTable(langID);
</script>
