var jQuery = $.noConflict();
var table;

function contentTable(id) {
    if (table) {
        table.destroy()
        table = false
    }

    table = $('#contentTable').DataTable({
        sDom: '<"d-flex justify-content-between align-items-center"lf>rt<"d-flex justify-content-between align-items-center"ip>',
        ajax: {
            url: 'controller/contentController.php',
            type: 'POST',
            data: {
                "contentTable": 1,
                "id": id,
            }
        },
        columns: [
            {data: 'id', visible: false},
            {data: 'title'},
            {data: 'desc'},
            {data: 'category'},
            {data: 'process'},

        ],
        "language": {"url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/tr.json"}
    });

}
