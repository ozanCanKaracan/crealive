function register() {
    $.validator.addMethod("customPattern", function (value, element, pattern) {
        return this.optional(element) || pattern.test(value);
    }, "Geçerli bir değer girin.");

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
            email_again: {
                required: true,
                email: true,

            },
            password: {
                required: true,
                minlength: 3,
            },
            password_again: {
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
            password: {
                minlength: "En az 3 karakter giriniz!",
                required: "Bu alan zorunludur!",
            },
            password_again: {
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
                            "mail": $("#mail").val(),
                            "mail2": $("#mail2").val(),
                            "pass": $("#pass").val(),
                            "pass2": $("#pass2").val(),
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
    $.validator.addMethod("customPattern", function (value, element, pattern) {
        return this.optional(element) || pattern.test(value);
    }, "Geçerli bir değer girin.");

    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 3,
                customPattern: /^[0-9]+$/,
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
                customPattern: "Lütfen sadece sayı kullanın.",
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
                    "pass": $("#password").val(),
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
                    }
                }
            });
        }
    });
}