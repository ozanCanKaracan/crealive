<?php
$id=$_GET["id"];
$roleName=DB::getVar("SELECT role_name FROM roles WHERE id=?",[$id]);

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <div class="card-body">
                        <div class="card-title">
                            <h4 class="d-flex justify-content-center mb-2"><?php echo $roleName;?> Rolündeki Kişiler</h4>
                        </div>
                        <table class="table-bordered table datatables-basic table dataTable no-footer dtr-column "
                               id="userlistRoleTable">
                            <thead>
                            <tr class="fw-semibold fs-6 text-gray-800">
                                <th scope="col" class="d-none"></th>
                                <th tabindex="0" aria-controls="DataTables_Table_2">Ad Soyad</th>
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
</div>
<script src="assets/js/modules/userlistRole.js"></script>
<script>
    getUserTable(<?php echo $id ?>);
</script>
