<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <div class="card-body">
                        <div class="card-title">
                            <h4 class="d-flex justify-content-center mb-2">Rol Kontrol Paneli</h4>
                        </div>
                        <?php
                        $controlList=controlList();
                        if($controlList){
                        ?>
                        <table class="table-bordered table datatables-basic table dataTable no-footer dtr-column "
                               id="roleTable">
                            <thead>
                            <tr class="fw-semibold fs-6 text-gray-800">
                                <th scope="col" class="d-none"></th>
                                <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" style="width: 300px;">Rol Adı</th>
                                <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" style="width: 50px;"><b>Kullanıcılar</b></th>
                                <th tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" style="width: 50px;"><b>İzinler</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <?php }else{

                        }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/modules/roles.js"></script>
