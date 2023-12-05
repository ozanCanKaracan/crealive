<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <div class="card-body">
                        <table class="table table-responsive table-hover-animation table-hover table-striped"
                               id="roleTable">
                            <thead>
                            <tr class="fw-semibold fs-6 text-gray-800">
                                <th scope="col" class="d-none"></th>
                                <th scope="col"><b>Rol Adı</b></th>
                                <th scope="col"><b>İşlem</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-title">
                                <p>Rol Oluştur</p>
                                <div class="card-body">
                                    <div class="">
                                        <label class="form-label">Rol Adı</label>
                                        <input type="text" class="form-control" id="role" name="role"/>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-relief-success" onclick="addRole()"><font
                                                style="vertical-align: inherit;"><font
                                                    style="vertical-align: inherit;">Oluştur</font></font>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/modules/roles.js"></script>
