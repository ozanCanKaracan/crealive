var table;
function top_5(langID) {
    if(langID == 2) {
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
                }
            },
            columns: [
                {data: 'id', visible: false},
                {data: 'title'},
                {data: 'category'},
                {data: 'process'},
            ],
        });
    }else{
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
                }
            },
            columns: [
                {data: 'id', visible: false},
                {data: 'title'},
                {data: 'category'},
                {data: 'process'},

            ],
            "language": {"url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/tr.json"}
        });
    }
}
