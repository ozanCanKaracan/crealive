<link rel="stylesheet" href="assets/css/style.css">
<div id="loader" class="loader"></div>

<div class="container">
    <div class="row">
        <div class="col-6 col-md-4">
            <div class="card shadow">
                <div class="card-header">
                    <h3><?php $text = 'Yeni Dil Paketi Ekle';
                        $translate = (language($text)) ? language($text) : $text;
                        ?><?= $translate ?></h3>
                </div>
                <div class="card-body">
                    <div class="form-group mb-5">
                        <label for="lang" class="form-label"><b><?php $text = 'Eklemek istediğiniz Dili Seçiniz';
                                $translate = (language($text)) ? language($text) : $text;
                                ?><?= $translate ?></b></label>
                        <select class="select2 form-control form-control select2-hidden-accessible" data-select2-id="1"
                                aria-hidden="true" id="langSelect" name="langSelect">
                            <option value=""><?php $text = 'Dil Seç';
                                $translate = (language($text)) ? language($text) : $text;
                                ?><?= $translate ?></option>
                            <?php
                            $getLanguage = DB::get("SELECT * FROM languages WHERE status = 0");
                            foreach ($getLanguage as $language) {
                                ?>
                                <option value="<?= $language->id ?>"><?= $language->lang_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="step-footer text-end">
                        <button type="button" class="btn btn-success float-end m-2"
                                onclick="addLangPackage()"><?php $text = 'Kaydet';
                            $translate = (language($text)) ? language($text) : $text;
                            ?><?= $translate ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-8">
            <div class="card mr-5">
                <div class="card-body">
                    <table id="langPackageTable" class="table table-striped table-row-bordered ">
                        <thead>
                        <tr class="fw-semibold fs-6 text-gray-800">
                            <th scope="col" class="d-none"></th>
                            <th scope="col"><b><?php $text = 'Dil Adı';
                                    $translate = (language($text)) ? language($text) : $text;
                                    ?><?= $translate ?></b></th>
                            <th scope="col"><b><?php $text = 'Kısa Adı';
                                    $translate = (language($text)) ? language($text) : $text;
                                    ?><?= $translate ?></b></th>
                            <th scope="col"><b><?php $text = 'İşlemler';
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
<script src="assets/js/modules/language.js"></script>