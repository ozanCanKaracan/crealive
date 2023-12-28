<?php
$lang=$_SESSION['lang'];
$language=DB::getVar("SELECT id FROM languages WHERE lang_name_short=?",[$lang]);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-center ">
                    <script>
                        const language= <?php echo $language?>;
                    </script>
                    <h3 class=""><?php
                        $text='Geri Dönüş Oranları';
                        $translate=(language($text)) ? language($text) : $text;
                        ?><?=$translate?></h3>
                </div>
                <div class="card-body">
                    <div class="col-md-4" id="statsFilter">

                    </div>
                    <table class="table-bordered table datatables-basic table dataTable no-footer dtr-column "
                           id="conversionTable">
                        <thead>
                        <tr class="fw-semibold fs-6 text-gray-800">
                            <th scope="col" class="d-none"></th>
                            <th scope="col"> <?php
                                $text='Başlık';
                                $translate=(language($text)) ? language($text) : $text;
                                ?><?= $translate ?></th>
                            <th scope="col"> <?php
                                $text='Kategori';
                                $translate=(language($text)) ? language($text) : $text;
                                ?><?= $translate ?></th>
                            <th scope="col"> <?php
                                $text='Beğeni Sayısı';
                                $translate=(language($text)) ? language($text) : $text;
                                ?><?= $translate ?></th>
                            <th scope="col"><?php
                                $text='Beğenilmeme Sayısı';
                                $translate=(language($text)) ? language($text) : $text;
                                ?><?= $translate ?> </th>
                            <th scope="col"><?php
                                $text='Geri Dönüş Oranları';
                                $translate=(language($text)) ? language($text) : $text;
                                ?><?= $translate ?> </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="assets/js/modules/stats.js"></script>
<script>
    statsTable(language)
</script>