let tableX;

function getRoleTable(langID) {
    if (tableX) {
        tableX.destroy();
        tableX = false;
    }

    tableX = $('#roleTable').DataTable({
        sDom: '<"d-flex justify-content-between align-items-center"lf>rt<"d-flex justify-content-between align-items-center"ip>',
        ajax: {
            url: 'controller/roleController.php',
            type: 'POST',
            data: {
                "getRoleTable": 1,
            },
            dataSrc: function (json) {
                var data = json.data.map(function (item) {
                    return {
                        id: item.id,
                        role_name: item.role_name,
                        d_noneListName: item.d_noneListName,
                        d_nonePageName: item.d_nonePageName,
                        users: (item.users.button ? '<a href="userlistRole/' + item.id + '"><button type="button" class="btn btn-relief-info btn-sm"> ' + item.d_noneListName + '</button></a>' : ''),
                        pages: (item.pages.button ? '<a href="permission/' + item.id + '"><button type="button" class="btn btn-relief-warning btn-sm"> ' + item.d_nonePageName + '</button></a>' : ''),
                    };
                });
                return data;
            }
        },
        columns: [
            {data: 'id', visible: false},
            {data: 'd_noneListName', visible: false},
            {data: 'd_nonePageName', visible: false},
            {data: 'role_name'},
            {data: 'users'},
            {data: 'pages'},
        ],
        "language": {"url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/tr.json"}
    });
}

function addRole(id) {
    $("#addRoleForm").validate({
        rules: {
            role: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
        },
        messages: {
            role: {
                required: "Bu alan zorunludur!",
                minlength: "Rol en az 3 karakter olmalıdır.",
                maxlength: "En fazla 20 karakter girebilirsiniz."
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
                title: 'Rol Eklensin mi?',
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
                            "addRole": 1,
                            "roleName": $("#role").val(),
                        },
                        url: "controller/roleController.php",
                        success: function (e) {
                            if (e.trim() === "bos") {
                                Swal.fire({
                                    title: 'Hata!',
                                    text: 'Rol Ekleme Kısmını Boş Bırakmayınız!',
                                    icon: 'error',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                })
                            } else if (e.trim() === "regex") {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Sadece Harf Giriniz!',
                                    icon: 'error',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                })
                            } else if (e.trim() === "hata") {
                                Swal.fire({
                                    title: 'Hata!',
                                    text: 'Bu isimde rol bulunuyor!',
                                    icon: 'error',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                })
                            } else if (e.trim() === "ok") {
                                Swal.fire({
                                    title: 'Başarılı!',
                                    text: 'Rol Eklendi!',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                }).then((result) => {
                                    $("#role").val(" ");
                                    window.location.reload();
                                });
                            }
                        }
                    })
                }
            })
        }
    })
}

function deleteRole(id) {
    $("#deleteRoleForm").validate({
        rules: {
            roleSelect: {
                required: true,
            },
        },
        messages: {
            roleSelect: {
                required: "Lütfen Rol Seçiniz!",
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
                title: 'Rol silinsin mi ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#00FF00',
                confirmButtonText: 'Sil',
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
                        url: "controller/roleController.php",
                        data: {
                            "deleteRole": 1,
                            "id": $("#roleSelect").val(),
                        },
                        success: function (e) {
                            if (e.trim() === "ok") {
                                Swal.fire({
                                    title: 'Başarılı!',
                                    text: 'Rol Silindi!',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                }).then((result) => {
                                    window.location.reload();
                                });
                            } else if (e.trim() === "error") {
                                Swal.fire({
                                    title: 'Hata!',
                                    text: 'Bu rolde kullanıcılar bulunuyor!',
                                    icon: 'error',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                })
                            }
                        },

                    });
                }
            });
        }
    });
}

$("#role").on("input", function () {
    var sanitizedValue = $(this).val().replace(/[^a-zA-Z\s]/g, "");
    $(this).val(sanitizedValue);
});

