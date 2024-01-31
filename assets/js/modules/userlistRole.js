let table;

function getUserTable(id, langID, columns) {
    if (table) {
        table.destroy();
        table = false;
    }

    table = $('#userlistRoleTable').DataTable({
        sDom: '<"d-flex justify-content-between align-items-center"lf>rt<"d-flex justify-content-between align-items-center"ip>',
        order: [0, "desc"],
        ajax: {
            url: 'controller/roleController.php',
            type: 'POST',
            data: {
                "id": id,
                "getUserTable": 1,
            },
            dataSrc: function (json) {
                if (json.data && Array.isArray(json.data)) {
                    var data = json.data.map(function (item) {
                        var userData = {
                            id: item.id,
                            name: item.name
                        };

                        if (item.languages && Array.isArray(item.languages)) {
                            item.languages.forEach(function (lang) {
                                userData[lang.lang_name_short] = '<input type="checkbox" class="custom-control-input ' + lang.lang_name_short + 'Check" ' +
                                    'id="' + lang.lang_name_short + 'CheckBox" value="' + item.id + '" ' +
                                    'onclick="langCheckBox(' + lang.lgID + ', \'' + lang.lang_name_short + '\')" ' +
                                    (lang.checked ? 'checked' : '') +
                                    '>';
                            });
                        }

                        return userData;
                    });

                    return data;
                } else {
                    return [];
                }
            }
        },
        columns: [
            {data: 'id', visible: false},
            {data: 'name'},
            ...columns
        ],
        language: {"url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/tr.json"}
    });
}





function langCheckBox(id, langName) {
    var checkedIDs = [];
    var notcheck = [];

    $("." + langName + "Check:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);

    });
    $("." + langName + "Check:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);

    });
    $.ajax({
        type: "POST",
        url: "controller/roleController.php",
        data: {
            "id": id,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
            "langCheckBox": 1,
        },
        success: function (e) {
        }
    });
}
