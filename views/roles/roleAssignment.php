<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header">
                    <h3><?php $text = 'Kullanıcı Ekle';
                        $translate = (language($text)) ? language($text) : $text;
                        ?><?= $translate ?></h3>
                </div>
                <div class="card-body">
                    <form id="addWorkerForm">
                        <div class="form-group mb-2">
                            <label for="name" class="form-label"><b><?php $text = 'Ad Soyad';
                                    $translate = (language($text)) ? language($text) : $text;
                                    ?><?= $translate ?></b></label>
                            <input type="text" class="form-control" id="name_surname" name="name_surname" maxlength="40">
                        </div>
                        <div class="form-group mb-2">
                            <label for="name" class="form-label"><b><?php $text = 'E-mail';
                                    $translate = (language($text)) ? language($text) : $text;
                                    ?><?= $translate ?></b></label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group mb-2">
                            <label for="name" class="form-label"><b><?php $text = 'E-mail Tekrar';
                                    $translate = (language($text)) ? language($text) : $text;
                                    ?><?= $translate ?></b></label>
                            <input type="text" class="form-control" id="emailagain" name="emailagain">
                        </div>
                        <div class="form-group mb-2">
                            <label for="name" class="form-label"><b><?php $text = 'Telefon';
                                    $translate = (language($text)) ? language($text) : $text;
                                    ?><?= $translate ?></b></label>
                            <input type="text" class="form-control" id="phone" name="phone" maxlength="11">
                        </div>
                        <div class="form-group mb-2">
                            <label for="role" class="form-label"><b><?php $text = 'Rol Seçiniz';
                                    $translate = (language($text)) ? language($text) : $text;
                                    ?><?= $translate ?></b></label>
                            <select class="select2 form-control form-control select2-hidden-accessible" data-select2-id="1"
                                    aria-hidden="true" id="role" name="role">
                                <option value=""><?php $text = 'Bir rol seçiniz';
                                    $translate = (language($text)) ? language($text) : $text;
                                    ?><?= $translate ?></option>
                                <?php
                                $getRoles=DB::get("SELECT id,role_name FROM roles");
                                foreach ($getRoles as $roles) {
                                    ?>
                                    <option value="<?= $roles->id ?>"><?= $roles->role_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="name" class="form-label"><b><?php $text = 'Şifre';
                                    $translate = (language($text)) ? language($text) : $text;
                                    ?><?= $translate ?></b></label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group mb-2">
                            <label for="name" class="form-label"><b><?php $text = 'Şifre Tekrar';
                                    $translate = (language($text)) ? language($text) : $text;
                                    ?><?= $translate ?></b></label>
                            <input type="password" class="form-control" id="passwordagain" name="passwordagain">
                        </div>
                </div>
                <div class="card-footer">
                    <div class="step-footer text-end">
                        <button type="submit" class="btn btn-success float-end m-2"
                                onclick="addWorker()"><?php $text = 'Kaydet';
                            $translate = (language($text)) ? language($text) : $text;
                            ?><?= $translate ?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-center">
                    <h3>Rolleri Düzenle</h3>
                </div>
                <div class="card-body">
                    <table class="table-bordered table datatables-basic table dataTable no-footer dtr-column "
                           id="roleAssignmentTable">
                        <thead>
                        <tr class="fw-semibold fs-6 text-gray-800">
                            <th scope="col" class="d-none"></th>
                            <th scope="col">Kullanıcı Adı</th>
                            <th scope="col">Rol Adı</th>
                            <th scope="col">İşlem</th>
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


<script src="assets/js/modules/roleAssignment.js"></script>
