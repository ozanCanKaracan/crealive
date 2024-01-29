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
        dataType: 'json',
        success: function (data) {
            var translate_1 = data.translate_1;
            var translate_2 = data.translate_2;
            var translate_3 = data.translate_3;
            var translate_4 = data.translate_4;

            // Label ve select elementlerini oluştur
            var labelElement = document.createElement('label');
            labelElement.setAttribute('for', 'tag');
            labelElement.classList.add('form-label-lg');
            labelElement.innerHTML = '<b>' + translate_1 + ' :</b>';

            var selectElement = document.createElement('select');
            selectElement.classList.add('form-select');
            selectElement.setAttribute('id', 'filterSelect');

            var option1 = document.createElement('option');
            option1.value = '';
            option1.innerHTML = translate_2;

            var option2 = document.createElement('option');
            option2.value = '1';
            option2.innerHTML = translate_3;

            var option3 = document.createElement('option');
            option3.value = '2';
            option3.innerHTML = translate_4;

            // Optionları select elementine ekleyin
            selectElement.appendChild(option1);
            selectElement.appendChild(option2);
            selectElement.appendChild(option3);

            // #statsFilter içerisini temizle ve yeni oluşturulan elementleri ekleyin
            $('#statsFilter').empty();
            $('#statsFilter').append(labelElement);
            $('#statsFilter').append(selectElement);
        }
    });
}


statsFilter()