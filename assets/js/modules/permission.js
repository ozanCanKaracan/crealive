var jQuery = $.noConflict();

var table;
function getPermissionTable(id) {
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
                "id":id,
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

}
function addCheckBox(id) {
    var checkedIDs = [];
    var notcheck = [];

    $(".addCheck:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);
    });

    $(".addCheck:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });

    $.ajax({
        type: "POST",
        url: "controller/permissionController.php",
        data: {
            "role_id": id,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
            "addCheckBox": 1,
        },
        success: function (response) {

        }
    });
}


function deleteCheckBox(id) {
    var checkedIDs = [];
    var notcheck = [];

    $(".deleteCheck:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);
    });

    $(".deleteCheck:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });

    $.ajax({
        type: "POST",
        url: "controller/permissionController.php",
        data: {
            "role_id": id,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
            "deleteCheckBox": 1,
        },
        success: function (response) {

        }
    });
}

function editCheckBox(id) {
    var checkedIDs = [];
    var notcheck = [];

    $(".editCheck:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);
    });

    $(".editCheck:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });

    $.ajax({
        type: "POST",
        url: "controller/permissionController.php",
        data: {
            "role_id": id,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
            "editCheckBox": 1,
        },
        success: function (response) {

        }
    });
}

function listCheckBox(id) {
    var checkedIDs = [];
    var notcheck = [];

    $(".listCheck:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);
    });

    $(".listCheck:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });

    $.ajax({
        type: "POST",
        url: "controller/permissionController.php",
        data: {
            "role_id": id,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
            "listCheckBox": 1,
        },
        success: function (response) {

        }
    });
}
function viewCheckBox(id) {
    var checkedIDs = [];
    var notcheck = [];

    $(".viewCheck:checked").each(function () {
        var checkedID = $(this).val();
        checkedIDs.push(checkedID);
    });

    $(".viewCheck:not(:checked)").each(function () {
        var checkedIDNot = $(this).val();
        notcheck.push(checkedIDNot);
    });

    $.ajax({
        type: "POST",
        url: "controller/permissionController.php",
        data: {
            "role_id": id,
            "checkedID": checkedIDs,
            "notCheckedID": notcheck,
            "viewCheckBox": 1,
        },
        success: function (response) {

        }
    });
}

