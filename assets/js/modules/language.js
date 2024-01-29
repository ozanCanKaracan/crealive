let table;

function languageTable() {
    if (table) {
        table.destroy();
        table = false;
    }

    table = $('#langPackageTable').DataTable({
        sDom: '<"d-flex justify-content-between align-items-center"lf>rt<"d-flex justify-content-between align-items-center"ip>',
        ajax: {
            url: 'controller/languageController.php',
            type: 'POST',
            data: {
                "languageTable": 1,
            },
            dataSrc: function (json) {
                var data = json.data.map(function (item) {
                    return {
                        id: item.id,
                        lang_dnone:item.lang_dnone,
                        lang_short_dnone: item.lang_short_dnone,
                        lang_short: item.lang_short,
                        lang_name: (item.lang_name.flag ? item.lang_dnone + '<i class="flag-icon flag-icon-' + item.lang_short_dnone + '"></i> ' : ''),
                        process: (item.process.button ? '<button type="button" class="btn btn-danger btn-sm" onclick="removeLanguage(' + item.id + ')">Kaldır</button>' : ''),
                    };
                });
                return data;
            },
        },
        columns: [
            { data: 'id', visible: false },
            { data: 'lang_dnone', visible: false },
            { data: 'lang_short_dnone', visible: false },
            { data: 'lang_name' },
            { data: 'lang_short' },
            { data: 'process' },
        ],
        language: { url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/tr.json" }
    });
}
languageTable()

function addLangPackage() {
    Swal.fire({
        title: 'Yeni Dil Paketi Eklensin mi ?',
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
                url: 'controller/languageController.php',
                type: 'POST',
                data: {
                    "addLangPackage": 1,
                    "selectedLang": $("#langSelect").val(),
                },
                beforeSend: function () {
                    showLoader();
                },
                success: function (e) {
                    hideLoader();
                    if (e.trim() === "empty") {
                        Swal.fire({
                            title: 'Hata!',
                            text: 'Lütfen bir dil seçiniz!',
                            icon: 'error',
                            timer: 1500,
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6'
                        })
                    } else if (e.trim() === "ok") {
                        Swal.fire({
                            title: 'Başarılı!',
                            text: 'Dil başarıyla eklendi!',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6'
                        })
                        table.ajax.reload();
                    }
                },
                complete: function () {
                    hideLoader();
                }
            });
        }
    });
}

function showLoader() {
    $('#loader').show();
    $('#loader-container').show();
    $('.content').addClass('blurred');
}

function hideLoader() {
    $('#loader').hide();
    $('#content').show()
    $('#loader-container').hide();
    $('.content').removeClass('blurred');

}

function loadData() {
    showLoader();

    setTimeout(function () {
        hideLoader();
    }, 1000);
}

$(document).ready(function () {
    loadData();
});

function removeLanguage(id) {
    Swal.fire({
        title: 'Dil Paketi Kaldırılsın mı ?',
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
                type:"POST",
                data:{
                    "id":id,
                    "removeLanguage":1,
                },
                url:"controller/languageController.php",
                beforeSend: function () {
                    showLoader();
                },
                success:function (e){
                    if(e.trim()==="ok"){
                        Swal.fire({
                            title: 'Başarılı!',
                            text: 'Dil başarıyla kaldırıldı!',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6'
                        })
                        table.ajax.reload();
                    }else if(e.trim()==="error"){
                        Swal.fire({
                            title: 'Hata!',
                            text: 'Seçili Olan Dil Kaldırılamaz!',
                            icon: 'error',
                            timer: 1500,
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6'
                        })
                    }
                },
                complete: function () {
                    hideLoader();
                }
            });
        }
    });
}

/*function translateText() {
    const originalText = document.getElementById("originalText").innerText;
    const endpoint = "https://translation.googleapis.com/language/translate/v2";
    const apiKey = "AIzaSyBdH8gjaAKplDXc_rxfTAHI9wCjxTO_U70";


    const targetLanguage = "tr";

    // Google Translate API çağrısı
    fetch(`${endpoint}?key=${apiKey}&q=${originalText}&target=${targetLanguage}`, {
        method: "POST"
    })
        .then(response => response.json())
        .then(data => {
            const translatedText = data.data.translations[0].translatedText;
            document.getElementById("translatedText").innerText = translatedText;
        })
        .catch(error => console.error("Translation error:", error));
}*/