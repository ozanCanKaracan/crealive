var table;

$(document).on('change', '#categoryFilter, #languageFilter', function () {
    var categoryId = $('#categoryFilter').val();
    var languageId = $('#languageFilter').val();
    contentTable(id,lang, categoryId, languageId);
});


function contentTable(id, lang, categoryId, languageId) {
    if (lang == 2) {
        if (table) {
            table.clear().destroy();
            table = false;
        }

        table = $('#contentTable').DataTable({
            sDom: '<"d-flex justify-content-between align-items-center"lf>rt<"d-flex justify-content-between align-items-center"ip>',
            ajax: {
                url: 'controller/contentController.php',
                type: 'POST',
                data: {
                    "contentTable": 1,
                    "categoryId": categoryId,
                    "languageId": languageId,
                    "id": id,
                }
            },
            columns: [
                { data: 'id', visible: false },
                { data: 'title' },
                { data: 'category' },
                { data: 'process' },
            ],
        });
    } else {
        if (table) {
            table.clear().destroy();
            table = false;
        }

        table = $('#contentTable').DataTable({
            sDom: '<"d-flex justify-content-between align-items-center"lf>rt<"d-flex justify-content-between align-items-center"ip>',
            ajax: {
                url: 'controller/contentController.php',
                type: 'POST',
                data: {
                    "contentTable": 1,
                    "categoryId": categoryId,
                    "languageId": languageId,
                    "id": id,
                }
            },
            columns: [
                { data: 'id', visible: false },
                { data: 'title' },
                { data: 'category' },
                { data: 'process' },
            ],

            "language": { "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/tr.json" }
        });
    }
}

function categoryFilter() {
    $.ajax({
        type: 'POST',
        data: {
            'categoryFilter': 1
        },
        url: "controller/contentController.php",
        success: function (e) {
            $('#filterByCategory').empty();
            $('#filterByCategory').append(e);
        }
    });
}

function languageFilter() {
    $.ajax({
        type: 'POST',
        data: {
            'languageFilter': 1
        },
        url: "controller/contentController.php",
        success: function (e) {
            $('#filterByLanguage').empty();
            $('#filterByLanguage').append(e);
        }
    });
}


categoryFilter();
languageFilter();
function deleteContent(id) {

    Swal.fire({
        title: 'İçerik Silinsin mi?',
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
                url: "controller/contentController.php",
                data: {
                    "id":id,
                    "deleteContent": 1,
                },
                success: function (e) {
                    if (e.trim() === "ok") {
                        Swal.fire({
                            title: 'Başarılı!',
                            text: 'İçerik silinmiştir!',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6'
                        }).then((result) => {
                            table.ajax.reload();
                        });
                    }
                }
            });
        }
    });
}
function pageVisit(id){
    $.ajax({
        type : "POST",
        data : {
            "id":id,
            "pageVisit":1
        },
        url : "controller/contentController.php",
        success: function (e){

        }
    })
}

