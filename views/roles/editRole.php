<div class="container">
    <div class="row">
        <div class="col-md-6 ">
            <?php
            $lang = $_SESSION["lang"];
            $language = DB::getVar("SELECT id FROM languages WHERE lang_name_short=?", [$lang]);
            $target = $_GET["target"];
            $controlAdd = controlAdd($target);
            if ($controlAdd) {
                ?>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-title">
                                    <?php $text = 'Rol Oluştur';
                                    $translate = (language($text)) ? language($text) : $text;
                                    ?>
                                    <p><?= $translate ?></p>
                                    <div class="card-body ">
                                        <form id="addRoleForm">
                                            <div class="">
                                                <label class="form-label-lg mb-1">
                                                    <?php $text = 'Rol Adı';
                                                    $translate = (language($text)) ? language($text) : $text;
                                                    ?><?= $translate ?>
                                                </label>
                                                <input type="text" class="form-control " id="role" name="role"
                                                       maxlength="20"/>
                                            </div>
                                            <div class="d-flex justify-content-end mt-1">

                                                <button type="submit" class="btn btn-relief-success"
                                                        onclick="addRole(<?= $language ?>)">
                                                    <font
                                                            style="vertical-align: inherit;"><font
                                                                style="vertical-align: inherit;"> <?php $text = 'Oluştur';
                                                            $translate = (language($text)) ? language($text) : $text;
                                                            ?><?= $translate ?></font></font>
                                                </button>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } else {

            } ?>
        </div>
        <?php
        $controlDelete = controlDelete($target);
        if ($controlDelete){
        ?>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-title">
                                <p> <?php
                                    $text_1 = "Rol Seçiniz";
                                    $language_1 = (language($text_1)) ? language($text_1) : $text_1;
                                    $text_2 = "Kaldır";
                                    $language_2 = (language($text_2)) ? language($text_2) : $text_2;
                                    $text_2 = "Rolleri Listele";
                                    $language_3 = (language($text_2)) ? language($text_2) : $text_2;
                                    $text = 'Rol Kaldır';
                                    $translate = (language($text)) ? language($text) : $text;
                                    ?><?= $translate ?></p>
                                <div class="card-body">
                                    <div>
                                        <form id="deleteRoleForm">
                                            <label class="form-label-lg mb-1"><?=$language_3?></label>
                                            <select class="select2 form-control form-control select2-hidden-accessible"
                                                    data-select2-id="1" aria-hidden="true" id="roleSelect"
                                                    name="roleSelect">
                                                <option value="" data-select2-id="3" selected> <?=$language_1?>
                                                </option>
                                                <?php
                                                $data =DB::get("SELECT id,role_name FROM roles");

                                                foreach ($data as $d) {
                                                    $id = $d->id;
                                                    $disabled = ($id == '1') ? 'disabled' : "";?>
                                                    <option value="<?=$id?>" data-select2-id="3"  <?=$disabled ?> ><?= $d->role_name?></option>
                                                ?>
                                                <?php }?>
                                            </select>
                                            <div class="d-flex justify-content-end mt-1">
                                                <button type="submit" class="btn btn-relief-success"
                                                        onclick="deleteRole()">
                                                    <font style="vertical-align: inherit;"><?=$language_2?></font>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    } else {

    }
    ?>
</div>

<script src="assets/js/modules/roles.js"></script>

