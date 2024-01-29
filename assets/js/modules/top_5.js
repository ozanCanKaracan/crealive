var table;

function top_5(langID) {

    if (table) {
        table.destroy()
        table = false
    }

    table = $('#top_5').DataTable({
        sDom: '<"d-flex justify-content-between align-items-center"lf>rt<"d-flex justify-content-between align-items-center"ip>',
        ajax: {
            url: 'controller/statsController.php',
            type: 'POST',
            data: {
                "top_5": 1,
            },
            dataSrc: function (json) {
                var data = json.data.map(function (item) {
                    return {
                        id: item.id,
                        url: item.url,
                        title: item.title,
                        category: item.category,
                        process: (item.process.button ? '<a href="content/' + item.url + '"><button type="button" class="btn btn-relief-warning btn-sm" onclick="pageVisit(' + item.id + ')">'+ item.process.text +'</button></a>' : ''),
                    }
                });
                return data;

            }
        },
        columns: [
            {data: 'id', visible: false},
            {data: 'url', visible: false},
            {data: 'title'},
            {data: 'category'},
            {data: 'process'},

        ],
        "language": {"url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/tr.json"}
    });
}