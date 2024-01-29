<?php
$lang=$_SESSION["lang"];
$language=DB::getVar("SELECT id FROM languages WHERE lang_name_short=?",[$lang]);
?>
<script>
    const langID= <?php echo $language?>;
</script>
<div class="container">
    <div class="row">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-center">
                <div class="card-title">
                    <h3 class="">
                        <?php
                        $text='Listesi';
                        $translate=(language($text)) ? language($text) : $text;
                        ?>TOP 5 <?= $translate ?></h3>
                </div>
            </div>
            <div class="card-body">
                <table class="table-bordered table datatables-basic table dataTable no-footer dtr-column "
                       id="top_5">
                    <thead>
                    <tr class="fw-semibold fs-6 text-gray-800">
                        <th class="d-none"></th>
                        <th class="d-none"></th>
                        <th><?php
                            $text='Başlık';
                            $translate=(language($text)) ? language($text) : $text;
                            ?><?= $translate ?></th>
                        <th><?php
                            $text='Kategori';
                            $translate=(language($text)) ? language($text) : $text;
                            ?><?= $translate ?></th>
                        <th><?php
                            $text='İşlemler';
                            $translate=(language($text)) ? language($text) : $text;
                            ?><?= $translate ?></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/modules/top_5.js"></script>
<script>
    top_5(langID);
</script>