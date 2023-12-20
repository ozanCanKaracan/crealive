var editorTextarea;
$(document).on('change', '#categorySelect', function () {
    var categoryId = $('#categorySelect').val();
    tagSelect(categoryId);
});

ClassicEditor
    .create(document.querySelector('#content'), {
        ckfinder: {
            uploadUrl: 'controller/contentController.php'
        }
    })
    .then(editor => {
        editorTextarea = editor;
        editorTextarea.model.document.on('change:data', function () {
            // Buraya düzenleme yapıldığında tetiklenecek işlemleri ekleyebilirsiniz
        });
    })
    .catch(error => {
        console.error(error);
    });


function addContent() {

    var selectedCategory = $(".category:checked").val();
    var selectedTag = $(".tag:checked").val();

    $.validator.addMethod("ck_editor", function () {
        var content_length = editorTextarea.getData().trim().length;
        return content_length > 0;
    }, "Lütfen sayfa içeriği ekleyin.");

    $("#newContentForm").validate({
        ignore: [],
        rules: {
            languageSelect: {
                required: true,
            },
            categorySelect: {
                required: true,
            },
            titleContent: {
                required: true,
            },
            content: {
                ck_editor: true
            },
        },
        messages: {
            languageSelect: {
                required: "Bu alan zorunludur!",
            },
            categorySelect: {
                required: "Bu alan zorunludur!",
            },
            titleContent: {
                required: "Bu alan zorunludur!",
            },
            content: {
                ck_editor: "Bu alan zorunludur!",
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
        submitHandler: function (form) {
            event.preventDefault();
            Swal.fire({
                title: 'İçerik oluşturulsun mu?',
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
                        url: "controller/contentController.php",
                        data: {
                            "addContent": 1,
                            "tag": $("#tag").val(),
                            "specialURL": $("#url").val(),
                            "language": $("#languageSelect").val(),
                            "category": $("#categorySelect").val(),
                            "title": $("#titleContent").val(),
                            "urlCat": selectedCategory,
                            "urlTag": selectedTag,
                            "editor": editorTextarea.getData(),
                        },
                        success: function (e) {
                            if (e.trim() === "bos") {
                                Swal.fire({
                                    title: 'Hata!',
                                    text: 'Boş alan Bırakmayınız!',
                                    icon: 'error',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                });
                            } else if (e.trim() === "title") {
                                Swal.fire({
                                    title: 'Hata!',
                                    text: 'Bu başlık kullanılıyor!',
                                    icon: 'error',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                });
                            } else if (e.trim() === "special") {
                                Swal.fire({
                                    title: 'Hata!',
                                    text: 'Oluşturmak istediğiniz URL kullanılıyor!',
                                    icon: 'error',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                });
                            }else if (e.trim() === "auto") {
                                Swal.fire({
                                    title: 'Hata!',
                                    text: 'Oluşturmak istediğiniz otomatik URL kullanılıyor!',
                                    icon: 'error',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                }).then((result) => {
                                    $(".tag:checked").prop('checked', false);
                                    $(".category:checked").prop('checked', false);
                                });
                            } else if (e.trim() === "ok") {
                                Swal.fire({
                                    title: 'Başarılı!',
                                    text: 'İçerik eklenmiştir!',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                }).then((result) => {
                                    window.location.reload();
                                });
                            }
                        }
                    });
                }
            });
        }
    });
}

function editContent(id) {
    $.validator.addMethod("ck_editor", function () {
        var content_length = editorTextarea.getData().trim().length;
        return content_length > 0;
    }, "Lütfen sayfa içeriği ekleyin.");

    $("#newContentForm").validate({
        ignore: [],
        rules: {
            languageSelect: {
                required: true,
            },
            categorySelect: {
                required: true,
            },
            titleContent: {
                required: true,
            },
            contentDescription: {
                required: true,
            },
            content: {
                ck_editor: true
            },
        },
        messages: {
            languageSelect: {
                required: "Bu alan zorunludur!",
            },
            categorySelect: {
                required: "Bu alan zorunludur!",
            },
            titleContent: {
                required: "Bu alan zorunludur!",
            },
            contentDescription: {
                required: "Bu alan zorunludur!",
            },
            content: {
                ck_editor: "Bu alan zorunludur!",
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
        submitHandler: function (form) {
            event.preventDefault();
            Swal.fire({
                title: 'İçerik Düzenlensin mi?',
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
                        url: "controller/contentController.php",
                        data: {
                            "editContent": 1,
                            "id": id,
                            "language": $("#languageSelect").val(),
                            "category": $("#categorySelect").val(),
                            "title": $("#titleContent").val(),
                            "description": $("#contentDescription").val(),
                            "editor": editorTextarea.getData(),
                        },
                        success: function (e) {
                            if (e.trim() === "bos") {
                                Swal.fire({
                                    title: 'Hata!',
                                    text: 'Boş alan Bırakmayınız!',
                                    icon: 'error',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                });
                            } else if (e.trim() === "ok") {
                                Swal.fire({
                                    title: 'Başarılı!',
                                    text: 'İçerik Düzenlenmiştir!',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                }).then((result) => {
                                    window.location.reload();
                                });
                            }
                        }
                    });
                }
            });
        }
    });
}

function tagSelect(categoryId) {
    $.ajax({
        type: 'POST',
        data: {
            "categoryId": categoryId,
            'tagSelect': 1
        },
        url: "controller/contentController.php",
        success: function (e) {
            $('#tagContainer').empty();
            $('#tagContainer').append(e);
        }
    });
}

tagSelect()



