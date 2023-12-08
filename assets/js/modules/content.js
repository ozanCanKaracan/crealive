var editorTextarea;

ClassicEditor
    .create(document.querySelector('#content'))
    .then(editor => {
        editorTextarea = editor;
        editorTextarea.model.document.on('change:data', function () {
        });
    })
    .catch(error => {
        console.error(error);
    });

function addContent() {
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
                title: 'Kayıt olmak istediğinize emin misiniz?',
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
                        url: "controller/authController.php",
                        data: {
                            "register": 1,
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
                                    text: 'Kayıt Başarılı, Giriş Ekranına Yönlendiriliyorsunuz!',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                }).then((result) => {
                                    window.location.href = "contents";
                                });
                            }
                        }
                    });
                }
            });
        }
    });
}
