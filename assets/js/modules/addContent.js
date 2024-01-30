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
        });
    })
    .catch(error => {
        console.error(error);
    });


function addContent(id) {
    var selectedCategory = $(".category:checked").val();
    var selectedTag = $(".tag:checked").val();
    const language = $("#translateSelect").val();

    $.validator.addMethod("ck_editor", function () {
        var content_length = editorTextarea.getData().trim().length;
        return content_length > 0;
    }, "Please add page content.");

    let data;

    if (language) {
        function translatedText() {
            return new Promise((resolve, reject) => {
                const originalText = editorTextarea.getData();
                const title = $("#titleContent").val();
                const endpoint = "https://translation.googleapis.com/language/translate/v2";
                const apiKey = "AIzaSyBdH8gjaAKplDXc_rxfTAHI9wCjxTO_U70";
                const targetLanguage = language;

                const requestBody = {
                    q: [originalText, title],
                    target: targetLanguage
                };

                fetch(`${endpoint}?key=${apiKey}`, {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(requestBody)
                })
                    .then(response => response.json())
                    .then(data => {
                        const translatedText = data.data.translations[0].translatedText;
                        const translatedTitle = data.data.translations[1].translatedText;
                        resolve({translatedText, translatedTitle});
                    })
                    .catch(error => reject(error));
            });
        }

        data = {
            "addContent": 1,
            "translateLanguage": $("#translateSelect").val(),
            "tag": $("#tag").val(),
            "specialURL": $("#url").val(),
            "category": $("#categorySelect").val(),
            "title": $("#titleContent").val(),
            "urlCat": selectedCategory,
            "urlTag": selectedTag,
            "editor": editorTextarea.getData(),
        };
    } else {
        data = {
            "addContent": 1,
            "translateLanguage": $("#translateSelect").val(),
            "tag": $("#tag").val(),
            "specialURL": $("#url").val(),
            "category": $("#categorySelect").val(),
            "title": $("#titleContent").val(),
            "urlCat": selectedCategory,
            "urlTag": selectedTag,
            "editor": editorTextarea.getData(),
        };
    }

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
                title: 'Create Content?',
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
                    if (language) {
                        translatedText().then(({translatedText, translatedTitle}) => {
                            data.translatedText = translatedText;
                            data.translatedTitle = translatedTitle;

                            $.ajax({
                                data: data,
                                type: "POST",
                                url: "controller/contentController.php",
                                success: function (e) {
                                    if (e.trim() === "bos") {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'Do not leave empty space!',
                                            icon: 'error',
                                            timer: 1500,
                                            showConfirmButton: true,
                                            confirmButtonColor: '#3085d6'
                                        });
                                    } else if (e.trim() === "title") {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'This title is used!',
                                            icon: 'error',
                                            timer: 1500,
                                            showConfirmButton: true,
                                            confirmButtonColor: '#3085d6'
                                        });
                                    } else if (e.trim() === "auto") {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'This url is used!',
                                            icon: 'error',
                                            timer: 1500,
                                            showConfirmButton: true,
                                            confirmButtonColor: '#3085d6'
                                        });
                                    } else if (e.trim() === "special") {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'The URL you want to create is already in use!',
                                            icon: 'error',
                                            timer: 1500,
                                            showConfirmButton: true,
                                            confirmButtonColor: '#3085d6'
                                        });
                                    } else if (e.trim() === "auto") {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'The automatic URL you want to create is already in use!',
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
                                            title: 'Success!',
                                            text: 'Content added successfully!',
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
                        }).catch((error) => {
                            console.error("Translation error:", error);
                        });
                    } else {
                        $.ajax({
                            data: data,
                            type: "POST",
                            url: "controller/contentController.php",
                            success: function (e) {
                                if (e.trim() === "bos") {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Do not leave empty space!',
                                        icon: 'error',
                                        timer: 1500,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6'
                                    });
                                } else if (e.trim() === "title") {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'This title is used!',
                                        icon: 'error',
                                        timer: 1500,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6'
                                    });
                                } else if (e.trim() === "auto") {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'This url is used!',
                                        icon: 'error',
                                        timer: 1500,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6'
                                    });
                                } else if (e.trim() === "special") {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'The URL you want to create is already in use!',
                                        icon: 'error',
                                        timer: 1500,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6'
                                    });
                                } else if (e.trim() === "auto") {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'The automatic URL you want to create is already in use!',
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
                                        title: 'Success!',
                                        text: 'Content added successfully!',
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
                }
            });
        }
    });
}
function editContent(id, lang) {
    $.validator.addMethod("ck_editor", function () {
        var content_length = editorTextarea.getData().trim().length;
        return content_length > 0;
    }, "Please add page content.");

    if (lang == 2) {
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
                    title: 'Do you want to edit the content?',
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
                                        title: 'Error!',
                                        text: 'Dont leave the field blank!',
                                        icon: 'error',
                                        timer: 1500,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#3085d6'
                                    });
                                } else if (e.trim() === "ok") {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Content Edited!',
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
    } else {
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
            // Gelen veriyi JSON olarak parse et
            var tagData = JSON.parse(e);

            var selectElement = document.createElement('select');
            selectElement.classList.add('form-select');
            selectElement.setAttribute('id', 'tag');
            selectElement.setAttribute('multiple', 'multiple');

            tagData.forEach(function (tag) {
                var optionElement = document.createElement('option');
                optionElement.value = tag.tag_id;
                optionElement.text = tag.tag_name;
                selectElement.appendChild(optionElement);
            });

            var containerElement = document.getElementById('tagContainer');
            containerElement.innerHTML = '';
            containerElement.appendChild(selectElement);
        }
    });
}

tagSelect();
