function register() {
    $.validator.addMethod("customPattern", function (value, element, pattern) {
        return this.optional(element) || pattern.test(value);
    }, "");

    $("#registerForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                customPattern: /^[a-zA-ZçğıöşüÇĞİÖŞÜ\s]+$/u
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 10,
                customPattern: /^[0-9]+$/
            },
            email: {
                required: true,
                email: true,
            },
            email2: {
                required: true,
                email: true,

            },
            password: {
                required: true,
                minlength: 3,
            },
            password2: {
                required: true,
                minlength: 3,
            },

        },
        messages: {
            name: {
                minlength: "En az 3 karakter giriniz!",
                required: "Bu alan zorunludur!",
                customPattern: "Sadece harf girebilirsiniz!"
            },
            phone: {
                minlength: "Lütfen geçerli bir telefon numarası giriniz!",
                maxlength: "Lütfen geçerli bir telefon numarası giriniz!",
                required: "Bu alan zorunludur!",
                customPattern: "Sadece rakam girebilirsiniz!"
            },
            email: {
                required: "Bu alan zorunludur!",
                email: "Lütfen geçerli bir mail adresi giriniz.",
            },
            email2: {
                required: "Bu alan zorunludur!",
                email: "Lütfen geçerli bir mail adresi giriniz.",
            },
            password: {
                minlength: "En az 3 karakter giriniz!",
                required: "Bu alan zorunludur!",
            },
            password2: {
                required: "Bu alan zorunludur!",
                minlength: "En az 3 karakter giriniz!",

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
                            "name": $("#name").val(),
                            "phone": $("#phone").val(),
                            "mail": $("#email").val(),
                            "mail2": $("#email2").val(),
                            "selectLang": $("#selectLang").val(),
                            "pass": $("#password").val(),
                            "pass2": $("#password2").val(),
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
                                })
                            } else if (e.trim() === "phone") {
                                Swal.fire({
                                    title: 'Hata!',
                                    text: 'Bu telefon numarası kullanılıyor!',
                                    icon: 'error',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                })
                            } else if (e.trim() === "mail") {
                                Swal.fire({
                                    title: 'Hata!',
                                    text: 'Bu mail adresi kullanılıyor!',
                                    icon: 'error',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                })
                            } else if (e.trim() === "mail2") {
                                Swal.fire({
                                    title: 'Hata!',
                                    text: 'Mail adresleri uyuşmuyor!',
                                    icon: 'error',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                })
                            } else if (e.trim() === "pass") {
                                Swal.fire({
                                    title: 'Hata!',
                                    text: 'Şifreler uyuşmuyor!',
                                    icon: 'error',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                })
                            } else if (e.trim() === "ok") {
                                Swal.fire({
                                    title: 'Başarlı!',
                                    text: 'Kayıt Başarılı, Giriş Ekranına Yönlendiriliyorsunuz!',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6'
                                }).then((result) => {
                                    window.location.href = "login";
                                });
                            }
                        }
                    })
                }
            });
        }
    });
}

function login() {

    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 3,
            },
        },
        messages: {
            email: {
                required: "Bu alan zorunludur!",
                email: "Lütfen geçerli bir mail adresi giriniz.",
            },
            password: {
                required: "Bu alan zorunludur!",
                minlength: "Şifre en az 3 karakter olmalıdır.",
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
            $.ajax({
                type: "POST",
                url: "controller/authController.php",
                data: {
                    "login": 1,
                    "email": $("#email").val(),
                    "password": $("#password").val(),
                },
                success: function (e) {
                    if (e.trim() === "bos") {
                        Swal.fire({
                            title: 'Hata!',
                            text: 'Boş alan bırakmayınız!',
                            icon: 'error',
                            timer: 1500,
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6'
                        });
                    } else if (e.trim() === "ok") {
                        Swal.fire({
                            title: 'Başarılı!',
                            text: 'Giriş yapılıyor!',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6'
                        }).then((result) => {
                            window.location.href = "";
                        });
                    } else if (e.trim() === "hata") {
                        Swal.fire({
                            title: 'Hata!',
                            text: 'Email veya şifre hatalı!',
                            icon: 'error',
                            timer: 1500,
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6'
                        });
                    }
                }
            });
        }
    });
}

function logout(lang) {
    if (lang == 2) {
        Swal.fire({
            title: 'Are you sure you want to log out?',
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
                    url: "controller/authController.php",
                    data: {
                        "logout": 1,
                    },
                    success: function (e) {
                        if (e.trim() === "ok") {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Signing out!',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: true,
                                confirmButtonColor: '#3085d6'
                            }).then((result) => {
                                window.location.href = "";
                            });
                        }
                    }
                })
            }
        })
    } else {
        Swal.fire({
            title: 'Çıkış yapmak istediğinize emin misiniz?',
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
                        "logout": 1,
                    },
                    success: function (e) {
                        if (e.trim() === "ok") {
                            Swal.fire({
                                title: 'Başarılı!',
                                text: 'Çıkış yapılıyor!',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: true,
                                confirmButtonColor: '#3085d6'
                            }).then((result) => {
                                window.location.href = "";
                            });
                        }
                    }
                })
            }
        })
    }
}
    $("#phone").on("input", function () {
        var sanitizedValue = $(this).val().replace(/[^0-9]/g, "");
        $(this).val(sanitizedValue);
    });

function selectLanguage() {
    $.ajax({
        type: 'POST',
        data: {
            'selectLanguage': 1,
        },
        url: "controller/languageController.php",
        success: function (e) {
            var languageData = JSON.parse(e);

            var selectLanguageContainer = $('#selectLanguage');
            selectLanguageContainer.empty();

            languageData.forEach(function (language) {
                var languageFlag = (language.lang_name_short == "en") ? "us" : language.lang_name_short;

                var anchorElement = $('<a>', {
                    'class': 'dropdown-item ' + language.isActive,
                    'href': '?lang=' + language.lang_name_short,
                });

                var flagIconElement = $('<i>', {
                    'class': 'flag-icon flag-icon-' + languageFlag,
                });

                anchorElement.append(flagIconElement);
                anchorElement.append(' ' + language.translate);

                selectLanguageContainer.append(anchorElement);
            });
        }
    });
}


selectLanguage()

function sidebarAjax() {
    $.ajax({
        type: 'POST',
        data: {
            'sidebarAjax': 1,
        },
        url: "controller/authController.php",
        success: function (e) {

            $('#sidebar').empty();
            $('#sidebar').append(e);
        }
    });
}

sidebarAjax()

