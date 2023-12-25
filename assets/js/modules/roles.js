let tableX;

function getRoleTable(langID) {
    if (langID == 2) {
        if (tableX) {
            tableX.destroy()
            tableX = false
        }

        tableX = $('#roleTable').DataTable({
            sDom: '<"d-flex justify-content-between align-items-center"lf>rt<"d-flex justify-content-between align-items-center"ip>',
            ajax: {
                url: 'controller/roleController.php',
                type: 'POST',
                data: {
                    "getRoleTable": 1,
                }
            },
            columns: [
                {data: 'id', visible: false},
                {data: 'role_name'},
                {data: 'users'},
                {data: 'pages'},
                {data: 'TR'},
                {data: 'ENG'},
                {data: 'GER'},
                {data: 'FR'},

            ],
        });
    } else {
        if (tableX) {
            tableX.destroy()
            tableX = false
        }

        tableX = $('#roleTable').DataTable({
            sDom: '<"d-flex justify-content-between align-items-center"lf>rt<"d-flex justify-content-between align-items-center"ip>',
            ajax: {
                url: 'controller/roleController.php',
                type: 'POST',
                data: {
                    "getRoleTable": 1,
                }
            },
            columns: [
                {data: 'id', visible: false},
                {data: 'role_name'},
                {data: 'users'},
                {data: 'pages'},
                {data: 'TR'},
                {data: 'ENG'},
                {data: 'GER'},
                {data: 'FR'},

            ],
            "language": {"url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/tr.json"}
        });
    }
}

function trCheckBox(id) {
    var checkedIDs = [];
    var notcheck = [];

    $(".trCheck:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);
    });

    $(".trCheck:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });

    $.ajax({
        type: "POST",
        url: "controller/roleController.php",
        data: {
            "id": id,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
            "trCheckBox": 1,
        },
        success: function (response) {

        }
    });
}

function engCheckBox(id) {
    var checkedIDs = [];
    var notcheck = [];

    $(".engCheck:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);
    });

    $(".engCheck:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });

    $.ajax({
        type: "POST",
        url: "controller/roleController.php",
        data: {
            "id": id,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
            "engCheckBox": 1,
        },
        success: function (response) {

        }
    });
}

function gerCheckBox(id) {
    var checkedIDs = [];
    var notcheck = [];

    $(".gerCheck:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);
    });

    $(".gerCheck:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });

    $.ajax({
        type: "POST",
        url: "controller/roleController.php",
        data: {
            "id": id,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
            "gerCheckBox": 1,
        },
        success: function (response) {

        }
    });
}

function frCheckBox(id) {
    var checkedIDs = [];
    var notcheck = [];

    $(".frCheck:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);
    });

    $(".frCheck:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });

    $.ajax({
        type: "POST",
        url: "controller/roleController.php",
        data: {
            "id": id,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
            "frCheckBox": 1,
        },
        success: function (response) {

        }
    });
}

function addRole(id) {
    if (id == 2) {
        $("#addRoleForm").validate({
            rules: {
                role: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
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
                    title: 'Add Role?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#00FF00',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel',
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
                                        title: 'Error!',
                                        text: 'Dont leave the Role Addition Section blank!',
                                        icon: 'error',
                                        timer: 1500,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6'
                                    })
                                } else if (e.trim() === "hata") {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'A role with this name already exists!',
                                        icon: 'error',
                                        timer: 1500,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6'
                                    })
                                } else if (e.trim() === "ok") {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Role Added!',
                                        icon: 'success',
                                        timer: 1500,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6'
                                    }).then((result) => {
                                        $("#role").val(" ");
                                        getSelectBox();
                                    });
                                }
                            }
                        })
                    }
                })
            }
        })
    } else {
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
                                        getSelectBox();
                                    });
                                }
                            }
                        })
                    }
                })
            }
        })
    }
}

function getSelectBox() {
    $.ajax({
        type: 'POST',
        data: {
            'getSelectBox': 1
        },
        url: "controller/roleController.php",
        success: function (e) {
            $('#selectBox').empty();
            $('#selectBox').append(e);
        }

    })
}

function deleteRole(id) {
    if (id == 2) {
        $("#deleteRoleForm").validate({
            rules: {
                roleSelect: {
                    required: true,
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
                    title: 'Delete Role?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#00FF00',
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
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
                                        title: 'Success!',
                                        text: '"Role Deleted!',
                                        icon: 'success',
                                        timer: 1500,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6'
                                    }).then((result) => {
                                        $("#roleSelect").val(" ");
                                        getSelectBox();
                                    });
                                }
                            },

                        });
                    }
                });
            }
        });
    } else {
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
                                        $("#roleSelect").val(" ");
                                        getSelectBox();
                                    });
                                }
                            },

                        });
                    }
                });
            }
        });
    }
}


$("#role").on("input", function () {
    var sanitizedValue = $(this).val().replace(/[^a-zA-Z\s]/g, "");
    $(this).val(sanitizedValue);
});

