var table;

function languageCheckbox(roleID, type, parentID) {
    var checkedIDs = [];
    var notcheck = [];
    $("." + type + "CheckLanguage:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);
    });

    $("." + type + "CheckLanguage:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });
    $.ajax({
        type: "POST",
        url: "controller/permissionController.php",
        data: {
            "languageCheckbox": 1,
            "roleID": roleID,
            "type": type,
            "parentID": parentID,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
        },
        success: function (response) {

        }
    });
}

function permissionCheckbox(roleID, type) {
    var checkedIDs = [];
    var notcheck = [];
    $("." + type + "Check:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);
    });

    $("." + type + "Check:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });
    $.ajax({
        type: "POST",
        url: "controller/permissionController.php",
        data: {
            "permissionCheckbox": 1,
            "roleID": roleID,
            "type": type,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
        },
        success: function (response) {

        }
    });
}


function getPermissionTable(id, langID, pageID) {

    if (table) {
        table.destroy()
        table = false
    }

    table = $('#permissionTable').DataTable({
        sDom: '<"d-flex justify-content-between align-items-center"lf>rt<"d-flex justify-content-between align-items-center"ip>',
        ajax: {
            url: 'controller/permissionController.php',
            type: 'POST',
            data: {
                "getPermissionTable": 1,
                "id": id,
                "pageID": pageID

            }
        },
        columns: [
            {data: 'id', visible: false},
            {data: 'pages'},
            {data: 'add'},
            {data: 'delete'},
            {data: 'edit'},
            {data: 'list'},
            {data: 'view'},

        ],
        "language": {"url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/tr.json"}
    });
    table.page.len(100).draw();

}




