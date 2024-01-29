function addCategory(id) {
    if (id == 2) {
        $("#addCategoryForm").validate({
            rules: {
                categoryName: {
                    required: true,
                    minlength: 3,
                    maxlength: 35
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
                    title: 'Add Category?',
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
                                "categoryAdd": 1,
                                "categoryName": $("#categoryName").val(),
                            },
                            url: "controller/categoryController.php",
                            success: function (e) {
                                console.log($("#categoryName").val())
                                if (e.trim() === "bos") {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Do not leave the category adding section blank!',
                                        icon: 'error',
                                        timer: 1500,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6'
                                    })
                                } else if (e.trim() === "hata") {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'There is a Category with this name!',
                                        icon: 'error',
                                        timer: 1500,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6'
                                    })
                                } else if (e.trim() === "ok") {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Category Added!!',
                                        icon: 'success',
                                        timer: 1500,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6'
                                    }).then((result) => {
                                        $("#categoryName").val(" ");
                                        getCategorySelectBox();
                                    });
                                }
                            }
                        })
                    }
                })
            }
        })
    } else {
        $("#addCategoryForm").validate({
            rules: {
                categoryName: {
                    required: true,
                    minlength: 3,
                    maxlength: 35
                },
            },
            messages: {
                categoryName: {
                    required: "Bu alan zorunludur!",
                    minlength: "Rol en az 3 karakter olmalıdır.",
                    maxlength: "En fazla 35 karakter girebilirsiniz."
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
                    title: 'Kategori Eklensin mi?',
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
                                "categoryAdd": 1,
                                "categoryName": $("#categoryName").val(),
                            },
                            url: "controller/categoryController.php",
                            success: function (e) {
                                console.log($("#categoryName").val())
                                if (e.trim() === "bos") {
                                    Swal.fire({
                                        title: 'Hata!',
                                        text: 'Kategori Ekleme Kısmını Boş Bırakmayınız!',
                                        icon: 'error',
                                        timer: 1500,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6'
                                    })
                                } else if (e.trim() === "hata") {
                                    Swal.fire({
                                        title: 'Hata!',
                                        text: 'Bu isimde Kategori bulunuyor!',
                                        icon: 'error',
                                        timer: 1500,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6'
                                    })
                                } else if (e.trim() === "ok") {
                                    Swal.fire({
                                        title: 'Başarılı!',
                                        text: 'Kategori Eklendi!',
                                        icon: 'success',
                                        timer: 1500,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6'
                                    }).then((result) => {
                                        $("#categoryName").val(" ");
                                        getCategorySelectBox();
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

function deleteCategory() {

    $("#deleteCategoryForm").validate({
        rules: {
            categorySelect: {
                required: true,
            },
        },
        messages: {
            categorySelect: {
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
                title: 'Kategori silinsin mi ?',
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
                        url: "controller/categoryController.php",
                        data: {
                            "deleteCategory": 1,
                            "id": $("#categorySelect").val(),
                        },
                        success: function (e) {
                            if (e.trim() === "ok") {
                                Swal.fire({
                                    title: 'Başarılı!',
                                    text: 'Kategori Silindi!',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                }).then((result) => {
                                    window.location.reload();
                                    $("#roleSelect").val(" ");
                                });
                            } else if (e.trim() === "hata") {
                                Swal.fire({
                                    title: 'Hata!',
                                    text: 'Bu kategoriye ait içerikler bulunuyor!',
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