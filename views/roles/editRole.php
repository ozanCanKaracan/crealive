<?php

?>

<div class="container">
    <div class="row">
        <div class="col-md-6 ">
            <?php
            $controlAdd = controlAdd();
            if ($controlAdd) {
                ?>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-title">
                                    <p>Rol Oluştur</p>
                                    <div class="card-body ">
                                        <form id="addRoleForm">
                                            <div class="">
                                                <label class="form-label-lg mb-1">Rol Adı</label>
                                                <input type="text" class="form-control " id="role" name="role"
                                                       maxlength="20"/>
                                            </div>
                                            <div class="d-flex justify-content-end mt-1">

                                                <button type="submit" class="btn btn-relief-success"
                                                        onclick="addRole()">
                                                    <font
                                                            style="vertical-align: inherit;"><font
                                                                style="vertical-align: inherit;">Oluştur</font></font>
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
        $controlDelete= controlDelete();
        if($controlDelete){
        ?>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-title">
                                <p>Rol Kaldır</p>
                                <div class="card-body">
                                    <div class="" id="selectBox">

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
    }else{

    }
    ?>
</div>
</div>
<script src="assets/js/modules/roles.js"></script>
<script>
    getSelectBox();
</script>
