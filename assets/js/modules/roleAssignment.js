let table;

function assignmentTable() {
    if (table) {
        table.clear().destroy();
        table = false;
    }

    table = $('#roleAssignmentTable').DataTable({
        sDom: '<"d-flex justify-content-between align-items-center"lf>rt<"d-flex justify-content-between align-items-center"ip>',
        ajax: {
            url: 'controller/roleController.php',
            type: 'POST',
            data: {
                "assignmentTable": 1,
            },
            dataSrc: function (json) {
                var data = json.data.map(function (item) {
                    return {
                        id: item.id,
                        name: item.name,
                        role: item.role,
                        process:
                            (item.process.button ? '<button type="button" class="btn btn-relief-info btn-sm" data-bs-toggle="modal" data-bs-target="#ajaxModal" onclick="editModal(' + item.id + ',' + item.process.roleID + ',' + item.roleID + ')">Rol Değiştir</button></a><span style="margin:3px;"></span>' : '')
                    };
                });

                return data;
            }
        },
        columns: [
            {data: 'id', visible: false},
            {data: 'name'},
            {data: 'role'},
            {data: 'process'},

        ],
    });
}

assignmentTable()

function editModal(id, roleID) {
    $.ajax({
        type: 'POST',
        data: {
            'editModal': 1,
            'id': id,
            'roleID': roleID,
        },
        dataType: 'json',
        url: "controller/roleController.php",
        success: function (response) {
            // Seçenekleri oluştur
            var optionsHtml = '';

            $.each(response.options, function (index, option) {
                var selected = option.id == response.selectedID ? 'selected' : '';
                optionsHtml += '<option value="' + option.id + '" ' + selected + '>' + option.role_name + '</option>';
            });

            // Modal içeriğini oluştur
            var modalHtml = ''+
                '<form id="editRoleForm">' +
                '<label for="roleSelect" class="form-label"><b>Rol Seç</b></label>' +
                '<select class="form-select" id="roleSelect" name="roleSelect">' +
                '<option value="">Bir Rol Seçiniz</option>'+
                optionsHtml +
                '</select>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>' +
                '<button type="submit" class="btn btn-info" onclick="editRole(' + response.id + ')">Kaydet</button>' +
                '</div>'
            '</form>';

            // ModalContainer içine ekleyin
            $('#modalContainer').html(modalHtml);
        }
    });
}


function editRole(id) {
    $("#editRoleForm").validate({
        rules: {
            roleSelect: {
                required: true,
            },
        },
        messages: {
            roleSelect: {
                required: "Bu alan zorunludur!",
            },
        },
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            error.insertAfter(element);
            element.addClass("is-invalid");
        },
        success: function (label, element) {
            label.remove();
            $(element).removeClass("is-invalid");
            $(element).addClass("is-valid");
        },
        submitHandler: function (form, event) {

            event.preventDefault();

            Swal.fire({
                title: 'Rol Değiştirilsin mi?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#00FF00',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet',
                cancelButtonText: 'İptal',
                showClass: {
                    popup: 'swal2-show',
                    backdrop: 'swal2-backdrop-show',
                    icon: 'swal2-icon-show'
                },
                hideClass: {
                    popup: 'swal2-hide',
                    backdrop: 'swal2-backdrop-hide',
                    icon: 'swal2-icon-hide'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        data: {
                            "editRole": 1,
                            "id":id,
                            "roleID": $("#roleSelect").val(),
                        },
                        url: "controller/roleController.php",
                        success: function (e) {
                            if (e.trim() === "empty") {
                                Swal.fire({
                                    title: 'Hata!',
                                    text: 'Rol Ekleme Kısmını Boş Bırakmayınız!',
                                    icon: 'error',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                })
                            } else if (e.trim() === "error") {
                                Swal.fire({
                                    title: 'Hata!',
                                    text: 'Aynı rolü seçtiniz!',
                                    icon: 'error',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                })
                            } else if (e.trim() === "ok") {
                                Swal.fire({
                                    title: 'Başarılı!',
                                    text: 'Rol Değiştirildi!',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                }).then((result) => {
                                    $("#roleSelect").val(" ");
                                    table.ajax.reload();
                                    $('#ajaxModal').modal('toggle');

                                });
                            }
                        }
                    })
                }
            })
        }
    })
}