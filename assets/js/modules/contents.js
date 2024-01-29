var table;

$(document).on('change', '#categoryFilter, #languageFilter', function () {
    var categoryId = $('#categoryFilter').val();
    var languageId = $('#languageFilter').val();
    contentTable(id,lang, categoryId, languageId);
});


function contentTable(id, lang, categoryId, languageId) {
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
            },
            dataSrc: function (json) {
                var data = json.data.map(function (item) {
                    return {
                        id: item.id,
                        title: item.title,
                        category: item.category,
                        url: item.url,
                        process: '<div class="d-flex justify-content-center">'
                            + (item.process.edit ? '<a href="editContent/' + item.id + '"><button type="button" class="btn btn-relief-info btn-sm"><i class="bi bi-pencil-square"></i></button></a><span style="margin:3px;"></span>' : '')
                            + (item.process.delete ? '<button type="button" class="btn btn-relief-danger btn-sm" onclick="' + (item.process.translate ? 'deleteTranslateContent' : 'deleteContent') + '(' + item.id + ')"><i class="bi bi-trash-fill"></i></button><span style="margin:3px;"></span>' : '')
                            + (item.process.list ? '<a href="content/' + item.url + '"><button type="button" class="btn btn-relief-warning btn-sm" onclick="pageVisit(' + item.id + ')"><i class="bi bi-eye-fill"></i></button></a>' : '')
                            + '</div>'
                    };
                });

                return data;
            }
        },
        columns: [
            { data: 'id', visible: false },
            { data: 'url', visible: false },
            { data: 'title' },
            { data: 'category' },
            { data: 'process' },

        ],
    });
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
//languageFilter();
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

function deleteTranslateContent(id) {

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
                    "deleteTranslateContent": 1,
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