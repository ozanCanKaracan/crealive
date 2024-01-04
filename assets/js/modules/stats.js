$(document).on('change', '#filterSelect', function () {
    var filter = $('#filterSelect').val();
    statsTable(language, filter);
});

var table;

function statsTable(language, filter) {
    if (language == 2) {
        if (table) {
            table.clear().destroy();
            table = false;
        }

        table = $('#conversionTable').DataTable({
            sDom: '<"d-flex justify-content-between align-items-center"lf>rt<"d-flex justify-content-between align-items-center"ip>',
            ajax: {
                url: 'controller/statsController.php',
                type: 'POST',
                data: {
                    "statsTable": 1,
                    "filter": filter
                }
            },
            columns: [
                {data: 'id', visible: false},
                {data: 'title'},
                {data: 'category'},
                {data: 'like'},
                {data: 'dislike'},
                {data: 'conversion_rate'},
                {data: 'view'},


            ],

        });
    } else {
        if (table) {
            table.clear().destroy();
            table = false;
        }

        table = $('#conversionTable').DataTable({
            sDom: '<"d-flex justify-content-between align-items-center"lf>rt<"d-flex justify-content-between align-items-center"ip>',
            ajax: {
                url: 'controller/statsController.php',
                type: 'POST',
                data: {
                    "statsTable": 1,
                    "filter": filter
                }
            },
            columns: [
                {data: 'id', visible: false},
                {data: 'title'},
                {data: 'category'},
                {data: 'like'},
                {data: 'dislike'},
                {data: 'conversion_rate'},
                {data: 'view'},

            ],

            "language": {"url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/tr.json"}
        });
    }
}


function statsFilter() {
    $.ajax({
        type: 'POST',
        data: {
            'statsFilter': 1,
        },
        url: "controller/statsController.php",
        success: function (e) {

            $('#statsFilter').empty();
            $('#statsFilter').append(e);
        }
    });
}

statsFilter()